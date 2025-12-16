<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ContactModel;
use App\Models\GalleryModel;

class Page extends BaseController
{
    protected $productModel;
    protected $contactModel;
    protected $galleryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->contactModel = new ContactModel();
        $this->galleryModel = new GalleryModel();
    }

    // ✅ Langsung return view — tidak perlu "layout/template" lagi
    public function about()
    {
        return view('page/about');
    }

    public function gallery()
    {
        // 4. Ubah menjadi seperti ini
        $data = [
            'title'   => 'Gallery - BarberNow',
            'gallery' => $this->galleryModel->findAll()
        ];
        return view('page/gallery', $data);
    }

    public function contact()
    {
        return view('page/contact');
    }

    public function sendMessage()
    {
        $this->contactModel->insert([
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'pesan' => $this->request->getPost('pesan'),
        ]);

        return redirect()->to('/contact')->with('success', 'Pesan Anda telah terkirim!');
    }

    public function products() 
{
    $productModel = new ProductModel();
    
    $data = [
        'title'    => 'Our Products',
        'products' => $productModel->findAll() // Mengambil semua data dari database
    ];

    return view('page/products', $data);
}
}
