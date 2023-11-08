<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/sample', 'Home::index');
$routes->get('/welcome', 'AdminController::index');

$routes->get('/jobcategory', 'CategoryController::index');
$routes->get('/jobcategory_data', 'CategoryController::list_data');
$routes->get('/jobcategory/add', 'CategoryController::add_edit');
$routes->get('/jobcategory/edit/(:segment)', 'CategoryController::add_edit');
$routes->get('/jobcategory/view/(:segment)', 'CategoryController::view');
$routes->post('/jobcategory/upsert', 'CategoryController::insertUpdate');
$routes->post('/jobcategory/delete', 'CategoryController::delconfirm');
$routes->get('/jobcategory/change-status', 'CategoryController::update_status');
$routes->get('/jobcategory/change-status/global', 'CategoryController::change_status_global');
$routes->get('/jobcategory/check-duplicate', 'CategoryController::check_duplicate');


$routes->get('/user', 'UserController::index');
$routes->get('/user_data', 'UserController::list_data');