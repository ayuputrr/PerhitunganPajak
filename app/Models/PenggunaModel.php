<?php
namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table      = 'pengguna';   // Nama tabel di database
    protected $primaryKey = 'id';          // Primary key

    protected $allowedFields = [
        'nip',
        'password',
        'nama',
        'foto',
        'alamat',
        'telepon',
        'jabatan',
        'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
