<?php

namespace App\Controllers;

use App\Models\ContactModel;
use CodeIgniter\Controller;

class Contact extends Controller
{
    protected $contactModel;

    public function __construct()
    {
        $this->contactModel = new ContactModel();
        helper(['form', 'url']); // supaya bisa pakai form & url helpers
    }

    public function index()
    {
        return view('contact'); // nama view kamu
    }

    public function send()
    {
        // Validasi input
        $validation = $this->validate([
            'name'    => 'required|min_length[3]|max_length[50]',
            'email'   => 'required|valid_email',
            'phone'   => 'required|min_length[8]|max_length[20]',
            'message' => 'required|min_length[5]|max_length[500]',
        ]);

        if (!$validation) {
            return redirect()->back()->with('error', implode('<br>', $this->validator->getErrors()));
        }

        // Simpan ke database
        $this->contactModel->save([
            'name'    => $this->request->getPost('name'),
            'email'   => $this->request->getPost('email'),
            'phone'   => $this->request->getPost('phone'),
            'message' => $this->request->getPost('message'),
        ]);

        return redirect()->back()->with('success', 'Pesan kamu berhasil dikirim! Terima kasih 💈');
    }
}
