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

$routes->get('booking/success/(:num)', 'Booking::success/$1');



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
    $routes->get('dashboard', 'Admin::index');

    // CRUD Layanan
    $routes->get('layanan', 'Admin::layanan');
    $routes->get('layanan/create', 'Admin::createLayanan');
    $routes->post('layanan/store', 'Admin::storeLayanan');
    $routes->get('layanan/edit/(:num)', 'Admin::editLayanan/$1');
    $routes->post('layanan/update/(:num)', 'Admin::updateLayanan/$1');
    $routes->post('layanan/delete/(:num)', 'Admin::deleteLayanan/$1');

    // ------------------------------------------------------------------
    // CRUD Capster (Mengarah ke CapsterController)
    // ------------------------------------------------------------------
    $routes->get('capster', 'CapsterController::index');                   // List capster
    $routes->get('capster/create', 'CapsterController::create');           // Form tambah
    $routes->post('capster/save', 'CapsterController::save');              // Simpan baru (action dari form_capster.php)
    $routes->get('capster/edit/(:num)', 'CapsterController::edit/$1');     // Form edit
    $routes->post('capster/(:num)', 'CapsterController::update/$1');       // Update data (digunakan untuk POST/PUT)
    $routes->post('capster/delete/(:num)', 'CapsterController::delete/$1'); // Hapus POST

    // ------------------------------------------------------------------
    // CRUD Gallery (Mengarah ke GalleryController)
    // ------------------------------------------------------------------
    $routes->get('gallery', 'GalleryController::index');                  // List gallery admin
    $routes->get('gallery/create', 'GalleryController::create');          // Form tambah foto
    $routes->post('gallery/simpan', 'GalleryController::simpan');         // Proses upload
    $routes->post('gallery/delete/(:num)', 'GalleryController::hapus/$1');
    $routes->get('gallery/edit/(:num)', 'GalleryController::edit/$1');
    $routes->post('gallery/update/(:num)', 'GalleryController::update/$1'); // Hapus foto (Method POST lebih aman)

    // Data Pelanggan
    $routes->get('pelanggan', 'Admin::pelanggan');

    // Data Booking
    $routes->get('/', 'Admin::index');          // Dashboard

    // Booking
    // Booking
    $routes->post('update_status/(:num)', 'Admin::updateStatus/$1');
    $routes->get('booking', 'Admin::booking');
    $routes->get('booking/tambah', 'Admin::tambahBooking');     // URL: admin/booking/tambah
    $routes->post('booking/simpan', 'Admin::simpanBooking');    // URL: admin/booking/simpan
});
// ABOUT
$routes->get('/about/history', 'About::history');
$routes->get('/about/lokasi', 'About::lokasi');
$routes->get('/about/review', 'About::review');

$routes->group('about/review', function ($routes) {
    // Tampil Halaman
    $routes->get('/', 'About::review');

    // Proses Tambah (POST)
    $routes->post('add', 'About::add');

    // Proses Hapus (GET dengan ID)
    $routes->get('delete/(:num)', 'About::delete/$1');
});

// LAYANAN
$routes->get('/layanan/pricelist', 'Layanan::pricelist');
$routes->get('/layanan/capster', 'Capster::index');
