<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth::login');
$routes->get('/signup', 'Auth::signup');
$routes->post('/signup', 'Auth::signupSubmit');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::loginSubmit');
$routes->get('/logout', 'Auth::logout');

$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/todos', 'Todos::index');
    $routes->get('/todos/create', 'Todos::create');
    $routes->post('/todos/store', 'Todos::store');
    $routes->post('/todos/update/(:num)', 'Todos::update/$1');
    $routes->post('/todos/delete/(:num)', 'Todos::delete/$1');
});
