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

    public function layanan()
    {
        $model = new LayananModel();
        $data['layanan'] = $model->findAll();

        return view('admin/data_layanan', $data);
    }

    public function pelanggan()
    {
        $model = new UserModel();
        $data['pelanggan'] = $model->where('role', 'pelanggan')->findAll();

        return view('admin/data_pelanggan', $data);
    }

    public function booking()
    {
        $model = new BookingModel();
        $data['bookings'] = $model->findAll();

        return view('admin/data_booking', $data);
    }

    public function tambah_booking()
{
    $layananModel = new LayananModel();

    $data = [
        'layanans' => $layananModel->findAll()
    ];

    return view('admin/tambah_booking', $data);
}

public function simpan_booking()
{
    $bookingModel = new BookingModel();

    $data = [
        'id_layanan' => $this->request->getPost('id_layanan'),
        'barber'     => $this->request->getPost('barber'),
        'tanggal'    => $this->request->getPost('tanggal'),
        'jam'        => $this->request->getPost('jam'),

        // admin input manual
        'name'       => $this->request->getPost('name'),
        'phone'      => $this->request->getPost('phone'),
        'email'      => $this->request->getPost('email'),

        'note'       => $this->request->getPost('note'),
        'status'     => $this->request->getPost('status') ?? 'pending'
    ];

    $bookingModel->insert($data);

    return redirect()->to('/admin/booking')->with('success', 'Booking berhasil ditambahkan.');
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
