<?php

namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\UserModel;
use App\Models\BookingModel;
use App\Models\CapsterModel; // 1. JANGAN LUPA IMPORT INI
use CodeIgniter\Controller;

class Admin extends Controller
{
    public function index()
    {
        $bookingModel = new BookingModel();
        $userModel = new UserModel();

        $data['total_pelanggan'] = $userModel->where('role', 'pelanggan')->countAllResults();
        $data['total_booking']   = $bookingModel->countAllResults();

        return view('admin/dashboard', $data);
    }

    // ================== LAYANAN ==================
    public function layanan()
    {
        $model = new LayananModel();
        $data['layanan'] = $model->findAll();
        return view('admin/data_layanan', $data);
    }

    public function createLayanan()
    {
        return view('admin/tambah_layanan');
    }

    public function storeLayanan()
    {
        $model = new LayananModel();
        $data = [
            'nama_layanan' => $this->request->getPost('nama_layanan'),
            'harga'        => $this->request->getPost('harga'),
            'deskripsi'    => $this->request->getPost('deskripsi')
        ];
        $model->insert($data);
        return redirect()->to('/admin/layanan')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function editLayanan($id)
    {
        $model = new LayananModel();
        $data['layanan'] = $model->find($id);
        if (!$data['layanan']) {
            return redirect()->to('/admin/layanan')->with('error', 'Data layanan tidak ditemukan.');
        }
        return view('admin/edit_layanan', $data);
    }

    public function updateLayanan($id)
    {
        $model = new LayananModel();
        $data = [
            'nama_layanan' => $this->request->getPost('nama_layanan'),
            'harga'        => $this->request->getPost('harga'),
            'deskripsi'    => $this->request->getPost('deskripsi')
        ];
        $model->update($id, $data);
        return redirect()->to('/admin/layanan')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function deleteLayanan($id)
    {
        $model = new LayananModel();
        $model->delete($id);
        return redirect()->to('/admin/layanan')->with('success', 'Layanan berhasil dihapus.');
    }


    // ================== PELANGGAN ==================
    public function pelanggan()
    {
        $model = new UserModel();
        $data['pelanggan'] = $model->where('role', 'pelanggan')->findAll();

        return view('admin/data_pelanggan', $data);
    }

    // ================== BOOKING (DIPERBARUI) ==================
    public function booking()
    {
        $model = new BookingModel();

        // 2. UBAH DI SINI: Panggil function custom yang ada JOIN-nya
        // Supaya kolom 'barber' berisi Nama, bukan cuma Angka ID
        $data['bookings'] = $model->getBookingLengkap();

        return view('admin/data_booking', $data);
    }

    public function tambahBooking()
    {
        $layananModel = new LayananModel();
        $capsterModel = new CapsterModel(); // Load Capster biar admin bisa pilih

        $data['layanans'] = $layananModel->findAll();
        $data['stylists'] = $capsterModel->findAll(); // Kirim data stylist ke form tambah

        return view('admin/tambah_booking', $data);
    }

    public function simpanBooking()
    {
        $bookingModel = new BookingModel();

        // Ambil data barber (bisa kosong jika opsional)
        $barberId = $this->request->getPost('barber');
        if (empty($barberId)) {
            $barberId = null; // Pastikan null jika tidak dipilih
        }

        $data = [
            'id_layanan' => $this->request->getPost('id_layanan'),
            'barber'     => $barberId,
            'tanggal'    => $this->request->getPost('tanggal'),
            'jam'        => $this->request->getPost('jam'),
            'name'       => $this->request->getPost('name'),
            'phone'      => $this->request->getPost('phone'),
            'email'      => $this->request->getPost('email'),
            'note'       => $this->request->getPost('note'),
            'status'     => $this->request->getPost('status') ?? 'pending'
        ];

        $bookingModel->insert($data);

        return redirect()->to('admin/booking')->with('success', 'Booking berhasil ditambahkan.');
    }

    public function updateStatus($id)
    {
        $status = $this->request->getPost('status');

        $allowed = ['pending', 'confirmed', 'done', 'canceled'];
        if (!in_array($status, $allowed)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        $bookingModel = new BookingModel();
        $bookingModel->update($id, ['status' => $status]);

        return redirect()->back()->with('success', 'Status diperbarui.');
    }

    // ================== MANAJEMEN CAPSTER (BARU) ==================
    // Tambahkan ini agar menu 'Kelola Data Capster' berfungsi

    public function capster()
    {
        $model = new CapsterModel();
        $data['capster'] = $model->findAll();
        return view('admin/capster/index', $data); // Sesuaikan nama folder view kamu
    }

    public function createCapster()
    {
        return view('admin/capster/create');
    }

    public function storeCapster()
    {
        $model = new CapsterModel();

        // Upload Foto
        $fileFoto = $this->request->getFile('foto');
        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move('assets/img/capster', $namaFoto);
        } else {
            $namaFoto = 'default.jpg';
        }

        $data = [
            'nama'          => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'spesialisasi'  => $this->request->getPost('spesialisasi'),
            'foto'          => $namaFoto
        ];

        $model->insert($data);
        return redirect()->to('/admin/capster')->with('pesan', 'Data Capster berhasil ditambahkan.');
    }

    public function editCapster($id)
    {
        $model = new CapsterModel();
        $data['capster'] = $model->find($id);
        return view('admin/capster/edit', $data);
    }

    public function updateCapster($id)
    {
        $model = new CapsterModel();
        $oldData = $model->find($id);

        // Cek jika ada upload foto baru
        $fileFoto = $this->request->getFile('foto');
        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move('assets/img/capster', $namaFoto);
            // Hapus foto lama jika bukan default (opsional)
        } else {
            $namaFoto = $oldData['foto'];
        }

        $data = [
            'nama'          => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'spesialisasi'  => $this->request->getPost('spesialisasi'),
            'foto'          => $namaFoto
        ];

        $model->update($id, $data);
        return redirect()->to('/admin/capster')->with('pesan', 'Data Capster berhasil diubah.');
    }

    public function deleteCapster($id)
    {
        $model = new CapsterModel();
        $model->delete($id);
        return redirect()->to('/admin/capster')->with('pesan', 'Data Capster berhasil dihapus.');
    }
}
