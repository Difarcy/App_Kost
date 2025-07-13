<?php

use CodeIgniter\Router\RouteCollection;
/** @var RouteCollection $routes */

$routes->get('/', 'Beranda::index');
$routes->get('/admin', 'Dashboard::index');
$routes->get('/admin/dashboard', 'Dashboard::index');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::doLogin');
$routes->get('logout', 'Auth::logout');

// Sidebar routes
$routes->get('admin/kamar', 'Kamar::index');
$routes->get('admin/penghuni', 'Penghuni::index');
$routes->get('admin/tagihan', 'Tagihan::index');
$routes->get('admin/pembayaran', 'Pembayaran::index');
$routes->get('admin/barang', 'Barang::index');

// Resource routes untuk admin CRUD
define('ADMIN', 'admin');
$routes->group(ADMIN, function($routes) {
    $routes->resource('penghuni', ['controller' => 'Penghuni']);
    $routes->resource('kamar', ['controller' => 'Kamar']);
    $routes->resource('barang', ['controller' => 'Barang']);
    $routes->resource('kmr-penghuni', ['controller' => 'KmrPenghuni']);
    $routes->resource('brng-bawaan', ['controller' => 'BrngBawaan']);
    $routes->resource('tagihan', ['controller' => 'Tagihan']);
    $routes->resource('pembayaran', ['controller' => 'Pembayaran']);
});
