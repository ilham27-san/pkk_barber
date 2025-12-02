<?php
namespace App\Controllers;

use App\Models\ReviewModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Review extends Controller
{
    protected $reviewModel;
    protected $userModel;

    public function __construct()
    {
        $this->reviewModel = new ReviewModel();
        $this->userModel = new UserModel();
    }

    // list + sorting + pagination + avg
    public function index()
{
    $sort = $this->request->getGet('sort') ?? 'newest';

    // Sorting
    if ($sort === 'rating_high') {
        $this->reviewModel->orderBy('rating', 'DESC');
    } elseif ($sort === 'rating_low') {
        $this->reviewModel->orderBy('rating', 'ASC');
    } elseif ($sort === 'oldest') {
        $this->reviewModel->orderBy('created_at', 'ASC');
    } else {
        $this->reviewModel->orderBy('created_at', 'DESC');
    }

    // Pagination
    $perPage = 6;
    $data['reviews'] = $this->reviewModel->paginate($perPage);
    $data['pager'] = $this->reviewModel->pager;

    // AVG Rating — WAJIB ADA!
    $avgRow = $this->reviewModel->selectAvg('rating')->first();
    $data['avg_rating'] = isset($avgRow['rating']) ? round($avgRow['rating'], 1) : 0;

    // Tambahkan sorting ke view
    $data['sort'] = $sort;

    // Attach user info (username + photo)
    foreach ($data['reviews'] as &$r) {
        $u = $this->userModel->find($r['user_id']);
        $r['username'] = $u['username'] ?? 'User';
        $r['photo'] = $u['photo'] ?? 'default.png';
    }

    return view('about/review', $data);
}


    // create (from form)
    public function add()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $rules = [
            'rating' => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[5]',
            'komentar' => 'required|min_length[5]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode('<br>', $this->validator->getErrors()));
        }

        $this->reviewModel->insert([
            'user_id' => session()->get('id'),
            'rating' => (int) $this->request->getPost('rating'),
            'komentar' => $this->request->getPost('komentar'),
        ]);

        return redirect()->to('/about/review')->with('success', 'Terima kasih, review Anda tersubmit.');
    }

    // edit form
    public function edit($id)
    {
        $r = $this->reviewModel->find($id);
        if (! $r) return redirect()->back()->with('error', 'Review tidak ditemukan.');
        if ($r['user_id'] != session()->get('id')) {
            return redirect()->back()->with('error', 'Tidak boleh mengedit review orang lain.');
        }
        $data['review'] = $r;
        return view('about/edit_review', $data);
    }

    // update
    public function update($id)
    {
        $r = $this->reviewModel->find($id);
        if (! $r) return redirect()->back()->with('error', 'Review tidak ditemukan.');
        if ($r['user_id'] != session()->get('id')) {
            return redirect()->back()->with('error', 'Tidak boleh mengedit review orang lain.');
        }

        $rules = [
            'rating' => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[5]',
            'komentar' => 'required|min_length[5]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode('<br>', $this->validator->getErrors()));
        }

        $this->reviewModel->update($id, [
            'rating' => (int) $this->request->getPost('rating'),
            'komentar' => $this->request->getPost('komentar'),
        ]);

        return redirect()->to('/about/review')->with('success', 'Review diperbarui.');
    }

    // delete
    public function delete($id)
    {
        $r = $this->reviewModel->find($id);
        if (! $r) return redirect()->back()->with('error', 'Review tidak ditemukan.');
        if ($r['user_id'] != session()->get('id')) {
            return redirect()->back()->with('error', 'Tidak boleh menghapus review orang lain.');
        }

        $this->reviewModel->delete($id);
        return redirect()->back()->with('success', 'Review dihapus.');
    }
}
