<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_layanan',
        'id_capster',
        'start_time',
        'end_time',
        'name',
        'phone',
        'email',
        'note',
        'tanggal',
        'jam',
        'jam_selesai',
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
        // Cek status confirmed, pending, DAN process (sedang dicukur)
        $collision = $this->where('id_capster', $capsterId)
            ->whereIn('status', ['confirmed', 'pending', 'process'])
            ->groupStart()
            ->where('start_time <', $endTime)
            ->where('end_time >', $startTime)
            ->groupEnd()
            ->countAllResults();

        return $collision == 0;
    }

    public function getBookingLengkap($id = null)
    {
        $builder = $this->select('bookings.*, capster.nama AS nama_capster, layanan.nama_layanan')
            ->join('capster', 'capster.id_capster = bookings.id_capster', 'left')
            ->join('layanan', 'layanan.id = bookings.id_layanan', 'left');

        // Jika ambil 1 data (Detail)
        if ($id) {
            $data = $builder->where('bookings.id', $id)->first();
            return $this->processLateStatus($data);
        }

        // Jika ambil semua data (List)
        $bookings = $builder->orderBy('bookings.start_time', 'DESC')->findAll();

        // Proses setiap baris data menggunakan array_map (Inject Status Telat & Kode Booking)
        return array_map([$this, 'processLateStatus'], $bookings);
    }

    // =========================================================================
    // PRIVATE METHODS
    // =========================================================================

    // --- LOGIC CENTRAL: Menghitung Telat, Format Tanggal & GENERATE KODE UNIK ---
    private function processLateStatus($booking)
    {
        if (!$booking) return $booking;

        // 1. Set Timezone
        date_default_timezone_set('Asia/Jakarta');
        $now = time();

        // 2. Parsing Waktu
        if (!empty($booking['start_time'])) {
            $bookingTime = strtotime($booking['start_time']);
        } else {
            // Fallback data lama
            $bookingTime = strtotime($booking['tanggal'] . ' ' . $booking['jam']);
        }

        // 3. Siapkan Data Tampilan (Biar View tinggal echo)
        $booking['display_date'] = date('d M Y', $bookingTime);
        $booking['display_time'] = date('H:i', $bookingTime);

        // 4. Hitung Keterlambatan
        $booking['is_late'] = false; // Default
        $threshold = 15; // menit

        if (in_array($booking['status'], ['confirmed', 'pending'])) {
            $limitTime = $bookingTime + ($threshold * 60);
            if ($now > $limitTime) {
                $booking['is_late'] = true; // Tandai telat
            }
        }

        // 5. GENERATE KODE BOOKING UNIK (BN-XXXXX)
        // Logika: ID * 47 -> Hex -> Uppercase -> Pad -> Prefix BN
        $acak = $booking['id'] * 47;
        $hex = dechex($acak);
        $code = strtoupper(str_pad($hex, 5, '0', STR_PAD_LEFT));
        $booking['booking_code'] = "BN-" . $code;

        return $booking;
    }

    private function getBestCapster($start, $end)
    {
        $db = \Config\Database::connect();
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
        // Hitung beban kerja (Kecuali canceled & no_show)
        return $this->where('id_capster', $capsterId)
            ->like('start_time', $today, 'after')
            ->whereNotIn('status', ['canceled', 'no_show'])
            ->countAllResults();
    }
}
