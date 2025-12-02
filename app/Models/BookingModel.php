<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table      = 'booking';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_user',
        'id_layanan',
        'tanggal',
        'jam',
        'status'
    ];
}
