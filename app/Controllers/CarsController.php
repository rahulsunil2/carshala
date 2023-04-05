<?php

namespace App\Controllers;

use App\Models\CarsModel;
use App\Models\BookingModel;
use App\Models\UserModel;

class CarsController extends BaseController
{
    protected $carsModel;
    protected $bookingModel;

    public function __construct()
    {
        $this->carsModel = new CarsModel();
        $this->bookingModel = new BookingModel();
    }

    public function index()
    {
        if (session()->get('userType') === 'agency') {
            $data['cars'] = $this->carsModel->getCarsByAgencyID(session()->get('user')['id']);
        } else {
            $data['cars'] = $this->carsModel->getCars();
        }
        echo view('cars/index', $data);
    }

    public function add()
    {
        // Check if the user is logged in as a car rental agency
        if (!session()->get('user') || session()->get('userType') !== 'agency') {
            return redirect()->to('/login');
        }

        echo view('cars/add');
    }

    public function save()
    {
        // Check if the user is logged in as a car rental agency
        if (!session()->get('user') || session()->get('userType') !== 'agency') {
            return redirect()->to('/login');
        }

        $data = [
            'vehicle_model' => $this->request->getVar('vehicle_model'),
            'vehicle_number' => $this->request->getVar('vehicle_number'),
            'vehicle_image' => $this->request->getVar('vehicle_image'),
            'seating_capacity' => $this->request->getVar('seating_capacity'),
            'rent_per_day' => $this->request->getVar('rent_per_day'),
            'car_rental_agency_id' => session()->get('user')['id']
        ];

        $this->carsModel->addCar($data);
        return redirect()->to('/cars');
    }

    public function edit($id)
    {
        // Check if the user is logged in as a car rental agency
        if (!session()->get('user') || session()->get('userType') !== 'agency') {
            return redirect()->to('/login');
        }

        $data['car'] = $this->carsModel->getCarByID($id);

        if (empty($data['car'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the car item: ' . $id);
        }

        echo view('cars/edit', $data);
    }

    public function update($id)
    {
        $model = new CarsModel();

        if (!$this->validate([
            'vehicle_model' => 'required',
            'vehicle_number' => 'required',
            'seating_capacity' => 'required|numeric',
            'rent_per_day' => 'required|numeric',
            'vehicle_image' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'vehicle_model' => $this->request->getPost('vehicle_model'),
            'vehicle_number' => $this->request->getPost('vehicle_number'),
            'seating_capacity' => $this->request->getPost('seating_capacity'),
            'rent_per_day' => $this->request->getPost('rent_per_day'),
            'vehicle_image' => $this->request->getVar('vehicle_image'),
        ];

        $model->updateCar($id, $data);

        return redirect()->to('/cars')->with('success', 'Car updated successfully.');
    }

    public function delete($id)
    {
        $model = new CarsModel();

        $model->deleteCar($id);

        return redirect()->to('/cars')->with('success', 'Car deleted successfully.');
    }

    public function book()
    {
        if (!session()->get('user') || session()->get('userType') !== 'customer') {
            return redirect()->to('/login');
        }
        $bookingModel = new BookingModel();
        $car_id = $this->request->getPost('car_id');
        $booking_end_date = date('Y-m-d', strtotime($this->request->getPost('start_date') . ' + ' . $this->request->getPost('no_of_days') . ' days'));

        $carsModel = new CarsModel();

        // Check if car is available for the requested dates
        $isCarAvailable = $carsModel->isCarAvailable($car_id, $this->request->getPost('start_date'), $booking_end_date);

        if (!$isCarAvailable) {
            // Car is not available for the requested dates, show error message
            return redirect()->back()->withInput()->with('error', 'Car is not available for the requested dates.');
        }

        // Add booking details to the database
        $bookingData = [
            'car_id' => $car_id,
            'customer_id' => session()->get('user')['id'],
            'booking_start_date' => $this->request->getPost('start_date'),
            'booking_end_date' => $booking_end_date,
            'total_rent' => $this->request->getPost('rent_per_day') * $this->request->getPost('no_of_days'),
        ];

        $bookingModel->insert($bookingData);

        return redirect()->to('/cars')->with('success', 'Car booked successfully.');
    }

    public function viewAgencyBookings()
    {
        // Check if user is a car rental agency
        if (session()->get('userType') != 'agency') {
            // Redirect to homepage if user is not a car rental agency
            return redirect()->to('/');
        }

        $carsModel = new CarsModel();
        $userModel = new UserModel();
        $bookingModel = new BookingModel();

        // Get cars added by the current agency
        $cars = $carsModel->getCarsByAgencyID(session()->get('user')['id']);

        $bookings = [];

        // Loop through each car and get its bookings
        foreach ($cars as $car) {
            $carBookings = $bookingModel->getBookingsByCarID($car['id']);
            foreach ($carBookings as $booking) {
                $booking['car'] = $car;
                $booking['user'] = $userModel->getUserByID($booking['customer_id']);
                $bookings[] = $booking;
            }
        }

        return view('cars/bookings', [
            'bookings' => $bookings,
            'title' => 'Agency Bookings'
        ]);
    }

    public function viewCustomerBookings()
    {
        // Check if user is a car rental agency
        if (session()->get('userType') != 'customer') {
            // Redirect to homepage if user is not a car rental agency
            return redirect()->to('/');
        }

        $carsModel = new CarsModel();
        $userModel = new UserModel();
        $bookingModel = new BookingModel();

        $bookings = [];

        // Loop through each car and get its bookings
        $carBookings = $bookingModel->getBookingsByCustomerId(session()->get('user')['id']);
        foreach ($carBookings as $booking) {
            $booking['car'] = $carsModel->getCarByID($booking['car_id']);
            $booking['user'] = $userModel->getUserByID($booking['car']['car_rental_agency_id']);
            $bookings[] = $booking;
        }

        return view('cars/bookings', [
            'bookings' => $bookings,
            'title' => 'My Bookings'
        ]);
    }

    public function viewBookingsByCarId($car_id)
    {
        // Check if user is a car rental agency
        if (session()->get('userType') != 'agency') {
            // Redirect to homepage if user is not a car rental agency
            return redirect()->to('/');
        }

        $carsModel = new CarsModel();
        $userModel = new UserModel();

        // Get car details
        $car = $carsModel->getCarByID($car_id);


        $bookings = [];

        // Get bookings for the car
        $carBookings = $this->bookingModel->getBookingsByCarID($car_id);

        foreach ($carBookings as $booking) {
            $booking['customer'] = $userModel->getUserByID($booking['customer_id']);
            $bookings[] = $booking;
        }

        return view('cars/bookings_by_car', [
            'bookings' => $bookings,
            'car' => $car
        ]);
    }
}
