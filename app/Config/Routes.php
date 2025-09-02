<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/','Home::index') ;
$routes->post('auth/register', 'Auth::register');
$routes->post('auth/login', 'Auth::login');
$routes->get('auth/users', 'Auth::sendAllUser');
$routes->get('auth/teacher', 'Teacher::index');
$routes->get('auth/teacher/(:num)', 'Teacher::show/$1');
$routes->put('auth/teacher/(:num)', 'Teacher::update/$1');
$routes->patch('auth/teacher/(:num)', 'Teacher::update/$1');
