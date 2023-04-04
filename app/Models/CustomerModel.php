<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{

    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password'];

    public function getCustomerByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function createCustomer($data)
    {
        return $this->insert($data);
    }

    public function updateCustomer($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteCustomer($id)
    {
        return $this->delete($id);
    }

    public function getBookings()
    {
        // return $this->hasMany('App\Models\BookingModel', 'customer_id', 'id');
        $query = $this->db->query("
            SELECT *
            FROM bookings
            WHERE customer_id = ?
        ", [$this->id]);
        return $query->getResult();
    }
}
