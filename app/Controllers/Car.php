<?php

namespace App\Controllers;

class Car extends BaseController
{
    public function index()
    {
        return view('view_cars');
    }

    public function add()
    {
        return view('add_car');
    }
}
