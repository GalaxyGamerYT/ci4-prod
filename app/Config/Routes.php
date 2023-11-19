<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultController('Register');
$routes->get('/', 'Register::index', ['filter' => 'guestFilter']);
$routes->get('/register', 'Register::index', ['filter' => 'guestFilter']);
$routes->post('/register', 'Register::register', ['filter' => 'guestFilter']);

$routes->get('/login', 'Login::index', ['filter' => 'guestFilter']);
$routes->post('/login', 'Login::authenticate', ['filter' => 'guestFilter']);

$routes->get('/logout', 'Login::logout', ['filter' => 'authFilter']);
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'authFilter']);
$routes->get('/preferences', 'Preferences::index', ['filter' => 'authFilter']);
$routes->post('/preferences', 'Preferences::submit', ['filter' => 'authFilter']);

$routes->get('/admin', 'Admin::index', ['filter' => ['authFilter', 'adminFilter']]);
$routes->get('/admin/users', 'Admin::users', ['filter' => ['authFilter', 'adminFilter']]);
$routes->get('/admin/users/(:segment)', 'Admin::showUsers/$1', ['filter' => ['authFilter', 'adminFilter']]);
$routes->post('/admin/users/(:segment)', 'Admin::submitUsers/$1', ['filter' => ['authFilter', 'adminFilter']]);
$routes->get('/admin/users/(:segment)/access', 'Admin::showUserPrivileges/$1', ['filter' => ['authFilter', 'adminFilter']]);
$routes->post('/admin/users/(:segment)/access', 'Admin::submitUserPrivileges/$1', ['filter' => ['authFilter', 'adminFilter']]);