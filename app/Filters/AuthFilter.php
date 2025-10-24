<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Filter Keamanan untuk halaman Admin dan User.
 * Disesuaikan dengan nama 'authfilter' di Routes.php
 */
class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // 1. Cek apakah sudah login
        if (!$session->get('isLoggedIn')) {
            // Jika belum, lempar ke halaman login
            return redirect()->to('/auth/login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        /**
         * 2. Cek apakah perlu role 'admin'
         * Kita cek apakah $arguments berisi 'admin'
         * Di Routes.php, Anda bisa pakai: ['filter' => 'authfilter:admin']
         *
         * DI KASUS ANDA (Routes.php): $routes->group('admin', ['filter' => 'authfilter']
         * Anda tidak memberikan argumen, jadi kita harus mengecek 'role' admin secara spesifik
         * untuk grup '/admin'.
         */

        // Cek URI (URL) yang sedang diakses
        $uri = service('uri');

        // Jika segmen pertama URI adalah 'admin'
        if ($uri->getSegment(1) === 'admin') {

            // 2. Cek apakah role-nya 'admin'
            if ($session->get('role') !== 'admin') {
                // Jika login TAPI bukan admin, lempar ke halaman utama
                return redirect()->to('/')->with('error', 'Anda tidak memiliki hak akses ke halaman ini.');
            }
        }

        // Jika perlu, Anda bisa tambahkan cek untuk 'pelanggan' di sini
        // (Misal: jika $uri->getSegment(1) === 'profile')

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu melakukan apa-apa setelah request
    }
}
