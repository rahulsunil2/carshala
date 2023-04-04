<?php

namespace App\Models;

use CodeIgniter\Model;

class CarRentalAgencyModel extends Model
{
    protected $table = 'carrentalagency';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password'];

    public function getAgencyByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function createAgency($data)
    {
        return $this->insert($data);
    }

    public function updateAgency($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteAgency($id)
    {
        return $this->delete($id);
    }

    public function getCars($agency_id)
    {
        $query = $this->db->query("SELECT * FROM cars WHERE car_rental_agency_id = $agency_id");
        return $query->getResult();
    }

    public function addCar($data)
    {
        $builder = $this->db->table('cars');
        $builder->insert($data);
        return $this->db->affectedRows() > 0;
    }

    public function updateCar($car_id, $data)
    {
        $builder = $this->db->table('cars');
        $builder->where('id', $car_id);
        $builder->update($data);
        return $this->db->affectedRows() > 0;
    }

    public function getBookedCars($car_id)
    {
        $query = $this->db->query("SELECT bookings.*, customers.name AS customer_name FROM bookings INNER JOIN customers ON bookings.customer_id = customers.id WHERE bookings.car_id = $car_id");
        return $query->getResult();
    }
}
