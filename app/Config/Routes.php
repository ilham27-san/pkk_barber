<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ======================================================
// 🌐 RUTE PUBLIK & HALAMAN UTAMA
// ======================================================
$routes->get('/', 'Home::index');
$routes->get('layanan', 'Home::layanan');
$routes->get('booking/(:num)', 'Booking::form/$1');
$routes->post('booking/submit', 'Booking::submit');

// Halaman Informasi Publik
$routes->get('about', 'Page::about');
$routes->get('products', 'Page::products');
$routes->get('gallery', 'Page::gallery');
$routes->get('contact', 'Page::contact');


// ======================================================
// 🔐 RUTE AUTENTIKASI (LOGIN, REGISTER, LOGOUT)
// ======================================================
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/attempt', 'Auth::attempt');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/register', 'Auth::store');
$routes->get('auth/logout', 'Auth::logout');


// ======================================================
// 🧑‍💼 RUTE KHUSUS ADMIN (TERLINDUNGI FILTER)
// ======================================================
$routes->group('admin', ['filter' => 'authfilter'], static function ($routes) {
    // Dashboard Admin
    $routes->get('/', 'Admin::index');
    $routes->get('dashboard', 'Admin::index'); // <-- Tambahan penting!

    // CRUD Layanan
    $routes->get('layanan', 'Admin::layanan');
    $routes->get('layanan/create', 'Admin::createLayanan');
    $routes->post('layanan/store', 'Admin::storeLayanan');
    $routes->get('layanan/edit/(:num)', 'Admin::editLayanan/$1');
    $routes->post('layanan/update/(:num)', 'Admin::updateLayanan/$1');
    $routes->get('layanan/delete/(:num)', 'Admin::deleteLayanan/$1');

    // Data Pelanggan
    $routes->get('pelanggan', 'Admin::pelanggan');

    // Data Booking
    $routes->get('booking', 'Admin::booking');
   $routes->get('tambah_booking', 'Admin::tambah_booking');
$routes->post('simpan_booking', 'Admin::simpan_booking');


});


