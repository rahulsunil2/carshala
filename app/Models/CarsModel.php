<?php

namespace App\Models;

use CodeIgniter\Model;

class CarsModel extends Model
{
    protected $table = 'cars';
    protected $primaryKey = 'id';
    protected $allowedFields = ['vehicle_model', 'vehicle_number', 'seating_capacity', 'rent_per_day', 'car_rental_agency_id'];



    public function getCars()
    {
        return $this->select('id, vehicle_model, vehicle_number, seating_capacity, rent_per_day')
            ->orderBy('id', 'DESC')
            ->findAll();
    }

    public function getCarsByUserID($agency_id)
    {
        return $this->where('car_rental_agency_id', $agency_id)
            ->select('id, vehicle_model, vehicle_number, seating_capacity, rent_per_day')
            ->orderBy('id', 'DESC')
            ->findAll();
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
