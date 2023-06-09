<?php

namespace App\Controllers;

use App\Models\CarsModel;
use App\Models\BookingModel;
use App\Models\UserModel;

class BookingController extends BaseController
{
    protected $carsModel;
    protected $bookingModel;
    protected $userModel;

    public function __construct()
    {
        $this->carsModel = new CarsModel();
        $this->bookingModel = new BookingModel();
        $this->userModel = new UserModel();
    }

    public function book()
    {
        if (!session()->get('user') || session()->get('userType') !== 'customer') {
            return redirect()->to('/login');
        }

        $car_id = $this->request->getPost('car_id');
        $booking_end_date = date('Y-m-d', strtotime($this->request->getPost('start_date') . ' + ' . $this->request->getPost('no_of_days') . ' days'));
        $isCarAvailable = $this->carsModel->isCarAvailable($car_id, $this->request->getPost('start_date'), $booking_end_date);

        if (!$isCarAvailable) {
            return redirect()->back()->withInput()->with('error', 'Car is not available for the requested dates.');
        }

        $bookingData = [
            'car_id' => $car_id,
            'customer_id' => session()->get('user')['id'],
            'booking_start_date' => $this->request->getPost('start_date'),
            'booking_end_date' => $booking_end_date,
            'total_rent' => $this->request->getPost('rent_per_day') * $this->request->getPost('no_of_days'),
        ];

        $this->bookingModel->insert($bookingData);

        return redirect()->to('/cars')->with('success', 'Car booked successfully.');
    }

    public function viewAgencyBookings()
    {
        if (session()->get('userType') != 'agency') {
            return redirect()->to('/');
        }

        $cars = $this->carsModel->getCarsByAgencyID(session()->get('user')['id']);
        $bookings = [];

        foreach ($cars as $car) {
            $carBookings = $this->bookingModel->getBookingsByCarID($car['id']);
            foreach ($carBookings as $booking) {
                $booking['car'] = $car;
                $booking['user'] = $this->userModel->getUserByID($booking['customer_id']);
                $booking['no_of_days'] = (strtotime($booking['booking_end_date']) - strtotime($booking['booking_start_date'])) / (60 * 60 * 24);
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
        if (session()->get('userType') != 'customer') {
            return redirect()->to('/');
        }

        $bookings = [];
        $carBookings = $this->bookingModel->getBookingsByCustomerId(session()->get('user')['id']);

        foreach ($carBookings as $booking) {
            $booking['car'] = $this->carsModel->getCarByID($booking['car_id']);
            $booking['user'] = $this->userModel->getUserByID($booking['car']['car_rental_agency_id']);
            $booking['no_of_days'] = (strtotime($booking['booking_end_date']) - strtotime($booking['booking_start_date'])) / (60 * 60 * 24);
            $bookings[] = $booking;
        }

        return view('cars/bookings', [
            'bookings' => $bookings,
            'title' => 'My Bookings'
        ]);
    }

    public function viewBookingsByCarId($car_id)
    {
        if (session()->get('userType') != 'agency') {
            return redirect()->to('/');
        }

        $car = $this->carsModel->getCarByID($car_id);
        $bookings = [];
        $carBookings = $this->bookingModel->getBookingsByCarID($car_id);

        foreach ($carBookings as $booking) {
            $booking['customer'] = $this->userModel->getUserByID($booking['customer_id']);
            $bookings[] = $booking;
        }

        return view('cars/bookings_by_car', [
            'bookings' => $bookings,
            'car' => $car
        ]);
    }
}
