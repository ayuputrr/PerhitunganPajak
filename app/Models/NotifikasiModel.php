<?php
namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends Model
{
    protected $table = 'notifikasi_pengguna';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['nip','nama', 'pesan', 'dibaca', 'bulan','tahun','created_at','sudah_popup'];
    protected $useTimestamps = true; // aktifkan timestamps
    protected $createdField  = 'created_at'; // pastikan sesuai kolom di database
    protected $updatedField  = ''; // kosongkan jika tidak pakai updated_at
}
