<?php namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\UserModel;
use App\Models\BookingModel;
use CodeIgniter\Controller;

class Admin extends Controller
{
    public function __construct()
    {
        // Pastikan user sudah login
        if (!session()->get('logged_in')) {
            redirect()->to('/login')->send();
            exit;
        }

        // Pastikan user role = admin
        if (session()->get('role') !== 'admin') {
            redirect()->to('/')->with('error', 'Anda tidak memiliki akses ke halaman admin.')->send();
            exit;
        }
    }

    public function index()
    {
        $bookingModel = new BookingModel();
        $userModel = new UserModel();

        $data['total_pelanggan'] = $userModel->where('role', 'pelanggan')->countAllResults();
        $data['total_booking'] = $bookingModel->countAllResults();

        echo view('layout/template', ['content' => view('admin/dashboard', $data)]);
    }

    public function layanan()
    {
        $model = new LayananModel();
        $data['layanan'] = $model->findAll();
        echo view('layout/template', ['content' => view('admin/data_layanan', $data)]);
    }

    public function createLayanan()
    {
        echo view('layout/template', ['content' => view('admin/form_layanan')]);
    }

    public function storeLayanan()
    {
        $model = new LayananModel();
        $model->insert([
            'nama_layanan' => $this->request->getPost('nama_layanan'),
            'harga' => $this->request->getPost('harga'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ]);
        return redirect()->to('/admin/layanan');
    }

    public function editLayanan($id)
    {
        $model = new LayananModel();
        $data['layanan'] = $model->find($id);
        echo view('layout/template', ['content' => view('admin/form_layanan', $data)]);
    }

    public function updateLayanan($id)
    {
        $model = new LayananModel();
        $model->update($id, [
            'nama_layanan' => $this->request->getPost('nama_layanan'),
            'harga' => $this->request->getPost('harga'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ]);
        return redirect()->to('/admin/layanan');
    }

    public function deleteLayanan($id)
    {
        $model = new LayananModel();
        $model->delete($id);
        return redirect()->to('/admin/layanan');
    }

    public function pelanggan()
    {
        $model = new UserModel();
        $data['pelanggan'] = $model->where('role', 'pelanggan')->findAll();
        echo view('layout/template', ['content' => view('admin/data_pelanggan', $data)]);
    }

    public function bookings()
    {
        $model = new BookingModel();
        $data['bookings'] = $model->findAll();
        echo view('layout/template', ['content' => view('admin/data_booking', $data)]);
    }
}
