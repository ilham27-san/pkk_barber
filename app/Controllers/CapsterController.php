<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CapsterModel;

class CapsterController extends BaseController
{
    protected $capsterModel;

    public function __construct()
    {
        // Pastikan Anda memuat Model di sini
        $this->capsterModel = new CapsterModel();
    }

    // A. Menampilkan Daftar Capster (Read)
    public function index()
    {
        $data = [
            'title' => 'Kelola Capster',
            'capster' => $this->capsterModel->findAll() // Ambil semua data capster
        ];

        // PATH DIPERBAIKI: Mengarah ke app/Views/admin/data_capster.php
        return view('admin/data_capster', $data);
    }

    // B. Menampilkan Form Tambah (Create)
    public function create()
    {
        $data = [
            'title' => 'Tambah Capster Baru',
            'validation' => \Config\Services::validation() // Load service validation untuk view
        ];

        // PATH DIPERBAIKI: Mengarah ke app/Views/admin/form_capster.php
        return view('admin/form_capster', $data);
    }

    // C. Proses Simpan (Create) - Termasuk Unggah Foto
    public function save()
    {
        // 1. Validasi Input
        if (!$this->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'foto' => [
                'rules' => 'uploaded[foto]|max_size[foto,2048]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih foto Capster.',
                    'max_size' => 'Ukuran foto maksimal 2MB.',
                    'mime_in' => 'Format file harus JPG, JPEG, atau PNG.'
                ]
            ]
        ])) {
            // Jika validasi gagal, kembali ke form dengan error
            return redirect()->to(base_url('admin/capster/create'))->withInput();
        }

        // 2. Ambil File dan Pindahkan ke folder 'public/assets/img/capster/'
        $fileFoto = $this->request->getFile('foto');
        $namaFoto = $fileFoto->getRandomName(); 
        $fileFoto->move('assets/img/capster', $namaFoto); 

        // 3. Simpan data ke Database
        $this->capsterModel->save([
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'spesialisasi' => $this->request->getPost('spesialisasi'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'foto' => $namaFoto,
        ]);

        session()->setFlashdata('pesan', 'Data Capster berhasil ditambahkan.');
        return redirect()->to(base_url('admin/capster'));
    }
    
    // D. Menampilkan Form Edit (Update - Bagian 1)
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Capster',
            'validation' => \Config\Services::validation(),
            'capster' => $this->capsterModel->find($id)
        ];

        // PATH DIPERBAIKI: Mengarah ke app/Views/admin/edit_capster.php
        return view('admin/edit_capster', $data);
    }
    
    // E. Proses Update (Update - Bagian 2)
    public function update($id)
    {
        // 1. Tentukan aturan validasi untuk foto (foto bisa diisi atau tidak)
        $fileFotoBaru = $this->request->getFile('foto');
        
        // Aturan default: foto tidak wajib
        $aturanFoto = 'max_size[foto,2048]|mime_in[foto,image/jpg,image/jpeg,image/png]';
        
        // Jika user memilih file baru, maka foto wajib divalidasi
        if ($fileFotoBaru->getError() !== 4) {
            $aturanFoto = 'uploaded[foto]|' . $aturanFoto;
        }

        // 2. Validasi Input
        if (!$this->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'foto' => [
                'rules' => $aturanFoto,
                'errors' => [
                    'uploaded' => 'Pilih foto Capster.',
                    'max_size' => 'Ukuran foto maksimal 2MB.',
                    'mime_in' => 'Format file harus JPG, JPEG, atau PNG.'
                ]
            ]
        ])) {
            return redirect()->to(base_url('admin/capster/edit/' . $id))->withInput();
        }

        // 3. Penanganan Foto
        $namaFotoLama = $this->request->getPost('foto_lama');
        $namaFoto = $namaFotoLama; // Default: pakai nama foto lama

        if ($fileFotoBaru->getError() !== 4) {
            // Ada foto baru diupload
            $namaFoto = $fileFotoBaru->getRandomName();
            $fileFotoBaru->move('assets/img/capster', $namaFoto);

            // Hapus foto lama jika bukan foto default
            if ($namaFotoLama && file_exists('assets/img/capster/' . $namaFotoLama)) {
                unlink('assets/img/capster/' . $namaFotoLama);
            }
        }

        // 4. Update data ke Database
        $this->capsterModel->save([
            'id_capster' => $id,
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'spesialisasi' => $this->request->getPost('spesialisasi'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'foto' => $namaFoto,
        ]);

        session()->setFlashdata('pesan', 'Data Capster berhasil diubah.');
        return redirect()->to(base_url('admin/capster'));
    }

    // F. Proses Hapus (Delete)
    public function delete($id)
    {
        // Cari data Capster berdasarkan ID
        $capster = $this->capsterModel->find($id);

        // Hapus file foto dari server
        // Pastikan file tersebut ada sebelum dihapus
        if (file_exists('assets/img/capster/' . $capster['foto'])) {
            unlink('assets/img/capster/' . $capster['foto']);
        }

        // Hapus data dari database
        // TYPO DIPERBAIKI: $thisster menjadi $this
        $this->capsterModel->delete($id);

        session()->setFlashdata('pesan', 'Data Capster berhasil dihapus.');
        return redirect()->to(base_url('admin/capster'));
    }
}