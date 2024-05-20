<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Admin::dashboard');
$routes->get('/admin/dashboard', 'Admin::dashboard');
$routes->get('/admin/pengguna', 'Admin::pengguna');
