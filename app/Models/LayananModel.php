<?php
namespace App\Models;

use CodeIgniter\Model;

class LayananModel extends Model
{
    protected $table = 'layanan'; // sesuai database
    protected $primaryKey = 'id'; // ubah jika nama kolom primary key beda
    protected $allowedFields = ['nama_layanan', 'harga', 'deskripsi'];
}
