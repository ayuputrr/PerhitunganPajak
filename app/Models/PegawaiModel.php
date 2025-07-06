<?php namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama', 'nip', 'gaji_pokok', 'tunj_suami_istri', 'tunj_anak',
        'tunj_jabatan', 'tunj_beras', 'tunj_lain', 'status', 'iuran_pensiun',
        'tpp', 'thr_gaji', 'thr_tpp', 'gaji13', 'tpp13',
        'bruto_bulanan', 'pph_bruto_bulanan', 'pph_bruto_tpp_bulanan',
        'bruto_tahunan', 'iuran_tahunan', 'biaya_jabatan',
        'total_pengurangan', 'netto_tahunan', 'ptkp', 'pkp', 'pph_setahun',
        'bulan', 'tahun', 'tarif'
    ];

public function getAllByNip($nip)
{
    return $this->where('nip', $nip)->findAll();
}
}