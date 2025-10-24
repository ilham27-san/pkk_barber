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

    public function about()
    {
        return view('page/about');
    }

    public function gallery()
    {
        return view('page/gallery');
    }

    public function contact()
    {
        return view('page/contact');
    }

    public function sendMessage()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'pesan' => $this->request->getPost('pesan'),
        ];

        $this->contactModel->insert($data);
        return redirect()->to('/contact')->with('success', 'Pesan Anda telah terkirim!');
    }

    public function products()
    {
        $data['products'] = $this->productModel->findAll();
        return view('page/products', $data);
    }
}
