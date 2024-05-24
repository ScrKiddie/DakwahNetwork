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

$routes->get('/admin/penyelenggara/registered', 'Admin::registeredPenyelenggara');
$routes->post('/admin/penyelenggara/accept', 'Admin::acceptPenyelenggara');

$routes->get('admin/dakwah', 'Admin::dakwah');
$routes->get('admin/dakwah/new', 'Admin::newDakwah');

$routes->post('admin/dakwah/add', 'Admin::addDakwah');

$routes->get('admin/dakwah/edit', 'Admin::editDakwah');
$routes->post('admin/dakwah/update', 'Admin::updateDakwah');
$routes->post('admin/dakwah/delete', 'Admin::deleteDakwah');
