<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// == RUTE PUBLIK & HOME ==
$routes->get('/', 'Home::index');
$routes->get('layanan', 'Home::layanan');
$routes->get('booking/(:num)', 'Booking::form/$1');
$routes->post('booking/submit', 'Booking::submit');

// Halaman Informasi Publik (Hanya didefinisikan satu kali di sini)
$routes->get('about', 'Page::about');
$routes->get('products', 'Page::products');
$routes->get('gallery', 'Page::gallery');
$routes->get('contact', 'Page::contact');





// == RUTE AUTENTIKASI (LOGIN/REGISTER) ==
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/attempt', 'Auth::attempt');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/register', 'Auth::store');
$routes->get('auth/logout', 'Auth::logout');


// == RUTE KHUSUS ADMIN (Dilindungi Filter) ==
$routes->group('admin', ['filter' => 'authfilter'], static function ($routes) {
    // URL: /admin
    $routes->get('/', 'Admin::index'); // Menggantikan get('')

    // URL: /admin/layanan
    $routes->get('layanan', 'Admin::layanan');
    $routes->get('layanan/create', 'Admin::createLayanan');
    $routes->post('layanan/store', 'Admin::storeLayanan');
    $routes->get('layanan/edit/(:num)', 'Admin::editLayanan/$1');
    $routes->post('layanan/update/(:num)', 'Admin::updateLayanan/$1');
    $routes->get('layanan/delete/(:num)', 'Admin::deleteLayanan/$1');

    // URL: /admin/pelanggan
    $routes->get('pelanggan', 'Admin::pelanggan');

    // URL: /admin/booking
    $routes->get('booking', 'Admin::bookings');

    // [FIX] Rute Halaman Informasi yang duplikat SUDAH DIHAPUS dari sini.
});
