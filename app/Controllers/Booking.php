<?php namespace App\Controllers;
use App\Models\BookingModel;
use App\Models\LayananModel;
use CodeIgniter\Controller;

class Booking extends Controller {
    public function form($layananId) {
        $layananModel = new LayananModel();
        $data['layanan'] = $layananModel->find($layananId);
        echo view('layout/template', ['content' => view('booking/form_booking', $data)]);
    }

    public function submit() {
        $session = session();
        if (! $session->get('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error','Silakan login terlebih dahulu');
        }

        $bookingModel = new BookingModel();
        $data = [
            'id_user' => $session->get('id'),
            'id_layanan' => $this->request->getPost('id_layanan'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jam' => $this->request->getPost('jam'),
            'status' => 'pending'
        ];
        $bookingModel->insert($data);
        return redirect()->to('/')->with('success','Booking berhasil dibuat');
    }
}
