<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table = 'arsip_laporan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nip', 'nama', 'bulan', 'tahun', 'bruto_bulanan', 'pph_bruto_bulanan', 'pph_bruto_tpp_bulanan'];
    protected $useTimestamps = true;
}
