<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// ================== AUTENTIKASI ==================
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::prosesLogin');
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::prosesRegister');
$routes->get('logout', 'AuthController::logout');

// ================== CRUD MAKANAN (Admin & Penjual) ==================
$routes->group('makanan', ['filter' => 'role:admin,penjual'], static function ($routes) {
    $routes->get('/', 'MakananController::index');
    $routes->get('create', 'MakananController::create');
    $routes->post('store', 'MakananController::store');
    $routes->get('edit/(:num)', 'MakananController::edit/$1');
    $routes->post('update/(:num)', 'MakananController::update/$1');
    $routes->get('delete/(:num)', 'MakananController::delete/$1');
});

// ================== PESANAN (Pembeli membeli, Penjual/Admin mengelola) ==================
$routes->post('pesan/(:num)', 'PesananController::pesan/$1', ['filter' => 'role:pembeli']);
$routes->get('pesanan-saya', 'PesananController::saya', ['filter' => 'role:pembeli']);
$routes->get('pesanan-masuk', 'PesananController::masuk', ['filter' => 'role:admin,penjual']);
$routes->post('pesanan-masuk/status/(:num)', 'PesananController::updateStatus/$1', ['filter' => 'role:admin,penjual']);

// ================== MANAJEMEN USER (khusus Admin) ==================
$routes->group('user', ['filter' => 'role:admin'], static function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('create', 'UserController::create');
    $routes->post('store', 'UserController::store');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1');
    $routes->get('delete/(:num)', 'UserController::delete/$1');
});
