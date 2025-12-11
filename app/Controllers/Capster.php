<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CapsterModel; // Panggil model yang sudah ada

class Capster extends BaseController
{
    protected $capsterModel;

    public function __construct()
    {
        $this->capsterModel = new CapsterModel();
    }

    // Method yang akan dipanggil ketika user mengakses /layanan/capster
    public function index()
    {
        $data = [
            'title' => 'Daftar Capster Terbaik',
            // Ambil SEMUA data Capster (tanpa filter status_aktif, untuk memastikan data muncul)
            'daftar_capster' => $this->capsterModel->findAll() 
        ];

        // PATH VIEW DIPERBAIKI: Mengarah ke app/Views/layanan/capster.php
        return view('layanan/capster', $data); 
    }
}