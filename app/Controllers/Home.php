<?php namespace App\Controllers;
use App\Models\LayananModel;
use CodeIgniter\Controller;

class Home extends Controller {
    public function index() {
        $layananModel = new LayananModel();
        $data['layanan'] = $layananModel->findAll();
        echo view('layout/template', ['content' => view('home/index', $data)]);
    }

    public function layanan() {
        $layananModel = new LayananModel();
        $data['layanan'] = $layananModel->findAll();
        echo view('layout/template', ['content' => view('home/layanan', $data)]);
    }
}
