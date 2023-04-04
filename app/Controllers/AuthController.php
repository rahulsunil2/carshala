<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\CarRentalAgencyModel;

class AuthController extends BaseController
{
    public function registerCustomer()
    {
        helper(['form']);

        $rules = [
            'name' => 'required',
            'email' => 'required|valid_email|is_unique[customers.email]',
            'password' => 'required|min_length[8]',
        ];

        if ($this->validate($rules)) {
            $customerModel = new CustomerModel();
            $customerModel->createCustomer([
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ]);
            return redirect()->to('/login');
        } else {
            return view('register_customer');
        }
    }

    public function registerAgency()
    {
        helper(['form']);

        $rules = [
            'name' => 'required',
            'email' => 'required|valid_email|is_unique[carrentalagency.email]',
            'password' => 'required|min_length[8]',
        ];

        if ($this->validate($rules)) {
            $agencyModel = new CarRentalAgencyModel();
            $agencyModel->createCustomer([
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ]);
            return redirect()->to('/login');
        } else {
            return view('register_agency');
        }
    }

    // Login method
    public function login()
    {
        // Get request instance
        $request = service('request');

        // Get user type from POST request
        $userType = $request->getPost('user_type');

        // Get email and password from POST request
        $email = $request->getPost('email');
        $password = $request->getPost('password');

        // Validate email and password
        $isValid = false;
        $userData = null;
        if ($userType === 'customer') {
            $customerModel = new CustomerModel();
            $userData = $customerModel->getCustomerByEmail($email);
            if ($userData && password_verify($password, $userData['password'])) {
                $isValid = true;
            }
        } elseif ($userType === 'agency') {
            $agencyModel = new CarRentalAgencyModel();
            $userData = $agencyModel->getAgencyByEmail($email);
            if ($userData && password_verify($password, $userData['password'])) {
                $isValid = true;
            }
        }

        // If valid, create session and redirect to home page
        if ($isValid) {
            $session = session();
            $sessionData = [
                'id' => $userData['id'],
                'name' => $userData['name'],
                'email' => $userData['email'],
                'user_type' => $userType,
                'isLoggedIn' => true
            ];
            $session->set($sessionData);
            return redirect()->to(base_url('/'));
        }

        // If invalid, show error message
        $data['error'] = 'Invalid email or password';
        return view('login', $data);
    }

    // Logout method
    public function logout()
    {
        // Destroy session and redirect to login page
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/login'));
    }
}
