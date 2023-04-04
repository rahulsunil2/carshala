<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('agency', function ($routes) {

    $routes->get('register', 'CarRentalAgency::register');
    $routes->get('login', 'CarRentalAgency::login');
    $routes->get('add-car-form', 'CarRentalAgency::addCarForm');
    $routes->post('add-car', 'CarRentalAgency::addCar');
    $routes->get('edit-car-form/(:num)', 'CarRentalAgency::editCarForm/$1');
    $routes->post('edit-car/(:num)', 'CarRentalAgency::editCar/$1');
    $routes->get('available-cars', 'CarRentalAgency::viewAvailableCars');
    $routes->get('rent-car/(:num)', 'CarRentalAgency::rentCar/$1');
    $routes->get('booked-cars/(:num)', 'CarRentalAgency::viewBookedCars/$1');
});

$routes->group('customers', function ($routes) {

    $routes->get('register', 'Customers::register');
    $routes->post('create', 'Customers::create');
    $routes->get('login', 'Customers::login');
    $routes->post('authenticate', 'Customers::authenticate');
    $routes->get('logout', 'Customers::logout');
    $routes->get('bookings', 'Customers::viewBookings');
});

$routes->group('cars', function ($routes) {

    $routes->get('/', 'Cars::index');
    $routes->get('add', 'Cars::add');
    $routes->post('save', 'Cars::save');
    $routes->get('edit/(:num)', 'Cars::edit/$1');
    $routes->post('update/(:num)', 'Cars::update/$1');
    $routes->get('delete/(:num)', 'Cars::delete/$1');
    $routes->get('book/(:num)', 'Cars::book/$1');
    $routes->get('booked-cars', 'Cars::viewBookedCars');
});

$routes->group('auth', function ($routes) {
    $routes->get('register/customer', 'AuthController::registerCustomer');
    $routes->get('register/agency', 'AuthController::registerAgency');
    $routes->get('login', 'AuthController::login');
    $routes->get('logout', 'AuthController::logout');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
