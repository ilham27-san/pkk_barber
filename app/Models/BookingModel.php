<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_layanan',
        'barber',      // ID Capster
        'tanggal',
        'jam',
        'name',
        'phone',
        'email',
        'note',
        'status'
    ];

    protected $useTimestamps = true;

    // --- FUNCTION INI HARUS JOIN KE DUA TABEL (CAPSTER & LAYANAN) ---
    public function getBookingLengkap()
    {
        return $this->select('bookings.*, capster.nama AS nama_capster, layanan.nama_layanan') // Ambil juga nama_layanan
            ->join('capster', 'capster.id_capster = bookings.barber', 'left') // Join tabel capster
            ->join('layanan', 'layanan.id = bookings.id_layanan', 'left')    // Join tabel layanan (PENTING!)
            ->orderBy('bookings.id', 'DESC')
            ->findAll();
    }
}
