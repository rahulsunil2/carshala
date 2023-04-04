<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\Controller;

class Customers extends Controller
{
    public function logout()
    {
        // Destroy the customer session
        $session = session();
        $session->destroy();

        // Redirect to the login page
        return redirect()->to(site_url('login'));
    }

    public function viewBookings()
    {
        // Get the customer session
        $session = session();
        $customer = $session->get('customer');

        // Check if the customer is logged in
        if (!$customer) {
            // Redirect to the login page
            return redirect()->to(site_url('login'));
        }

        // Get the customer bookings
        $model = new CustomerModel();
        $bookings = $model->getBookings()->where('customer_id', $customer['id'])->findAll();

        // Load the bookings view with the bookings data
        $data['bookings'] = $bookings;
        return view('customers/bookings', $data);
    }
}
