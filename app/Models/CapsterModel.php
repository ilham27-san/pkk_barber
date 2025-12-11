<?php namespace App\Models;

use CodeIgniter\Model;

class CapsterModel extends Model
{
    protected $table      = 'capster'; // Nama tabel Anda
    protected $primaryKey = 'id_capster';

    protected $useAutoIncrement = true;

    // Kolom-kolom yang diperbolehkan untuk diisi
    protected $allowedFields = [
        'nama', 
        'jenis_kelamin', 
        'tanggal_bergabung', 
        'spesialisasi', 
        'deskripsi', 
        'foto', 
        'status_aktif'
    ];

    // Gunakan fitur waktu (opsional, jika Anda ingin melacak kapan data dibuat/diubah)
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at'; // Jika menggunakan soft delete

    // Atur jenis data yang dikembalikan
    protected $returnType = 'array';
}