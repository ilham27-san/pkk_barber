<?php

namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\UserModel;
use App\Models\BookingModel;
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

    // ================== BOOKING ==================
    public function booking()
    {
        $model = new BookingModel();
        $data['bookings'] = $model->findAll();

        return view('admin/data_booking', $data);
    }

    public function tambahBooking()
    {
        $layananModel = new LayananModel();
        $data['layanans'] = $layananModel->findAll();

        return view('admin/tambah_booking', $data);
    }

    public function simpanBooking()
    {
        $bookingModel = new BookingModel();

        $data = [
            'id_layanan' => $this->request->getPost('id_layanan'),
            'barber'     => $this->request->getPost('barber'),
            'tanggal'    => $this->request->getPost('tanggal'),
            'jam'        => $this->request->getPost('jam'),
            'name'       => $this->request->getPost('name'),
            'phone'      => $this->request->getPost('phone'),
            'email'      => $this->request->getPost('email'),
            'note'       => $this->request->getPost('note'),
            'status'     => $this->request->getPost('status') ?? 'pending'
        ];

        $bookingModel->insert($data);

        return redirect()->to('/booking')->with('success', 'Booking berhasil ditambahkan.');
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
}
