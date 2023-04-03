<?php

namespace App\Controllers;

class Car extends BaseController
{
    public function index($page = 'car')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('view_cars')
            . view('templates/footer');
    }

    public function add()
    {
        return view('add_car');
    }
}
