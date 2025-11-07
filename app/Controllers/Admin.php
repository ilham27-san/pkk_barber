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

}
