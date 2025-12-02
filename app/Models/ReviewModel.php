<?php
namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table      = 'reviews';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'rating', 'komentar', 'created_at', 'updated_at'];
    protected $useTimestamps = true; // created_at/updated_at otomatis hanya jika di-set pada DB/migration
}
