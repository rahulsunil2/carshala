<?php

namespace App\Models;

use CodeIgniter\Model;

class CarsModel extends Model
{
    protected $table = 'cars';
    protected $primaryKey = 'id';
    protected $allowedFields = ['vehicle_model', 'vehicle_number', 'seating_capacity', 'rent_per_day', 'car_rental_agency_id'];

    public function getAvailableCars()
    {
        // Return Cars that are not in bookings table
        $query = $this->db->query("
            SELECT *
            FROM cars
            WHERE id NOT IN (
                SELECT car_id FROM bookings
            )
        ");
        return $query->getResultArray();
    }

    public function getCarByID($id)
    {
        return $this->where('id', $id)
            ->select('id, vehicle_model, vehicle_number, seating_capacity, rent_per_day')
            ->first();
    }

    public function addCar($data)
    {
        $this->insert($data);
        return $this->insertID();
    }

    public function updateCar($id, $data)
    {
        $this->update($id, $data);
    }

    public function deleteCar($id)
    {
        $this->delete($id);
    }
}
