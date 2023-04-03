<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\Controller;

class Customers extends Controller
{
    public function register()
    {
        // Load the registration view for customers
        return view('customers/register');
    }

    public function create()
    {
        // Get the customer model
        $model = new CustomerModel();

        // Get the form input data
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        ];

        // Create the customer record
        $model->createCustomer($data);

        // Redirect to the login page
        return redirect()->to(site_url('login'));
    }

    public function login()
    {
        // Load the login view for customers
        return view('customers/login');
    }

    public function authenticate()
    {
        // Get the customer model
        $model = new CustomerModel();

        // Get the form input data
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Get the customer record by email
        $customer = $model->getCustomerByEmail($email);

        // Check if the customer exists and the password is correct
        if ($customer && password_verify($password, $customer['password'])) {
            // Set the customer session
            $session = session();
            $session->set('customer', $customer);

            // Redirect to the home page
            return redirect()->to(site_url('/'));
        } else {
            // Set the error message
            $data['error'] = 'Invalid email or password';

            // Load the login view with error message
            return view('customers/login', $data);
        }
    }

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
