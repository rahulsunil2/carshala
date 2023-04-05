<?php

namespace App\Controllers;

use App\Models\CarsModel;

class CarsController extends BaseController
{
    protected $carsModel;

    public function __construct()
    {
        $this->carsModel = new CarsModel();
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

        $this->carsModel->updateCar($id, $data);

        return redirect()->to('/cars')->with('success', 'Car updated successfully.');
    }

    public function delete($id)
    {

        $this->carsModel->deleteCar($id);

        return redirect()->to('/cars')->with('success', 'Car deleted successfully.');
    }
}
