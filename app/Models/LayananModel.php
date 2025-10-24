<?php namespace App\Models;
use CodeIgniter\Model;

class LayananModel extends Model {
    protected $table = 'layanan';
    protected $allowedFields = ['nama_layanan','harga','deskripsi'];
    protected $useTimestamps = true;
}
