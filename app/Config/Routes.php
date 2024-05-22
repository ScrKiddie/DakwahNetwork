<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Admin::dashboard');
$routes->get('/admin/dashboard', 'Admin::dashboard');
$routes->get('/admin/penyelenggara', 'Admin::penyelenggara');
$routes->get('/admin/penyelenggara/new', 'Admin::newPenyelenggara');
$routes->post('/admin/penyelenggara/add', 'Admin::addPenyelenggara');
