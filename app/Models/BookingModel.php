<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';

    // Sesuaikan dengan kolom yang baru kita tambah
    protected $allowedFields = [
        'id_layanan',
        'id_capster',       // Sudah diganti dari 'barber'
        'start_time',       // Wajib ada untuk algoritma
        'end_time',         // Wajib ada untuk algoritma

        // Data Diri
        'name',
        'phone',
        'email',
        'note',

        // Logika Sistem & Legacy
        'tanggal',
        'jam',
        'jam_selesai', // Tetap simpan untuk kompatibilitas data lama
        'status',
        'source',
        'check_in_time',
        'reschedule_count'
    ];

    protected $useTimestamps = true;

    // =========================================================================
    // PUBLIC METHODS
    // =========================================================================

    public function checkAvailability($date, $time, $durationMinutes, $reqCapsterId = null)
    {
        $startTimeStr = date('Y-m-d H:i:s', strtotime("$date $time"));
        $endTimeStr   = date('Y-m-d H:i:s', strtotime("$startTimeStr +$durationMinutes minutes"));

        // SKENARIO A: User Pilih Capster Tertentu
        if ($reqCapsterId != null) {
            if ($this->isSlotSafe($reqCapsterId, $startTimeStr, $endTimeStr)) {
                return ['status' => true, 'assigned_capster_id' => $reqCapsterId];
            }
            return ['status' => false, 'message' => 'Capster pilihan sedang sibuk.'];
        }

        // SKENARIO B: User Pilih "Bebas" (Auto-Assign)
        $bestCapster = $this->getBestCapster($startTimeStr, $endTimeStr);
        if ($bestCapster) {
            return ['status' => true, 'assigned_capster_id' => $bestCapster];
        }

        return ['status' => false, 'message' => 'Semua capster sibuk.'];
    }

    public function isSlotSafe($capsterId, $startTime, $endTime)
    {
        // ALLEN'S INTERVAL ALGEBRA
        $collision = $this->where('id_capster', $capsterId)
            ->whereIn('status', ['confirmed', 'pending']) // Cek pending juga biar aman
            ->groupStart()
            ->where('start_time <', $endTime)
            ->where('end_time >', $startTime)
            ->groupEnd()
            ->countAllResults();

        return $collision == 0;
    }

    public function getBookingLengkap($id = null)
    {
        // PERHATIKAN: Join ke tabel 'capster' (bukan capsters)
        $builder = $this->select('bookings.*, capster.nama AS nama_capster, layanan.nama_layanan')
            ->join('capster', 'capster.id_capster = bookings.id_capster', 'left')
            ->join('layanan', 'layanan.id = bookings.id_layanan', 'left');

        if ($id) {
            return $builder->where('bookings.id', $id)->first();
        }

        return $builder->orderBy('bookings.start_time', 'DESC')->findAll();
    }

    // =========================================================================
    // PRIVATE METHODS
    // =========================================================================

    private function getBestCapster($start, $end)
    {
        $db = \Config\Database::connect();

        // Ambil capster aktif dari tabel 'capster'
        $allCapsters = $db->table('capster')->where('status_aktif', 1)->get()->getResultArray();

        $availableCapsters = [];
        foreach ($allCapsters as $capster) {
            if ($this->isSlotSafe($capster['id_capster'], $start, $end)) {
                $availableCapsters[] = $capster['id_capster'];
            }
        }

        if (empty($availableCapsters)) return false;
        if (count($availableCapsters) == 1) return $availableCapsters[0];

        // Load Balancing
        $bestCapsterId = null;
        $minJob = 9999;

        foreach ($availableCapsters as $capId) {
            $dailyLoad = $this->getDailyLoad($capId);
            if ($dailyLoad < $minJob) {
                $minJob = $dailyLoad;
                $bestCapsterId = $capId;
            }
        }
        return $bestCapsterId;
    }

    private function getDailyLoad($capsterId)
    {
        $today = date('Y-m-d');
        return $this->where('id_capster', $capsterId)
            ->like('start_time', $today, 'after')
            ->where('status !=', 'cancelled') // Sesuaikan enum di DB Anda ('cancelled' double L)
            ->countAllResults();
    }
}
