<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // sesuaikan dengan nama tabel kamu
    protected $primaryKey = 'id';
<<<<<<< HEAD
    protected $allowedFields = ['email', 'password'];
=======
    protected $allowedFields = ['username', 'password'];
>>>>>>> 1dae537324ce403d4bb1015628acd988641ee27a
}
