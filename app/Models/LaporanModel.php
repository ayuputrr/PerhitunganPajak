<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table = 'arsip_laporan';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nip',
        'nama',
        'status',
        'gaji_pokok',
        'tunj_suami_istri',
        'tunj_anak',
        'tunj_jabatan',
        'tunj_beras',
        'tunj_lain',
        'bruto_bulanan',
        'pph_bruto_bulanan',
        'pph_bruto_tpp_bulanan',
        'bulan',
        'tahun',
        'created_at'
    ];

    protected $useTimestamps = false;
}
