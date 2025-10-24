<?php namespace App\Models;
use CodeIgniter\Model;

class ReviewModel extends Model {
    protected $table = 'review';
    protected $allowedFields = ['id_user','id_layanan','rating','komentar'];
    protected $useTimestamps = true;
}
