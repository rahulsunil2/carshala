<?php

namespace App\Models;

use CodeIgniter\Model;

class CarsModel extends Model
{
    protected $table = 'cars';
    protected $primaryKey = 'id';
    protected $allowedFields = ['vehicle_model', 'vehicle_number', 'seating_capacity', 'rent_per_day', 'car_rental_agency_id'];

    // Function to get all available cars to rent
    public function getAvailableCars()
    {
        return $this->where('available', 1)
            ->select('id, vehicle_model, vehicle_number, seating_capacity, rent_per_day')
            ->findAll();
    }

    // Function to get a specific car by its ID
    public function getCarByID($id)
    {
        return $this->where('id', $id)
            ->select('id, vehicle_model, vehicle_number, seating_capacity, rent_per_day')
            ->first();
    }

    // Function to add a new car
    public function addCar($data)
    {
        $this->insert($data);
        return $this->db->insertID();
    }

    // Function to update a car
    public function updateCar($id, $data)
    {
        $this->update($id, $data);
    }

    // Function to delete a car
    public function deleteCar($id)
    {
        $this->delete($id);
    }

    // Function to check if a car is available for a given date range
    public function isCarAvailable($car_id, $start_date, $end_date)
    {
        $query = $this->db->query("
            SELECT COUNT(*) as count
            FROM Bookings
            WHERE car_id = ? AND booking_start_date <= ? AND booking_end_date >= ?
        ", [$car_id, $end_date, $start_date]);
        $row = $query->getRow();
        return ($row->count == 0);
    }
}
