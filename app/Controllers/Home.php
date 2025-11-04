<?php

namespace App\Controllers;

use App\Models\LayananModel;
use CodeIgniter\Controller;

class Home extends Controller
{
    public function index()
    {
        $layananModel = new LayananModel();
        $data['layanan'] = $layananModel->findAll();

        // Langsung return view yang sudah extend template
        return view('home/index', $data);
    }

    public function layanan()
    {
        $layananModel = new LayananModel();
        $data['layanan'] = $layananModel->findAll();

        // Sama, langsung return view
        return view('home/layanan', $data);
    }
}
