<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Welcome to CarShala'
        ];
        return view('home', $data);
    }
}
