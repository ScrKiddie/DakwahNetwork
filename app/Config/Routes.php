<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/admin/dashboard', 'Admin::dashboard',['filter' => 'adminAuthorization']);
$routes->get('/admin/penyelenggara', 'Admin::penyelenggara',['filter' => 'adminAuthorization']);

$routes->get('/admin/penyelenggara/new', 'Admin::newPenyelenggara',['filter' => 'adminAuthorization']);
$routes->post('/admin/penyelenggara/add', 'Admin::addPenyelenggara',['filter' => 'adminAuthorization']);

$routes->get('/admin/penyelenggara/edit', 'Admin::editPenyelenggara',['filter' => 'adminAuthorization']);
$routes->post('/admin/penyelenggara/update', 'Admin::updatePenyelenggara',['filter' => 'adminAuthorization']);

$routes->post('/admin/penyelenggara/delete', 'Admin::deletePenyelenggara',['filter' => 'adminAuthorization']);

$routes->get('/admin/penyelenggara/registered', 'Admin::registeredPenyelenggara',['filter' => 'adminAuthorization']);
$routes->post('/admin/penyelenggara/accept', 'Admin::acceptPenyelenggara',['filter' => 'adminAuthorization']);

$routes->get('admin/dakwah', 'Admin::dakwah',['filter' => 'adminAuthorization']);
$routes->get('admin/dakwah/new', 'Admin::newDakwah',['filter' => 'adminAuthorization']);

$routes->post('admin/dakwah/add', 'Admin::addDakwah',['filter' => 'adminAuthorization']);

$routes->get('admin/dakwah/edit', 'Admin::editDakwah',['filter' => 'adminAuthorization']);
$routes->post('admin/dakwah/update', 'Admin::updateDakwah',['filter' => 'adminAuthorization']);
$routes->post('admin/dakwah/delete', 'Admin::deleteDakwah',['filter' => 'adminAuthorization']);
$routes->get('admin/dakwah/histori', 'Admin::historiDakwah',['filter' => 'adminAuthorization']);
$routes->post('admin/dakwah/done', 'Admin::doneDakwah',['filter' => 'adminAuthorization']);

$routes->get('admin/login', 'Authentication::adminLogin');
$routes->post('admin/auth', 'Authentication::adminAuthentication');

$routes->get('admin/profile', 'Admin::adminProfile',['filter' => 'adminAuthorization']);
$routes->post('admin/profile/save', 'Admin::saveAdminProfile',['filter' => 'adminAuthorization']);
$routes->get('admin/password', 'Admin::passwordAdmin',['filter' => 'adminAuthorization']);
$routes->post('admin/password/update', 'Admin::updatePasswordAdmin',['filter' => 'adminAuthorization']);

$routes->get('admin/feedback', 'Admin::feedback',['filter' => 'adminAuthorization']);
$routes->post('admin/messages/delete', 'Admin::feedbackDelete',['filter' => 'adminAuthorization']);

$routes->get('admin/logout', 'Admin::logoutAdmin',['filter' => 'adminAuthorization']);



$routes->get('/user/dashboard', 'User::dashboard',['filter' => 'userAuthorization']);
$routes->get('/user/dakwah', 'User::dakwah',['filter' => 'userAuthorization']);
$routes->get('/user/dakwah/histori', 'User::historiDakwah',['filter' => 'userAuthorization']);
$routes->get('/user/dakwah/new', 'User::newDakwah',['filter' => 'userAuthorization']);
$routes->post('/user/dakwah/add', 'User::addDakwah',['filter' => 'userAuthorization']);
$routes->get('/user/dakwah/edit', 'User::editDakwah',['filter' => 'userAuthorization']);
$routes->post('/user/dakwah/update', 'User::updateDakwah',['filter' => 'userAuthorization']);
$routes->post('/user/dakwah/delete', 'User::deleteDakwah',['filter' => 'userAuthorization']);
$routes->post('/user/dakwah/done', 'User::doneDakwah',['filter' => 'userAuthorization']);
$routes->get('user/profile', 'User::userProfile',['filter' => 'userAuthorization']);
$routes->post('user/profile/save', 'User::saveUserProfile',['filter' => 'userAuthorization']);
$routes->get('user/password', 'User::passwordUser',['filter' => 'userAuthorization']);
$routes->post('user/password/update', 'User::updatePasswordUser',['filter' => 'userAuthorization']);
$routes->get('user/logout', 'User::logoutUser',['filter' => 'userAuthorization']);


$routes->get('user/login', 'Authentication::userLogin');
$routes->post('user/auth', 'Authentication::userAuthentication');
$routes->get('user/register', 'Authentication::userRegister');
$routes->post('user/registering', 'Authentication::userRegistering');

$routes->get('/dakwah', 'Visitor::dakwah');
$routes->get('/beranda', 'Visitor::beranda');
$routes->get('/contact', 'Visitor::contact');
$routes->get('/', 'Visitor::beranda');
$routes->post('/contact/send', 'Visitor::sendContact');

