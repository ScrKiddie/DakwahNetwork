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

$routes->get('/admin/penyelenggara/edit', 'Admin::editPenyelenggara');
$routes->post('/admin/penyelenggara/update', 'Admin::updatePenyelenggara');

$routes->post('/admin/penyelenggara/delete', 'Admin::deletePenyelenggara');
