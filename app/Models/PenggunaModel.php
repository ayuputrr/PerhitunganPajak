<?php
namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table = 'pengguna';
    protected $primaryKey = 'nip';
    protected $allowedFields = ['nip', 'password', 'nama', 'foto', 'alamat', 'telepon', 'jabatan', 'status'];
}
