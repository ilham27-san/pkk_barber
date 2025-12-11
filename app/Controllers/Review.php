<?php

namespace App\Controllers;

use App\Models\ReviewModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Review extends Controller
{
    protected $reviewModel;
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->reviewModel = new ReviewModel();
        $this->userModel   = new UserModel();
        $this->session     = session();
    }

    // ======================================================
    //  MENAMPILKAN REVIEW + SORT + PAGINATION
    // ======================================================
    public function index()
{
    $sort = $this->request->getGet('sort') ?? 'newest';
    $perPage = 6;

    // Gunakan model asli agar paginate bekerja
    $model = new \App\Models\ReviewModel();

    // Base Query + JOIN
    $model->select('reviews.*, users.username')
          ->join('users', 'users.id = reviews.user_id', 'left');

    // Sorting
    switch ($sort) {
        case 'rating_high':
            $model->orderBy('reviews.rating', 'DESC');
            break;

        case 'rating_low':
            $model->orderBy('reviews.rating', 'ASC');
            break;

        case 'oldest':
            $model->orderBy('reviews.created_at', 'ASC');
            break;

        default:
            $model->orderBy('reviews.created_at', 'DESC');
    }

    // Pagination
    $reviews = $model->paginate($perPage);
    $pager   = $model->pager;

    // Hitung rata-rata rating
    $avgRow = $this->reviewModel->selectAvg('rating')->first();
    $avg    = isset($avgRow['rating']) ? round($avgRow['rating'], 1) : 0;

    return view('about/review', [
        'reviews'    => $reviews,
        'pager'      => $pager,
        'avg_rating' => $avg,
        'sort'       => $sort,
    ]);
}




    // ======================================================
    //  ADD REVIEW
    // ======================================================
    public function add()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/auth/login')
                ->with('error', 'Silakan login untuk menulis review.');
        }

        $rating   = $this->request->getPost('rating');
        $komentar = $this->request->getPost('komentar');

        if (!$rating || !$komentar) {
            return redirect()->back()->with('error', 'Rating dan komentar wajib diisi.');
        }

        // FIX: user_id harus pakai session('user_id')
        $this->reviewModel->save([
            'user_id' => $this->session->get('id'),

            'rating'   => $rating,
            'komentar' => $komentar
        ]);

        return redirect()->to('/about/review')
            ->with('success', 'Review berhasil dikirim.');
    }

    // ======================================================
    //  EDIT REVIEW PAGE
    // ======================================================
    public function edit($id)
    {
        $review = $this->reviewModel->find($id);

        if (!$review) {
            return redirect()->to('/about/review')->with('error', 'Review tidak ditemukan.');
        }

        // FIX: gunakan user_id bukan id
        if ($review['user_id'] != $this->session->get('id')) {

            return redirect()->to('/about/review')->with('error', 'Anda tidak boleh mengedit review ini.');
        }

        return view('review/edit', ['review' => $review]);
    }

    // ======================================================
    //  UPDATE REVIEW
    // ======================================================
    public function update($id)
    {
        $review = $this->reviewModel->find($id);

        if (!$review) {
            return redirect()->to('/about/review')->with('error', 'Review tidak ditemukan.');
        }

       if ($review['user_id'] != $this->session->get('id')) {

            return redirect()->to('/about/review')->with('error', 'Anda tidak boleh mengedit review ini.');
        }

        $rating   = $this->request->getPost('rating');
        $komentar = $this->request->getPost('komentar');

        $this->reviewModel->update($id, [
            'rating'   => $rating,
            'komentar' => $komentar
        ]);

        return redirect()->to('/about/review')->with('success', 'Review berhasil diperbarui.');
    }

    // ======================================================
    //  DELETE REVIEW
    // ======================================================
    public function delete($id)
    {
        $review = $this->reviewModel->find($id);

        if (!$review) {
            return redirect()->to('/about/review')->with('error', 'Review tidak ditemukan.');
        }

        if ($review['user_id'] != $this->session->get('id')) {

            return redirect()->to('/about/review')->with('error', 'Anda tidak boleh menghapus review ini.');
        }

        $this->reviewModel->delete($id);

        return redirect()->to('/about/review')->with('success', 'Review berhasil dihapus.');
    }
}
