<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // sesuaikan dengan nama tabel kamu
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password'];
}
