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
        // 1. Ambil parameter id_capster dari URL (misal: booking?id_capster=5)
        // Kalau tidak ada, nilainya akan null
        $selected_capster = $this->request->getGet('id_capster');

        // Siapkan data
        $data = [
            'title'            => 'Pilih Layanan & Stylist',
            'layanan'          => $this->layananModel->findAll(),

            // Gunakan $this->capsterModel (jangan new lagi)
            'stylists'         => $this->capsterModel->where('status_aktif', 1)->findAll(),

            // Lempar data ini ke View untuk pengecekan
            'selected_capster' => $selected_capster
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
        // 1. Gabungkan semua data session
        $rawSessionData = array_merge(
            session()->get('booking_step1') ?? [],
            session()->get('booking_step2') ?? [],
            session()->get('booking_step3') ?? []
        );

        // Cek jika data kosong (user tembak url)
        if (empty($rawSessionData)) {
            return redirect()->to('/booking/step1');
        }

        // 2. AMBIL NAMA LAYANAN BERDASARKAN ID
        $layananDetail = $this->layananModel->find($rawSessionData['id_layanan']);

        // 3. AMBIL NAMA STYLIST BERDASARKAN ID (Jika dipilih)
        $namaStylist = 'Any Stylist'; // Default
        if (!empty($rawSessionData['id_capster'])) {
            $stylistDetail = $this->capsterModel->find($rawSessionData['id_capster']);
            if ($stylistDetail) {
                $namaStylist = $stylistDetail['nama']; // Pastikan kolom di DB capster namanya 'nama'
            }
        }

        // 4. Siapkan data matang untuk View
        $data = [
            'booking' => [
                // Data Asli (untuk logic submit nanti jika perlu hidden input)
                'id_layanan_raw' => $rawSessionData['id_layanan'],
                'id_capster_raw' => $rawSessionData['id_capster'] ?? null,

                // Data Tampilan (Human Readable)
                'id_layanan'    => $layananDetail['nama_layanan'] ?? 'Layanan Tidak Ditemukan',
                'barber'        => $namaStylist,
                'harga'         => $layananDetail['harga'] ?? 0,

                // Data Inputan User
                'tanggal'       => $rawSessionData['tanggal'] ?? '-',
                'jam'           => $rawSessionData['jam'] ?? '-',
                'name'          => $rawSessionData['name'] ?? '-',
                'phone'         => $rawSessionData['phone'] ?? '-',
                'email'         => $rawSessionData['email'] ?? '-',
                'note'          => $rawSessionData['note'] ?? ''
            ]
        ];

        return view('booking/step4', $data);
    }

    // --- PERBAIKAN LOGIC SUBMIT (DATABASE) ---
    public function submit()
    {
        $sessionData = array_merge(
            session()->get('booking_step1') ?? [],
            session()->get('booking_step2') ?? [],
            session()->get('booking_step3') ?? []
        );

        if (empty($sessionData)) {
            return redirect()->to('/booking/step1');
        }

        // Logic penentuan nama barber (seperti kode Anda)
        $namaStylist = 'Any Stylist';
        if (!empty($sessionData['id_capster'])) {
            $stylist = $this->capsterModel->find($sessionData['id_capster']);
            $namaStylist = $stylist['nama'] ?? 'Any Stylist';
        }

        $saveData = [
            'id_layanan' => $sessionData['id_layanan'],
            'barber'     => $sessionData['id_capster'],
            'tanggal'    => $sessionData['tanggal'],
            'jam'        => $sessionData['jam'],
            'name'       => $sessionData['name'],
            'phone'      => $sessionData['phone'],
            'email'      => $sessionData['email'],
            'note'       => $sessionData['note'],
            'status'     => 'pending'
        ];

        // 1. INSERT DATA
        $this->bookingModel->insert($saveData);

        // 2. AMBIL ID YANG BARU SAJA DIBUAT (PENTING!)
        $newBookingId = $this->bookingModel->getInsertID();

        // 3. HAPUS SESSION
        session()->remove(['booking_step1', 'booking_step2', 'booking_step3']);

        // 4. REDIRECT KE HALAMAN SUKSES MEMBAWA ID
        return redirect()->to("/booking/success/$newBookingId");
    }

    // --- TAMBAHKAN METHOD BARU INI ---
    public function success($id)
    {
        // Cari data booking berdasarkan ID untuk ditampilkan sebagai resi
        // Join dengan tabel layanan supaya nama layanannya muncul, bukan ID doang
        $booking = $this->bookingModel
            ->select('bookings.*, layanan.nama_layanan, layanan.harga') // Sesuaikan nama tabel layanan
            ->join('layanan', 'layanan.id = bookings.id_layanan')
            ->where('bookings.id', $id) // Sesuaikan primary key tabel booking
            ->first();

        // Validasi: Kalau user iseng nembak ID ngawur
        if (!$booking) {
            return redirect()->to('/booking')->with('error', 'Data booking tidak ditemukan.');
        }

        // Ambil nama stylist lagi (karena di booking cuma simpan ID/Nama tergantung struktur DB mu)
        // Kalau di DB booking kolom 'barber' isinya ID, lakukan query lagi ke capsterModel.
        // Kalau isinya sudah Nama, lewatkan saja.
        $namaStylist = 'Any Stylist';
        if (is_numeric($booking['barber'])) {
            $stylist = $this->capsterModel->find($booking['barber']);
            $namaStylist = $stylist['nama'] ?? 'Any Stylist';
        } else {
            $namaStylist = $booking['barber'];
        }

        $data = [
            'title'   => 'Booking Berhasil',
            'booking' => $booking,
            'stylist_name' => $namaStylist
        ];

        return view('booking/success', $data);
    }
}
