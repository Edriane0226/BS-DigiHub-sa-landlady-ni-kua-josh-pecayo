<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/**
 * @var RouteCollection $routes
 */
// Home
$routes->get('/', 'Home::index');
$routes->get('dashboard', 'Home::dashboard');

// Products
$routes->get('products', 'Products::index');
$routes->get('products/create', 'Products::create');
$routes->post('products/store', 'Products::store');
$routes->get('products/edit/(:num)', 'Products::edit/$1');
$routes->post('products/update/(:num)', 'Products::update/$1');
$routes->get('products/delete/(:num)', 'Products::delete/$1');

// Suppliers
$routes->get('suppliers', 'Suppliers::index');
$routes->get('suppliers/create', 'Suppliers::create');
$routes->post('suppliers/store', 'Suppliers::store');
$routes->get('suppliers/edit/(:num)', 'Suppliers::edit/$1');
$routes->post('suppliers/update/(:num)', 'Suppliers::update/$1');
$routes->get('suppliers/delete/(:num)', 'Suppliers::delete/$1');
$routes->get('suppliers/view/(:num)', 'Suppliers::view/$1');

// Reports
$routes->get('reports', 'Reports::index');
$routes->get('reports/inventory', 'Reports::inventory');
$routes->get('reports/suppliers', 'Reports::suppliers');
$routes->get('reports/compatibility', 'Reports::compatibility');
$routes->get('reports/export/(:segment)', 'Reports::export/$1');


// Car Models
$routes->get('car-models', 'CarModels::index');
$routes->get('car-models/create', 'CarModels::create');
$routes->post('car-models/store', 'CarModels::store');
$routes->get('car-models/delete/(:num)', 'CarModels::delete/$1');


// Compatibility
$routes->get('compatibility/remove/(:num)', 'Compatibility::remove/$1');
