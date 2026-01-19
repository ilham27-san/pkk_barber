<?php

namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\BookingModel;
use App\Models\CapsterModel;

class Booking extends BaseController
{
    protected $layananModel;
    protected $bookingModel;
    protected $capsterModel;

    public function __construct()
    {
        // Inisialisasi Model
        $this->layananModel = new LayananModel();
        $this->bookingModel = new BookingModel();
        $this->capsterModel = new CapsterModel();

        // Load Helper yang dibutuhkan
        helper(['form', 'url', 'session', 'text']);
    }

    // =========================================================================
    // STEP 1: PILIH LAYANAN & CAPSTER
    // =========================================================================
    public function step1()
    {
        // Ambil parameter id_capster dari URL (opsional, misal dari scan QR)
        $selected_capster = $this->request->getGet('id_capster');

        $data = [
            'title'            => 'Pilih Layanan & Stylist',
            'layanan'          => $this->layananModel->findAll(),
            // Ambil hanya capster yang aktif
            'stylists'         => $this->capsterModel->where('status_aktif', 1)->findAll(),
            'selected_capster' => $selected_capster
        ];

        return view('booking/step1', $data);
    }

    public function step1Submit()
    {
        // Validasi: Layanan wajib dipilih
        if (!$this->validate(['id_layanan' => 'required'])) {
            return redirect()->back()->withInput()->with('error', 'Silakan pilih layanan terlebih dahulu.');
        }

        $input = $this->request->getPost();

        // Jika user pilih "Any/Bebas", pastikan nilainya NULL agar dideteksi algoritma
        if (empty($input['id_capster'])) {
            $input['id_capster'] = null;
        }

        session()->set('booking_step1', $input);
        return redirect()->to('/booking/step2');
    }

    // =========================================================================
    // STEP 2: PILIH JADWAL (ALGORITMA CERDAS)
    // =========================================================================
    public function step2()
    {
        // Cegah lompat step
        if (!session()->get('booking_step1')) {
            return redirect()->to('/booking/step1');
        }
        return view('booking/step2');
    }

    public function step2Submit()
    {
        $inputDate = $this->request->getPost('tanggal');
        $inputTime = $this->request->getPost('jam');

        // Validasi Input Dasar
        if (!$inputDate || !$inputTime) {
            return redirect()->back()->withInput()->with('error', 'Tanggal dan Jam wajib diisi.');
        }

        // 1. Ambil Data dari Step 1
        $step1Data    = session()->get('booking_step1');
        $serviceId    = $step1Data['id_layanan'];
        $reqCapsterId = $step1Data['id_capster']; // Bisa NULL (Any)

        // 2. Ambil Durasi Layanan dari Database
        $layanan = $this->layananModel->find($serviceId);
        if (!$layanan) {
            return redirect()->to('/booking/step1')->with('error', 'Layanan tidak valid.');
        }
        $duration = $layanan['durasi'] ?? 30; // Default 30 menit jika tidak diisi

        // ---------------------------------------------------------------------
        // JANTUNG ALGORITMA: CEK KETERSEDIAAN & ASSIGNMENT
        // ---------------------------------------------------------------------
        // Memanggil Model untuk menjalankan Allen's Interval & Load Balancing
        $check = $this->bookingModel->checkAvailability($inputDate, $inputTime, $duration, $reqCapsterId);

        if ($check['status'] === false) {
            // GAGAL: Penuh atau Bentrok
            return redirect()->back()->withInput()->with('error', 'Mohon maaf, jadwal penuh. ' . $check['message']);
        }

        // BERHASIL: Simpan ID Capster yang sudah "Ditetapkan" (Fixed) oleh sistem
        $dataToSave = [
            'tanggal'          => $inputDate,
            'jam'              => $inputTime,
            'fixed_capster_id' => $check['assigned_capster_id']
        ];

        session()->set('booking_step2', $dataToSave);
        return redirect()->to('/booking/step3');
    }

    // =========================================================================
    // STEP 3: DATA DIRI
    // =========================================================================
    public function step3()
    {
        if (!session()->get('booking_step2')) {
            return redirect()->to('/booking/step2');
        }
        return view('booking/step3');
    }

    public function step3Submit()
    {
        // Validasi Form Standar
        if (!$this->validate(['name' => 'required', 'phone' => 'required'])) {
            return redirect()->back()->withInput();
        }

        session()->set('booking_step3', $this->request->getPost());
        return redirect()->to('/booking/step4');
    }

    // =========================================================================
    // STEP 4: REVIEW (CONFIRMATION)
    // =========================================================================
    public function step4()
    {
        $s1 = session()->get('booking_step1');
        $s2 = session()->get('booking_step2');
        $s3 = session()->get('booking_step3');

        if (!$s1 || !$s2 || !$s3) {
            return redirect()->to('/booking/step1');
        }

        // Ambil Data untuk Ditampilkan
        $layananDetail = $this->layananModel->find($s1['id_layanan']);

        // PENTING: Ambil nama capster berdasarkan ID hasil algoritma (Step 2)
        // Bukan ID request awal (Step 1)
        $capsterDetail = $this->capsterModel->find($s2['fixed_capster_id']);

        $data = [
            'booking' => [
                'layanan_nama'  => $layananDetail['nama_layanan'],
                'layanan_harga' => $layananDetail['harga'],
                'capster_nama'  => $capsterDetail['nama'] ?? 'Any Stylist',
                'tanggal'       => $s2['tanggal'],
                'jam'           => $s2['jam'],
                'nama_cust'     => $s3['name'],
                'phone_cust'    => $s3['phone'],
                'email'         => $s3['email'],
                'note_cust'     => $s3['note']
            ]
        ];

        return view('booking/step4', $data);
    }

    // =========================================================================
    // FINAL ACTION: SUBMIT (ALGORITMA OCC & DATABASE INSERT)
    // =========================================================================
    public function submit()
    {
        $s1 = session()->get('booking_step1');
        $s2 = session()->get('booking_step2');
        $s3 = session()->get('booking_step3');

        if (!$s1 || !$s2 || !$s3) {
            return redirect()->to('/booking/step1');
        }

        // Persiapan Data Waktu
        $layanan  = $this->layananModel->find($s1['id_layanan']);
        $duration = $layanan['durasi'] ?? 30;

        $finalCapsterId = $s2['fixed_capster_id'];
        $startTimeStr   = $s2['tanggal'] . ' ' . $s2['jam']; // "2025-10-20 10:00"

        // Hitung End Time (Start + Durasi)
        $endTimeStr = date('Y-m-d H:i:s', strtotime($startTimeStr . " +$duration minutes"));

        // ---------------------------------------------------------------------
        // ALGORITMA 3: OPTIMISTIC CONCURRENCY CONTROL (OCC)
        // ---------------------------------------------------------------------
        // Cek sekali lagi apakah slot ini MASIH kosong?
        // Mencegah Race Condition (Diserobot orang lain saat isi nama)

        $isSafe = $this->bookingModel->isSlotSafe($finalCapsterId, $startTimeStr, $endTimeStr);

        if (!$isSafe) {
            // OCC FAIL: Slot sudah diambil
            session()->remove('booking_step2'); // Reset step waktu
            return redirect()->to('/booking/step2')->with('error', 'Mohon maaf! Slot waktu tersebut baru saja diambil pelanggan lain beberapa detik yang lalu. Silakan pilih jam lain.');
        }

        // ---------------------------------------------------------------------
        // INSERT DATABASE
        // ---------------------------------------------------------------------
        $saveData = [
            // 1. Data Utama Sistem Baru (Untuk Algoritma)
            'id_layanan' => $s1['id_layanan'],
            'id_capster' => $finalCapsterId, // INT
            'start_time' => $startTimeStr,   // DATETIME
            'end_time'   => $endTimeStr,     // DATETIME

            // 2. Data Legacy (Untuk Kompatibilitas Kode Lama)
            'tanggal'     => $s2['tanggal'],
            'jam'         => $s2['jam'],
            'jam_selesai' => date('H:i:s', strtotime($endTimeStr)),

            // 3. Data Pelanggan
            'name'       => $s3['name'],
            'phone'      => $s3['phone'],
            'email'      => $s3['email'],
            'note'       => $s3['note'],

            // 4. Logika Bisnis
            'source'           => 'online',
            'status'           => 'confirmed', // Langsung confirm karena sudah lolos validasi
            'check_in_time'    => null,
            'reschedule_count' => 0
        ];

        // Eksekusi Simpan
        $this->bookingModel->save($saveData);
        $newId = $this->bookingModel->getInsertID();

        // Bersihkan Session
        session()->remove(['booking_step1', 'booking_step2', 'booking_step3']);

        // Redirect ke Resi
        return redirect()->to("/booking/success/$newId");
    }

    // =========================================================================
    // HALAMAN SUKSES (RESI)
    // =========================================================================
    public function success($id)
    {
        // Ambil Data Booking + Nama Layanan + Nama Capster
        // Join ke tabel 'capster' (sesuai nama tabel di DB Anda)
        $booking = $this->bookingModel
            ->select('bookings.*, layanan.nama_layanan, layanan.harga, capster.nama as nama_capster')
            ->join('layanan', 'layanan.id = bookings.id_layanan')
            ->join('capster', 'capster.id_capster = bookings.id_capster') // Relasi FK
            ->where('bookings.id', $id)
            ->first();

        if (!$booking) {
            return redirect()->to('/booking')->with('error', 'Data booking tidak ditemukan.');
        }

        return view('booking/success', ['booking' => $booking]);
    }
}
