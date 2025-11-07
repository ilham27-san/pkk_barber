<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'booking'; // nama tabel di database kamu
    protected $primaryKey = 'id'; // sesuaikan jika kolom primernya lain

    protected $allowedFields = [
        'nama_pelanggan',
        'layanan',
        'tanggal_booking',
        'jam_booking',
        'status'
    ];
}
