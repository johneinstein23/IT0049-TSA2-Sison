<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Dashboard::index');
$routes->get('tasks', 'Tasks::index');
$routes->get('profile', 'Profile::index');
$routes->get('about', 'Pages::about');

$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attempt');
$routes->post('logout', 'Auth::logout');

$routes->get('tasks/new', 'Tasks::newTask', ['filter' => 'auth']);
$routes->post('tasks', 'Tasks::create', ['filter' => 'auth']);
$routes->get('tasks/(:num)/edit', 'Tasks::edit/$1', ['filter' => 'auth']);
$routes->post('tasks/(:num)/edit', 'Tasks::update/$1', ['filter' => 'auth']);
$routes->post('tasks/(:num)/archive', 'Tasks::archive/$1', ['filter' => 'auth']);
