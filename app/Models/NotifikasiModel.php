<?php
namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends Model
{
    protected $table = 'notifikasi_pengguna';
    protected $allowedFields = ['nip', 'pesan', 'dibaca', 'created_at'];
}
