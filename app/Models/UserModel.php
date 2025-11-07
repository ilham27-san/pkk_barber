<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // sesuai database
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'email', 'password', 'role'];
}
