<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReviewModel;

class About extends BaseController
{
    public function history()
    {
        return view('about/history');
    }

    public function lokasi()
    {
        return view('about/lokasi');
    }

    // --- LOGIKA REVIEW DIPERBAIKI ---
    public function review()
    {
        $model = new ReviewModel();

        // PERBAIKAN DI SINI:
        // Saya hapus 'users.foto' dari select.
        // Sekarang hanya mengambil data review dan username saja.
        $data['reviews'] = $model->select('reviews.*, users.username')
            ->join('users', 'users.id = reviews.user_id', 'left')
            ->orderBy('reviews.created_at', 'DESC')
            ->findAll();

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

        $data['sort'] = $this->request->getGet('sort') ?? 'newest';

        return view('about/review', $data);
    }
}
