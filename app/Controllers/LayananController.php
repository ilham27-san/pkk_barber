<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class LayananController extends BaseController
{
    // ... (metode index, dll. Anda yang lain)

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Layanan',
            // Data lain yang mungkin diperlukan untuk layout atau form
        ];

        // Memuat dan menampilkan view form penambahan layanan
        return view('admin/layanan/create', $data);
    }
}
