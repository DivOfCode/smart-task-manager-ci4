<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
$routes->get('/login', 'Auth::login');
$routes->post('/loginProcess', 'Auth::loginProcess');
$routes->get('/register', 'Auth::register');
$routes->post('/registerProcess', 'Auth::registerProcess');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Dashboard::index');


$routes->get('/projects', 'Projects::index');
$routes->get('/projects/create', 'Projects::create');
$routes->post('/projects/store', 'Projects::store');
$routes->get('/projects/edit/(:num)', 'Projects::edit/$1');
$routes->post('/projects/update/(:num)', 'Projects::update/$1');
$routes->get('/projects/delete/(:num)', 'Projects::delete/$1');

$routes->get('/tasks', 'Tasks::index');
$routes->get('/tasks/create', 'Tasks::create');
$routes->post('/tasks/store', 'Tasks::store');
$routes->get('/tasks/edit/(:num)', 'Tasks::edit/$1');
$routes->post('/tasks/update/(:num)', 'Tasks::update/$1');
$routes->get('/tasks/delete/(:num)', 'Tasks::delete/$1');

$routes->get('users', 'UserController::index');
$routes->post('users/toggle-status/(:num)', 'UserController::toggleStatus/$1'); 
$routes->post('users/change-role/(:num)', 'UserController::changeRole/$1'); 
$routes->post('users/delete/(:num)', 'UserController::delete/$1');    