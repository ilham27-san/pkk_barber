<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
    protected $table = 'contact_messages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'email', 'pesan', 'created_at'];
    protected $useTimestamps = true;
}
