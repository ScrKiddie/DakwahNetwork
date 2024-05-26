<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Admin::dashboard', ['filter' => 'authorization']);
$routes->get('/admin/dashboard', 'Admin::dashboard',['filter' => 'authorization']);
$routes->get('/admin/penyelenggara', 'Admin::penyelenggara',['filter' => 'authorization']);

$routes->get('/admin/penyelenggara/new', 'Admin::newPenyelenggara',['filter' => 'authorization']);
$routes->post('/admin/penyelenggara/add', 'Admin::addPenyelenggara',['filter' => 'authorization']);

$routes->get('/admin/penyelenggara/edit', 'Admin::editPenyelenggara',['filter' => 'authorization']);
$routes->post('/admin/penyelenggara/update', 'Admin::updatePenyelenggara',['filter' => 'authorization']);

$routes->post('/admin/penyelenggara/delete', 'Admin::deletePenyelenggara',['filter' => 'authorization']);

$routes->get('/admin/penyelenggara/registered', 'Admin::registeredPenyelenggara',['filter' => 'authorization']);
$routes->post('/admin/penyelenggara/accept', 'Admin::acceptPenyelenggara',['filter' => 'authorization']);

$routes->get('admin/dakwah', 'Admin::dakwah',['filter' => 'authorization']);
$routes->get('admin/dakwah/new', 'Admin::newDakwah',['filter' => 'authorization']);

$routes->post('admin/dakwah/add', 'Admin::addDakwah',['filter' => 'authorization']);

$routes->get('admin/dakwah/edit', 'Admin::editDakwah',['filter' => 'authorization']);
$routes->post('admin/dakwah/update', 'Admin::updateDakwah',['filter' => 'authorization']);
$routes->post('admin/dakwah/delete', 'Admin::deleteDakwah',['filter' => 'authorization']);
$routes->get('admin/dakwah/histori', 'Admin::historiDakwah',['filter' => 'authorization']);
$routes->post('admin/dakwah/done', 'Admin::doneDakwah',['filter' => 'authorization']);

$routes->get('admin/login', 'Authentication::adminLogin');
$routes->post('admin/auth', 'Authentication::adminAuthentication');

$routes->get('admin/profile', 'Admin::adminProfile',['filter' => 'authorization']);
$routes->post('admin/profile/save', 'Admin::saveAdminProfile',['filter' => 'authorization']);
$routes->get('admin/password', 'Admin::passwordAdmin',['filter' => 'authorization']);
$routes->post('admin/password/update', 'Admin::updatePasswordAdmin',['filter' => 'authorization']);

$routes->get('admin/logout', 'Admin::logoutAdmin',['filter' => 'authorization']);


