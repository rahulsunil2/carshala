<?php

namespace App\Controllers;

// use App\Models\CustomerModel;
// use App\Models\CarRentalAgencyModel;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function registerCustomer()
    {
        // Load the registration view for customers
        return view('auth/register', [
            'title' => 'Customer Registration',
            'user_type' => 'customer',
        ]);
    }

    public function registerAgency()
    {
        // Load the registration view for agency
        return view('auth/register', [
            'title' => 'Agency Registration',
            'user_type' => 'agency',
        ]);
    }

    public function create()
    {
        // Get the customer model
        $model = new UserModel();

        // Get the form input data
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'type' => $this->request->getVar('user_type'),
        ];

        // Create the customer record
        $model->createUser($data);

        // Redirect to the login page
        return redirect()->to(site_url('login'));
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
            $customerModel = new UserModel();
            $userData = $customerModel->getUserByEmail($email);
            if ($userData && password_verify($password, $userData['password'])) {
                $isValid = true;
            }
        } elseif ($userType === 'agency') {
            $agencyModel = new UserModel();
            $userData = $agencyModel->getUserByEmail($email);
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
        return view('auth/login', $data);
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
