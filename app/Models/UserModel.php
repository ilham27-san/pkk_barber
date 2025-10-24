<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    // [FIX 1] Ini untuk mengatasi error 'updated_at'
    protected $useTimestamps = false;

    // [FIX 2] Pastikan nama tabelnya benar
    protected $table = 'users';

    // [FIX 3 - PALING PENTING]
    // Pastikan 'password' ada di dalam array ini!
    protected $allowedFields = ['username', 'email', 'password', 'role'];

    // ... sisa kode model Anda (jika ada) ...
}
