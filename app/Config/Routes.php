<?php 
 
use CodeIgniter\Router\RouteCollection; 
 
/** @var RouteCollection $routes */ 

$routes->get('/', 'Home::index');

$routes->get('home/view', 'Pages::landing');
$routes->get('about', 'Pages::about');
$routes->get('customers', 'Customers::index');
$routes->get('users', 'Users::index');
$routes->get('categories', 'Categories::index');