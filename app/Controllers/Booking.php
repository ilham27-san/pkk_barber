<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\LayananModel;

class Booking extends BaseController
{
    public function form()
    {
        $layananModel = new LayananModel();
        $layanan = $layananModel->findAll(); // tampilkan semua layanan

        return view('layout/template', [
            'content' => view('booking/form_booking', [
                'layanan' => $layanan
            ])
        ]);
    }

    public function submit()
    {
        $session = session();

        // Cek login
        if (! $session->get('logged_in')) {
            return redirect()->to('/auth/login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Validasi
        $rules = [
            'id_layanan' => 'required|integer',
            'tanggal'    => 'required|valid_date',
            'jam'        => 'required'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Data tidak valid');
        }

        // Simpan ke database
        $bookingModel = new BookingModel();

        $data = [
            'id_user'    => $session->get('id'),
            'id_layanan' => $this->request->getPost('id_layanan'),
            'tanggal'    => $this->request->getPost('tanggal'),
            'jam'        => $this->request->getPost('jam'),
            'status'     => 'pending'
        ];

        $bookingModel->insert($data);

        return redirect()->to('/')->with('success', 'Booking berhasil dibuat');
    }
}
