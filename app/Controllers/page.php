<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ContactModel;

class Page extends BaseController
{
    protected $productModel;
    protected $contactModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->contactModel = new ContactModel();
    }

    // [FIX] Menggunakan path 'page/about'
    public function about()
    {
        echo view('layout/template', [
            'content' => view('page/about')
        ]);
    }

    // [FIX] Menggunakan path 'page/gallery'
    public function gallery()
    {
        echo view('layout/template', [
            'content' => view('page/gallery')
        ]);
    }

    // [FIX] Menggunakan path 'page/contact'
    public function contact()
    {
        echo view('layout/template', [
            'content' => view('page/contact')
        ]);
    }

    public function sendMessage()
    {
        // PERINGATAN: Pastikan ContactModel Anda sudah dikonfigurasi
        // seperti UserModel (useTimestamps = false dan $allowedFields)
        // agar tidak error 'updated_at' lagi.
        $this->contactModel->insert([
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'pesan' => $this->request->getPost('pesan'),
        ]);

        return redirect()->to('/contact')->with('success', 'Pesan Anda telah terkirim!');
    }

    // [FIX] Menggunakan path 'page/products'
    public function products()
    {
        $data['products'] = $this->productModel->findAll();

        echo view('layout/template', [
            'content' => view('page/products', $data)
        ]);
    }
}
