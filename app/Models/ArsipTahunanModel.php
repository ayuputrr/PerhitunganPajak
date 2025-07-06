<?php

namespace App\Models;

use CodeIgniter\Model;

class ArsipTahunanModel extends Model
{
    protected $table = 'arsip_tahunan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nip', 'nama', 'status', 'tahun',
        'iuran_tahunan', 'tpp', 'thr_gaji', 'thr_tpp', 'gaji13', 'tpp13',
        'bruto_tahunan', 'biaya_jabatan', 'total_pengurangan', 'netto_tahunan',
        'ptkp', 'pkp', 'pph_setahun', 'tarif','tahun','bulan'
    ];
}
