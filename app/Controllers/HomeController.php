<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        if (session()->get('userType') === 'agency') {
            return redirect()->to('/cars/agency-bookings');
        } else {
            return redirect()->to('/cars');
        }
    }
}
