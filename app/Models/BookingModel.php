<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'customer_id',
        'car_id',
        'booking_start_date',
        'booking_end_date',
        'total_rent'
    ];

    public function addBooking($data)
    {
        $this->insert($data);
        return $this->insertID();
    }

    public function getBookingById($id)
    {
        $query = $this->select('bookings.*, cars.vehicle_model, cars.vehicle_number')
            ->join('cars', 'cars.id = bookings.car_id')
            ->where('bookings.id', $id)
            ->get();
        return $query->getRow();
    }

    public function getBookingsByCustomerId($customer_id)
    {
        $query = $this->select('bookings.*, cars.vehicle_model, cars.vehicle_number')
            ->join('cars', 'cars.id = bookings.car_id')
            ->where('bookings.customer_id', $customer_id)
            ->orderBy('bookings.booking_start_date', 'ASC')
            ->get();
        return $query->getResultArray();
    }

    public function getBookingsByCarId($car_id)
    {
        $query = $this->select('bookings.*, cars.vehicle_model, cars.vehicle_number')
            ->join('cars', 'cars.id = bookings.car_id')
            ->where('bookings.car_id', $car_id)
            ->orderBy('bookings.booking_start_date', 'ASC')
            ->get();
        return $query->getResultArray();
    }
}
