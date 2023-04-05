<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function register($type)
    {
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

        if (!$this->validate([
            'name' => 'required|min_length[3]|max_length[50]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'type' => $this->request->getVar('user_type'),
        ];

        $this->userModel->createUser($data);
        session()->setFlashdata('success', 'Registration successful. Please login to continue.');
        return redirect()->to(site_url('login'));
    }


    public function login()
    {
        return view('user/login');
    }


    public function authenticate()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $this->userModel->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $session = session();
            $session->set('user', $user);
            $session->set('userType', $user['type']);

            return redirect()->to(site_url('/'));
        } else {
            $data['error'] = 'Invalid email or password';
            return view('user/login', $data);
        }
    }


    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/login'));
    }
}
