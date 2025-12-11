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
    // 2. HALAMAN REVIEW (LOGIKA DIPERBAIKI)
    // =================================================================
    public function review()
    {
        $model = new ReviewModel();

        // [PERBAIKAN 1] Ambil input user DULUAN sebelum query
        $sort = $this->request->getGet('sort') ?? 'newest';

        // [PERBAIKAN 2] Siapkan Builder (jangan di-findAll dulu)
        $builder = $model->select('reviews.*, users.username')
            ->join('users', 'users.id = reviews.user_id', 'left');

        // [PERBAIKAN 3] Terapkan logika sorting berdasarkan input user
        switch ($sort) {
            case 'oldest':
                $builder->orderBy('reviews.created_at', 'ASC'); // Paling Lama
                break;
            case 'rating_high':
                $builder->orderBy('reviews.rating', 'DESC'); // Bintang Tertinggi
                break;
            case 'rating_low':
                $builder->orderBy('reviews.rating', 'ASC');  // Bintang Terendah
                break;
            case 'newest':
            default:
                $builder->orderBy('reviews.created_at', 'DESC'); // Paling Baru (Default)
                break;
        }

        // [PERBAIKAN 4] Baru eksekusi query setelah aturan sort diterapkan
        $data['reviews'] = $builder->findAll();

        // Hitung Rata-rata Rating
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

        // Kirim status sort kembali ke view agar dropdown tidak reset
        $data['sort'] = $sort;

        return view('about/review', $data);
    }

    // =================================================================
    // 3. FUNGSI TAMBAH REVIEW
    // =================================================================
    public function add()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login')->with('error', 'Silakan login untuk menulis ulasan.');
        }

        $rules = [
            'rating'   => 'required|numeric',
            'komentar' => 'required|min_length[3]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Mohon isi rating dan komentar dengan benar.');
        }

        $model = new ReviewModel();
        $dataSimpan = [
            'user_id'  => session()->get('id'),
            'rating'   => $this->request->getPost('rating'),
            'komentar' => $this->request->getPost('komentar')
        ];

        $model->save($dataSimpan);

        return redirect()->to('about/review')->with('success', 'Terima kasih! Ulasan Anda berhasil dikirim.');
    }

    // =================================================================
    // 4. FUNGSI HAPUS REVIEW
    // =================================================================
    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $model = new ReviewModel();
        $review = $model->find($id);

        // Security: Pastikan hanya pemilik yang bisa menghapus
        if (!$review || $review['user_id'] != session()->get('id')) {
            return redirect()->to('about/review')->with('error', 'Anda tidak berhak menghapus ulasan ini.');
        }

        $model->delete($id);

        return redirect()->to('about/review')->with('success', 'Ulasan berhasil dihapus.');
    }
}
