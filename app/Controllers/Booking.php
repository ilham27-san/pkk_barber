<?php

namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\BookingModel;
use App\Models\CapsterModel; // 1. IMPORT MODEL CAPSTER

class Booking extends BaseController
{
    protected $layananModel;
    protected $bookingModel;
    protected $capsterModel; // 2. DEFINISIKAN PROPERTI

    public function __construct()
    {
        $this->layananModel = new LayananModel();
        $this->bookingModel = new BookingModel();
        $this->capsterModel = new CapsterModel(); // 3. INISIALISASI

        helper(['form', 'url', 'session']);
    }

    public function step1()
    {
        // Load Model
        $capsterModel = new CapsterModel();

        // Siapkan data
        $data = [
            'title'   => 'Pilih Layanan & Stylist',
            // Ambil layanan (asumsi $this->layananModel sudah ada di construct)
            'layanan' => $this->layananModel->findAll(),

            // LOGIKA BARU: Ambil capster yang status_aktif = 1
            'stylists' => $capsterModel->where('status_aktif', 1)->findAll()
        ];

        return view('booking/step1', $data);
    }

    public function step1Submit()
    {
        // Validasi input agar user tidak bisa lanjut tanpa memilih (opsional tapi disarankan)
        if (!$this->validate([
            'id_layanan' => 'required',
            // 'id_capster' => 'required' // Uncomment jika stylist wajib dipilih
        ])) {
            return redirect()->back()->withInput();
        }

        session()->set('booking_step1', $this->request->getPost());
        return redirect()->to('/booking/step2');
    }

    // ... function step2, step3, dst (biarkan tetap sama) ...

    public function step2()
    {
        return view('booking/step2');
    }

    public function step2Submit()
    {
        session()->set('booking_step2', $this->request->getPost());
        return redirect()->to('/booking/step3');
    }

    public function step3()
    {
        return view('booking/step3');
    }

    public function step3Submit()
    {
        session()->set('booking_step3', $this->request->getPost());
        return redirect()->to('/booking/step4');
    }

    public function step4()
    {
        $data['booking'] = array_merge(
            session()->get('booking_step1') ?? [],
            session()->get('booking_step2') ?? [],
            session()->get('booking_step3') ?? []
        );
        return view('booking/step4', $data);
    }

    public function submit()
    {
        $bookingData = array_merge(
            session()->get('booking_step1') ?? [],
            session()->get('booking_step2') ?? [],
            session()->get('booking_step3') ?? []
        );

        // Pastikan field di database booking sesuai dengan key array ini
        $this->bookingModel->insert($bookingData);

        session()->remove(['booking_step1', 'booking_step2', 'booking_step3']);
        return redirect()->to('/booking')->with('success', 'Booking berhasil!');
    }
}
