<?php

namespace App\Controllers;

use App\Models\GalleryModel;

class GalleryController extends BaseController
{
    protected $galleryModel;

    public function __construct()
    {
        $this->galleryModel = new GalleryModel();
    }

    // Tampilan list gallery di dashboard admin
    public function index()
    {
        $data = [
            'title'   => 'Kelola Gallery',
            'gallery' => $this->galleryModel->findAll()
        ];
        return view('admin/gallery_index', $data);
    }

    // Proses Simpan Gambar (Create)
    public function simpan()
    {
        $fileGambar = $this->request->getFile('gambar');

        if ($fileGambar->isValid() && !$fileGambar->hasMoved()) {
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('img/gallery', $namaGambar);

            $this->galleryModel->save([
                'judul'     => $this->request->getPost('judul'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'gambar'    => $namaGambar
            ]);

            return redirect()->to(base_url('admin/gallery'))->with('success', 'Gambar berhasil diupload.');
        }

        return redirect()->back()->with('error', 'Gagal upload gambar.');
    }

    // Menampilkan halaman form edit (Update - View)
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Gallery',
            'item'  => $this->galleryModel->find($id)
        ];
        return view('admin/gallery_edit', $data);
    }

    // Memproses pembaruan data (Update - Action)
    public function update($id)
    {
        $fileGambar = $this->request->getFile('gambar');
        $oldItem = $this->galleryModel->find($id);

        $dataUpdate = [
            'id'        => $id,
            'judul'     => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ];

        // Cek jika ada upload gambar baru
        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('img/gallery', $namaGambar);
            
            // Hapus file fisik gambar lama dari folder
            if (file_exists('img/gallery/' . $oldItem['gambar'])) {
                unlink('img/gallery/' . $oldItem['gambar']);
            }
            
            $dataUpdate['gambar'] = $namaGambar;
        }

        $this->galleryModel->save($dataUpdate);
        return redirect()->to(base_url('admin/gallery'))->with('success', 'Data berhasil diperbarui.');
    }

    // Proses Hapus Gambar (Delete)
    public function hapus($id)
    {
        $data = $this->galleryModel->find($id);
        
        if ($data && $data['gambar'] != '') {
            $path = 'img/gallery/' . $data['gambar'];
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $this->galleryModel->delete($id);
        return redirect()->to(base_url('admin/gallery'))->with('success', 'Gambar berhasil dihapus.');
    }
}