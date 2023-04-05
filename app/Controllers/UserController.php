<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function register($type)
    {
        // Load the registration view for customers

        if ($type == 'customer')
            $data = [
                'title' => 'Customer Registration',
                'user_type' => $type,
            ];
        else
            $data = [
                'title' => 'Agency Registration',
                'user_type' => $type,
            ];
        return view('user/register', $data);
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
        // Load the login view for customers
        return view('user/login');
    }

    public function authenticate()
    {
        // Get the user model
        $model = new UserModel();

        // Get the form input data
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Get the user record by email
        $user = $model->getUserByEmail($email);

        // Check if the user exists and the password is correct
        if ($user && password_verify($password, $user['password'])) {
            // Set the user session
            $session = session();
            $session->set('user', $user);
            $session->set('userType', $user['type']);

            // Redirect to the home page
            return redirect()->to(site_url('/'));
        } else {
            // Set the error message
            $data['error'] = 'Invalid email or password';

            // Load the login view with error message
            return view('user/login', $data);
        }
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
