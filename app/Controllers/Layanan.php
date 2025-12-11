<?php

namespace App\Controllers;

// 1. PENTING: Panggil Model di sini agar dikenali
use App\Models\LayananModel;

class Layanan extends BaseController
{
    public function pricelist()
    {
        // 2. Instansiasi Model
        $model = new LayananModel();

        // 3. Ambil data dari database (diurutkan biar rapi)
        // Nama key array 'layanan' HARUS sama dengan variabel di View ($layanan)
        $data['layanan'] = $model->orderBy('nama_layanan', 'ASC')->findAll();

        // 4. Kirim paket $data ke View
        return view('layanan/pricelist', $data);
    }
}
