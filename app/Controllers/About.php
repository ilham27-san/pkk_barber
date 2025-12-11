<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReviewModel;

class About extends BaseController
{
    // =================================================================
    // 1. HALAMAN STATIS (History & Lokasi)
    // =================================================================
    public function history()
    {
        return view('about/history');
    }

    public function lokasi()
    {
        return view('about/lokasi');
    }

    // =================================================================
    // 2. HALAMAN REVIEW (Tampil Data)
    // =================================================================
    public function review()
    {
        $model = new ReviewModel();

        // Ambil data review + nama user (tanpa foto karena tabel user tidak punya foto)
        $data['reviews'] = $model->select('reviews.*, users.username')
            ->join('users', 'users.id = reviews.user_id', 'left')
            ->orderBy('reviews.created_at', 'DESC')
            ->findAll();

        // Hitung Rata-rata Rating Manual
        $total = 0;
        $count = count($data['reviews']);
        if ($count > 0) {
            foreach ($data['reviews'] as $r) {
                $total += $r['rating'];
            }
            $data['avg_rating'] = $total / $count;
        } else {
            $data['avg_rating'] = 0;
        }

        $data['sort'] = $this->request->getGet('sort') ?? 'newest';

        return view('about/review', $data);
    }

    // =================================================================
    // 3. FUNGSI TAMBAH REVIEW (Action Form)
    // =================================================================
    public function add()
    {
        // A. Cek Login (Security Layer 1)
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login')->with('error', 'Silakan login untuk menulis ulasan.');
        }

        // B. Validasi Input
        $rules = [
            'rating'   => 'required|numeric',
            'komentar' => 'required|min_length[3]'
        ];

        if (!$this->validate($rules)) {
            // Balikkan user ke form dengan input sebelumnya + pesan error
            return redirect()->back()->withInput()->with('error', 'Mohon isi rating dan komentar dengan benar.');
        }

        // C. Simpan ke Database
        $model = new ReviewModel();

        $dataSimpan = [
            'user_id'  => session()->get('id'), // ID diambil dari sesi login
            'rating'   => $this->request->getPost('rating'),
            'komentar' => $this->request->getPost('komentar')
        ];

        $model->save($dataSimpan);

        // D. Sukses
        return redirect()->to('about/review')->with('success', 'Terima kasih! Ulasan Anda berhasil dikirim.');
    }

    // =================================================================
    // 4. FUNGSI HAPUS REVIEW
    // =================================================================
    public function delete($id)
    {
        // A. Cek Login
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $model = new ReviewModel();
        $review = $model->find($id);

        // B. Validasi Kepemilikan (Security Layer 2)
        // Cek apakah data ada DAN apakah yang menghapus adalah pemilik aslinya
        if (!$review || $review['user_id'] != session()->get('id')) {
            return redirect()->to('about/review')->with('error', 'Anda tidak berhak menghapus ulasan ini.');
        }

        // C. Eksekusi Hapus
        $model->delete($id);

        return redirect()->to('about/review')->with('success', 'Ulasan berhasil dihapus.');
    }
}
