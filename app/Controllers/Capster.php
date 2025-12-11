<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CapsterModel;

class Capster extends BaseController
{
    public function index()
    {
        $model = new CapsterModel();

        // LOGIKA: Ambil data capster yang 'status_aktif' bernilai 1 (Aktif)
        // Kita tidak mau menampilkan pegawai yang sudah resign/non-aktif.
        $data = [
            'title'          => 'Tim Profesional Kami',
            'daftar_capster' => $model->where('status_aktif', 1)->findAll()
        ];

        // Pastikan nama file view sesuai dengan file Anda
        // Jika nama file view Anda 'public_capster.php', ganti string di bawah.
        return view('layanan/capster', $data);
    }
}
