<?php

namespace App\Models;

use CodeIgniter\Model;

class CarRentalAgencyModel extends Model
{
    protected $table = 'carrentalagency';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password'];

    public function getCars($agency_id)
    {
        $db = db_connect();
        $query = $db->query("SELECT * FROM cars WHERE car_rental_agency_id = $agency_id");
        return $query->getResult();
    }

    public function addCar($data)
    {
        $db = db_connect();
        $builder = $db->table('cars');
        $builder->insert($data);
        return $db->affectedRows() > 0;
    }

    public function updateCar($car_id, $data)
    {
        $db = db_connect();
        $builder = $db->table('cars');
        $builder->where('id', $car_id);
        $builder->update($data);
        return $db->affectedRows() > 0;
    }

    public function getBookedCars($car_id)
    {
        $db = db_connect();
        $query = $db->query("SELECT bookings.*, customers.name AS customer_name FROM bookings INNER JOIN customers ON bookings.customer_id = customers.id WHERE bookings.car_id = $car_id");
        return $query->getResult();
    }
}
