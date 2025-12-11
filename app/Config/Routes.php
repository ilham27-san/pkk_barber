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

$routes->get('booking', 'Booking::step1');                // akses /booking → Step 1
$routes->get('booking/step1', 'Booking::step1');
$routes->post('booking/step1Submit', 'Booking::step1Submit');

$routes->get('booking/step2', 'Booking::step2');
$routes->post('booking/step2Submit', 'Booking::step2Submit');

$routes->get('booking/step3', 'Booking::step3');
$routes->post('booking/step3Submit', 'Booking::step3Submit');

$routes->get('booking/step4', 'Booking::step4');
$routes->post('booking/submit', 'Booking::submit');




// Halaman Informasi Publik
$routes->get('about', 'Page::about');
$routes->get('products', 'Page::products');
$routes->get('gallery', 'Page::gallery');
$routes->get('contact', 'Page::contact');
$routes->get('contact', 'Contact::index');
$routes->post('contact/send', 'Contact::send');



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
    $routes->get('layanan', 'Admin::layanan');              // List layanan
    $routes->get('layanan/create', 'Admin::createLayanan'); // Form tambah
    $routes->post('layanan/store', 'Admin::storeLayanan');  // Simpan baru
    $routes->get('layanan/edit/(:num)', 'Admin::editLayanan/$1'); // Form edit
    $routes->post('layanan/update/(:num)', 'Admin::updateLayanan/$1'); // Update data
    $routes->post('layanan/delete/(:num)', 'Admin::deleteLayanan/$1'); // Hapus POST


    // Data Pelanggan
    $routes->get('pelanggan', 'Admin::pelanggan');

    // Data Booking
    $routes->post('update_status/(:num)', 'Admin::updateStatus/$1');
    $routes->get('booking', 'Admin::booking');
    $routes->get('tambah_booking', 'Admin::tambah_booking');
    $routes->post('simpan_booking', 'Admin::simpan_booking');
});

// ABOUT
$routes->get('/about/history', 'About::history');
$routes->get('/about/lokasi', 'About::lokasi');
$routes->get('/about/review', 'About::review');
// Review (About -> Review)
$routes->get('about/review', 'Review::index');
$routes->post('about/review/add', 'Review::add');
$routes->get('about/review/edit/(:num)', 'Review::edit/$1');
$routes->post('about/review/update/(:num)', 'Review::update/$1');
$routes->get('about/review/delete/(:num)', 'Review::delete/$1');


// LAYANAN
$routes->get('/layanan/pricelist', 'Layanan::pricelist');
$routes->get('/layanan/capster', 'Layanan::capster');
