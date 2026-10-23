<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Welcome page
$routes->get('/', 'Home::index');
$routes->get('home/view', 'Pages::landing');

// Public pages
$routes->get('about', 'Pages::about');
$routes->get('profile', 'Pages::profile');

// Authentication
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

// Task List - public
$routes->get('tasks', 'Tasks::index');

// Task management - login required
$routes->get('tasks/new', 'Tasks::new', ['filter' => 'auth']);
$routes->post('tasks/create', 'Tasks::create', ['filter' => 'auth']);
$routes->get('tasks/edit/(:num)', 'Tasks::edit/$1', ['filter' => 'auth']);
$routes->post('tasks/update/(:num)', 'Tasks::update/$1', ['filter' => 'auth']);
$routes->post('tasks/archive/(:num)', 'Tasks::archive/$1', ['filter' => 'auth']);

// Categories
$routes->get('categories', 'Categories::index');

// Customer routes - login required
$routes->group('customers', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Customers::index');
    $routes->get('new', 'Customers::new');
    $routes->post('create', 'Customers::create');
    $routes->get('edit/(:num)', 'Customers::edit/$1');
    $routes->post('update/(:num)', 'Customers::update/$1');
    $routes->post('delete/(:num)', 'Customers::delete/$1');
});

// User/staff routes - login required
$routes->group('users', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Users::index');
    $routes->get('new', 'Users::new');
    $routes->post('create', 'Users::create');
    $routes->get('edit/(:num)', 'Users::edit/$1');
    $routes->post('update/(:num)', 'Users::update/$1');
    $routes->post('delete/(:num)', 'Users::delete/$1');
});

// Product routes - login required
$routes->group('products', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Products::index');
    $routes->get('new', 'Products::new');
    $routes->post('create', 'Products::create');
    $routes->get('edit/(:num)', 'Products::edit/$1');
    $routes->post('update/(:num)', 'Products::update/$1');
    $routes->post('delete/(:num)', 'Products::delete/$1');
});

// Sales routes - login required
$routes->group('sales', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Sales::index');
    $routes->post('create', 'Sales::create');
    $routes->get('history', 'Sales::history');
});