<?php

namespace App\Controllers;

use App\Models\CarRentalAgencyModel;
use App\Models\CarsModel;
use App\Models\BookingModel;
use CodeIgniter\Controller;

class CarRentalAgency extends Controller
{
    public function register()
    {
        // Load helpers
        helper('form');

        // Check if form has been submitted
        if ($this->request->getMethod() === 'post') {
            // Validate form data
            $rules = [
                'name' => 'required',
                'email' => 'required|valid_email|is_unique[carrentalagency.email]',
                'password' => 'required|min_length[8]',
                'confirm_password' => 'matches[password]'
            ];

            if (!$this->validate($rules)) {
                // Validation failed, show error messages
                return view('carrentalagency/register', [
                    'validation' => $this->validator
                ]);
            } else {
                // Validation passed, create new account
                $model = new CarRentalAgencyModel();

                $data = [
                    'name' => $this->request->getVar('name'),
                    'email' => $this->request->getVar('email'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
                ];

                $model->insert($data);

                // Redirect to login page
                return redirect()->to('/login');
            }
        }

        // Show registration form
        return view('carrentalagency/register');
    }

    public function login()
    {
        // Load helpers
        helper('form');

        // Check if form has been submitted
        if ($this->request->getMethod() === 'post') {
            // Validate form data
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required'
            ];

            if (!$this->validate($rules)) {
                // Validation failed, show error messages
                return view('carrentalagency/login', [
                    'validation' => $this->validator
                ]);
            } else {
                // Validation passed, verify credentials
                $model = new CarRentalAgencyModel();

                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');

                $user = $model->where('email', $email)->first();

                if ($user && password_verify($password, $user['password'])) {
                    // Credentials are valid, create session for the logged-in user
                    $session = session();
                    $session->set([
                        'user_id' => $user['id'],
                        'user_type' => 'agency'
                    ]);

                    // Redirect to dashboard page
                    return redirect()->to('/dashboard');
                } else {
                    // Invalid credentials, show error message
                    $this->validator->setError('email', 'Invalid email or password.');
                    return view('carrentalagency/login', [
                        'validation' => $this->validator
                    ]);
                }
            }
        }

        // Show login form
        return view('carrentalagency/login');
    }
    public function addCarForm()
    {
        // Only logged-in car rental agency can access this page
        if (!session()->get('isLoggedIn') || session()->get('userType') !== 'agency') {
            return redirect()->to('/login');
        }
        return view('carrentalagency/addCarForm');
    }

    public function addCar()
    {
        // Only logged-in car rental agency can add a new car
        if (!session()->get('isLoggedIn') || session()->get('userType') !== 'agency') {
            return redirect()->to('/login');
        }
        $rules = [
            'vehicle_model' => 'required',
            'vehicle_number' => 'required',
            'seating_capacity' => 'required|numeric',
            'rent_per_day' => 'required|numeric'
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('/addCarForm')->withInput()->with('validation', $this->validator);
        }
        $carData = [
            'car_rental_agency_id' => session()->get('userId'),
            'vehicle_model' => $this->request->getVar('vehicle_model'),
            'vehicle_number' => $this->request->getVar('vehicle_number'),
            'seating_capacity' => $this->request->getVar('seating_capacity'),
            'rent_per_day' => $this->request->getVar('rent_per_day')
        ];
        $carRentalAgencyModel = new CarRentalAgencyModel();
        $carAdded = $carRentalAgencyModel->addCar($carData);
        if ($carAdded) {
            return redirect()->to('/cars')->with('success', 'Car added successfully!');
        } else {
            return redirect()->to('/addCarForm')->withInput()->with('error', 'Failed to add car, please try again!');
        }
    }

    public function editCarForm($car_id)
    {
        // Check if user is logged in as car rental agency
        if (!session()->get('is_agency_logged_in')) {
            return redirect()->to('/login');
        }

        $carModel = new CarRentalAgencyModel();

        // Get car details
        $car = $carModel->find($car_id);

        // Check if car exists
        if (!$car) {
            return redirect()->to('/cars');
        }

        // Display edit car form view
        return view('carrentalagency/edit_car', ['car' => $car]);
    }

    public function editCar($car_id)
    {
        // Check if user is logged in as car rental agency
        if (!session()->get('is_agency_logged_in')) {
            return redirect()->to('/login');
        }

        $carModel = new CarRentalAgencyModel();

        // Get car details
        $car = $carModel->find($car_id);

        // Check if car exists
        if (!$car) {
            return redirect()->to('/cars');
        }

        // Validate input data
        $validation = \Config\Services::validation();
        $validation->setRules([
            'model' => 'required',
            'vehicle_number' => 'required|alpha_numeric',
            'seating_capacity' => 'required|numeric',
            'rent_per_day' => 'required|numeric',
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            // Return back to edit car form with validation errors
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Update car details
        $data = [
            'model' => $this->request->getPost('model'),
            'vehicle_number' => $this->request->getPost('vehicle_number'),
            'seating_capacity' => $this->request->getPost('seating_capacity'),
            'rent_per_day' => $this->request->getPost('rent_per_day'),
        ];
        if (!$carModel->updateCar($car_id, $data)) {
            // Return back to edit car form with error message
            return redirect()->back()->withInput()->with('error', 'Failed to update car details.');
        }

        // Redirect to cars page with success message
        return redirect()->to('/cars')->with('success', 'Car details updated successfully.');
    }

    // Method to view all available cars
    public function viewAvailableCars()
    {
        $carModel = new CarsModel();
        $cars = $carModel->where('is_booked', 0)->findAll();

        $data = [
            'cars' => $cars,
        ];

        if (session()->get('isLoggedIn')) {
            // Show dropdown for number of days and start date
            return view('carrentalagency/available_cars_logged_in', $data);
        } else {
            return view('carrentalagency/available_cars', $data);
        }
    }

    // Method to handle renting a car
    public function rentCar($car_id)
    {
        if (!session()->get('isLoggedIn')) {
            // If customer is not logged in, redirect to login page
            return redirect()->to('/login');
        }

        $carModel = new CarsModel();
        $car = $carModel->find($car_id);

        if (!$car || $car['is_booked'] == 1) {
            // If car does not exist or is already booked, redirect to available cars page
            return redirect()->to('/available-cars');
        }

        if (session()->get('role') == 'agency') {
            // If user is an agency, do not allow renting of car
            return redirect()->to('/available-cars');
        }

        // Rent the car
        $bookingModel = new BookingModel();
        $bookingData = [
            'car_id' => $car_id,
            'customer_id' => session()->get('id'),
            'start_date' => $this->request->getVar('start_date'),
            'num_days' => $this->request->getVar('num_days'),
        ];
        $bookingModel->insert($bookingData);

        // Update car as booked
        $car['is_booked'] = 1;
        $carModel->update($car_id, $car);

        return redirect()->to('/my-bookings');
    }

    // Method to view booked cars for a car agency
    public function viewBookedCars($car_id)
    {
        if (session()->get('role') != 'agency') {
            // If user is not a car agency, redirect to available cars page
            return redirect()->to('/available-cars');
        }

        $carModel = new CarsModel();
        $car = $carModel->find($car_id);

        if (!$car) {
            // If car does not exist, redirect to available cars page
            return redirect()->to('/available-cars');
        }

        $bookingModel = new BookingModel();
        $bookings = $bookingModel->getBookingsForCar($car_id);

        $data = [
            'car' => $car,
            'bookings' => $bookings,
        ];

        return view('carrentalagency/view_booked_cars', $data);
    }
}
