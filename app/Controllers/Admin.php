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
        $data['total_booking'] = $bookingModel->countAllResults();

        echo view('admin/dashboard', $data);
    }

    public function layanan()
    {
        $model = new LayananModel();
        $data['layanan'] = $model->findAll();
        echo view('admin/data_layanan', $data);
    }

    public function pelanggan()
    {
        $model = new UserModel();
        $data['pelanggan'] = $model->where('role', 'pelanggan')->findAll();
        echo view('admin/data_pelanggan', $data);
    }

 public function booking()
{
    $model = new \App\Models\BookingModel();
    $data['bookings'] = $model->findAll();
    echo view('admin/data_booking', $data);
}

public function tambah_booking()
{
    $userModel = new \App\Models\UserModel();
    $layananModel = new \App\Models\LayananModel();

    $data['users'] = $userModel->where('role', 'pelanggan')->findAll();
    $data['layanans'] = $layananModel->findAll();

    echo view('admin/tambah_booking', $data);
}

public function simpan_booking()
{
    $model = new \App\Models\BookingModel();

    $data = [
        'id_user' => $this->request->getPost('id_user'),
        'id_layanan' => $this->request->getPost('id_layanan'),
        'tanggal' => $this->request->getPost('tanggal'),
        'jam' => $this->request->getPost('jam'),
        'status' => $this->request->getPost('status')
    ];

    $model->insert($data);

    return redirect()->to('/admin/booking')->with('success', 'Booking berhasil ditambahkan.');
}


}
