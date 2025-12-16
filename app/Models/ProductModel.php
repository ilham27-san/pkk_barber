<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model {
    protected $table      = 'products';
    protected $primaryKey = 'id';
    // Sesuaikan dengan gambar database yang Anda berikan
    protected $allowedFields = ['nama_produk', 'harga', 'deskripsi', 'gambar'];
}
