<?php

namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\UserModel;
use App\Models\BookingModel;
use App\Models\CapsterModel;
use CodeIgniter\Controller;

class Admin extends Controller
{
    protected $layananModel;
    protected $bookingModel;
    protected $capsterModel;
    protected $userModel;

    public function __construct()
    {
        $this->layananModel = new LayananModel();
        $this->bookingModel = new BookingModel();
        $this->capsterModel = new CapsterModel();
        $this->userModel    = new UserModel();

        helper(['form', 'url', 'session']);
    }

    public function index()
    {
        $data['total_pelanggan'] = $this->userModel->where('role', 'pelanggan')->countAllResults();
        $data['total_booking']   = $this->bookingModel->countAllResults();

        return view('admin/dashboard', $data);
    }

    // ================== LAYANAN ==================
    public function layanan()
    {
        $data['layanan'] = $this->layananModel->findAll();
        return view('admin/data_layanan', $data);
    }

    public function createLayanan()
    {
        return view('admin/tambah_layanan');
    }

    public function storeLayanan()
    {
        $data = [
            'nama_layanan' => $this->request->getPost('nama_layanan'),
            'harga'        => $this->request->getPost('harga'),
            'durasi'       => $this->request->getPost('durasi') ?? 30, // Default 30 menit
            'deskripsi'    => $this->request->getPost('deskripsi')
        ];
        $this->layananModel->insert($data);
        return redirect()->to('/admin/layanan')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function editLayanan($id)
    {
        $data['layanan'] = $this->layananModel->find($id);
        if (!$data['layanan']) {
            return redirect()->to('/admin/layanan')->with('error', 'Data layanan tidak ditemukan.');
        }
        return view('admin/edit_layanan', $data);
    }

    public function updateLayanan($id)
    {
        $data = [
            'nama_layanan' => $this->request->getPost('nama_layanan'),
            'harga'        => $this->request->getPost('harga'),
            'durasi'       => $this->request->getPost('durasi'),
            'deskripsi'    => $this->request->getPost('deskripsi')
        ];
        $this->layananModel->update($id, $data);
        return redirect()->to('/admin/layanan')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function deleteLayanan($id)
    {
        $this->layananModel->delete($id);
        return redirect()->to('/admin/layanan')->with('success', 'Layanan berhasil dihapus.');
    }


    // ================== PELANGGAN ==================
    public function pelanggan()
    {
        $data['pelanggan'] = $this->userModel->where('role', 'pelanggan')->findAll();
        return view('admin/data_pelanggan', $data);
    }

    // ================== BOOKING (LOGIC DIPERBARUI) ==================
    public function booking()
    {
        // Gunakan getBookingLengkap yang ada JOIN-nya
        $data['bookings'] = $this->bookingModel->getBookingLengkap();
        return view('admin/data_booking', $data);
    }

    public function tambahBooking()
    {
        $data['layanans'] = $this->layananModel->findAll();
        $data['stylists'] = $this->capsterModel->where('status_aktif', 1)->findAll();

        return view('admin/tambah_booking', $data);
    }

    // --- LOGIC SIMPAN BOOKING MANUAL (ADMIN) ---
    public function simpanBooking()
    {
        // 1. Validasi Input
        if (!$this->validate([
            'name'       => 'required',
            'phone'      => 'required',
            'id_layanan' => 'required',
            'tanggal'    => 'required',
            'jam'        => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Ambil Input
        $idLayanan  = $this->request->getPost('id_layanan');
        $idCapster  = $this->request->getPost('id_capster'); // Bisa kosong (Any)
        $tanggal    = $this->request->getPost('tanggal');
        $jam        = $this->request->getPost('jam');
        $status     = $this->request->getPost('status');

        // Pastikan id_capster NULL jika kosong
        if (empty($idCapster)) $idCapster = null;

        // 3. Hitung Waktu (Algoritma Requirement)
        $layanan = $this->layananModel->find($idLayanan);
        $durasi  = $layanan['durasi'] ?? 30;

        $startTimeStr = $tanggal . ' ' . $jam; // "2023-10-20 10:00"
        $endTimeStr   = date('Y-m-d H:i:s', strtotime($startTimeStr . " +$durasi minutes"));

        // 4. (Opsional) Cek Bentrok - Admin biasanya punya kuasa override, 
        // tapi sebaiknya kita cek biar data valid.
        if ($idCapster) {
            $isSafe = $this->bookingModel->isSlotSafe($idCapster, $startTimeStr, $endTimeStr);
            if (!$isSafe) {
                return redirect()->back()->withInput()->with('error', 'PERINGATAN: Capster tersebut sudah ada jadwal di jam ini. Silakan pilih jam atau capster lain.');
            }
        }

        // 5. Susun Data Insert
        $data = [
            // Data Algoritma
            'id_layanan' => $idLayanan,
            'id_capster' => $idCapster,
            'start_time' => $startTimeStr,
            'end_time'   => $endTimeStr,

            // Data Legacy (Kompatibilitas)
            'tanggal'     => $tanggal,
            'jam'         => $jam,
            'jam_selesai' => date('H:i:s', strtotime($endTimeStr)),

            // Data Diri
            'name'       => $this->request->getPost('name'),
            'phone'      => $this->request->getPost('phone'),
            'email'      => $this->request->getPost('email'),
            'note'       => $this->request->getPost('note'),

            // System logic
            'source'           => 'walk_in', // Karena diinput admin
            'status'           => $status,
            'check_in_time'    => ($status == 'process') ? date('Y-m-d H:i:s') : null,
            'reschedule_count' => 0
        ];

        $this->bookingModel->insert($data);

        return redirect()->to('admin/booking')->with('success', 'Booking manual berhasil ditambahkan.');
    }

    public function updateStatus($id)
    {
        $status = $this->request->getPost('status');

        // Data update
        $updateData = ['status' => $status];

        // Jika status diubah jadi 'process' (pelanggan datang), catat check_in_time
        if ($status == 'process') {
            $updateData['check_in_time'] = date('Y-m-d H:i:s');
        }

        $this->bookingModel->update($id, $updateData);

        return redirect()->back()->with('success', 'Status booking diperbarui.');
    }

    // ================== MANAJEMEN CAPSTER ==================
    public function capster()
    {
        $data['capster'] = $this->capsterModel->findAll();
        return view('admin/capster/index', $data);
    }

    public function createCapster()
    {
        return view('admin/capster/create');
    }

    public function storeCapster()
    {
        // Upload Foto
        $fileFoto = $this->request->getFile('foto');
        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move('assets/img/capster', $namaFoto);
        } else {
            $namaFoto = 'default.jpg';
        }

        $data = [
            'nama'          => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'spesialisasi'  => $this->request->getPost('spesialisasi'),
            'foto'          => $namaFoto,
            'status_aktif'  => 1
        ];

        $this->capsterModel->insert($data);
        return redirect()->to('/admin/capster')->with('pesan', 'Data Capster berhasil ditambahkan.');
    }

    public function editCapster($id)
    {
        $data['capster'] = $this->capsterModel->find($id);
        return view('admin/capster/edit', $data);
    }

    public function updateCapster($id)
    {
        $oldData = $this->capsterModel->find($id);

        $fileFoto = $this->request->getFile('foto');
        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move('assets/img/capster', $namaFoto);
        } else {
            $namaFoto = $oldData['foto'];
        }

        $data = [
            'nama'          => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'spesialisasi'  => $this->request->getPost('spesialisasi'),
            'foto'          => $namaFoto
        ];

        $this->capsterModel->update($id, $data);
        return redirect()->to('/admin/capster')->with('pesan', 'Data Capster berhasil diubah.');
    }

    public function deleteCapster($id)
    {
        $this->capsterModel->delete($id);
        return redirect()->to('/admin/capster')->with('pesan', 'Data Capster berhasil dihapus.');
    }
}
