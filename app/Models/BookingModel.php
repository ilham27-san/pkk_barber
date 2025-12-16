<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_layanan',
        'barber',      // Ini menyimpan ID Capster
        'tanggal',
        'jam',
        'name',
        'phone',
        'email',
        'note',
        'status'
    ];

    protected $useTimestamps = true;

    // --- TAMBAHKAN FUNCTION INI ---
    public function getBookingLengkap()
    {
        return $this->select('bookings.*, capster.nama AS nama_capster') // Ambil nama capster
            ->join('capster', 'capster.id_capster = bookings.barber', 'left') // Hubungkan ID
            ->orderBy('bookings.id', 'DESC') // Urutkan dari yang terbaru
            ->findAll();
    }
}
