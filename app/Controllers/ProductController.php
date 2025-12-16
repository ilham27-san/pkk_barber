<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data = [
            'title'    => 'Kelola Produk',
            'products' => $this->productModel->findAll()
        ];
        return view('admin/product_index', $data);
    }

    public function simpan()
    {
        $fileGambar = $this->request->getFile('gambar');
        if ($fileGambar->isValid() && !$fileGambar->hasMoved()) {
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('img/products', $namaGambar);

            $this->productModel->save([
                'nama_produk' => $this->request->getPost('nama_produk'),
                'harga'       => $this->request->getPost('harga'),
                'deskripsi'   => $this->request->getPost('deskripsi'),
                'gambar'      => $namaGambar
            ]);

            return redirect()->to(base_url('admin/products'))->with('success', 'Produk berhasil ditambahkan.');
        }
        return redirect()->back()->with('error', 'Gagal upload gambar.');
    }

    public function edit($id)
    {
        $data = [
            'title'   => 'Edit Produk',
            'product' => $this->productModel->find($id)
        ];
        return view('admin/product_edit', $data);
    }

    public function update($id)
    {
        $fileGambar = $this->request->getFile('gambar');
        $oldProduct = $this->productModel->find($id);

        $dataUpdate = [
            'id'          => $id,
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga'       => $this->request->getPost('harga'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
        ];

        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('img/products', $namaGambar);
            if (file_exists('img/products/' . $oldProduct['gambar'])) {
                unlink('img/products/' . $oldProduct['gambar']);
            }
            $dataUpdate['gambar'] = $namaGambar;
        }

        $this->productModel->save($dataUpdate);
        return redirect()->to(base_url('admin/products'))->with('success', 'Produk berhasil diupdate.');
    }

    public function hapus($id)
    {
        $product = $this->productModel->find($id);
        if ($product && file_exists('img/products/' . $product['gambar'])) {
            unlink('img/products/' . $product['gambar']);
        }
        $this->productModel->delete($id);
        return redirect()->to(base_url('admin/products'))->with('success', 'Produk berhasil dihapus.');
    }
}