<?php
namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table      = 'pengguna'; // Nama tabel di database
    protected $primaryKey = 'id';       // Primary key sesuai struktur tabel

    protected $allowedFields = [
        'nip', 'password', 'nama', 'foto', 'alamat', 'telepon', 'jabatan', 'status'
    ];

}
