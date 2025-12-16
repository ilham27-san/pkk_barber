<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_layanan',
        'barber',
        'tanggal',
        'jam',
        'name',
        'phone',
        'email',
        'note',
        'status' // ini yang hilang
    ];

    protected $useTimestamps = true;
}
