<?php namespace App\Models;

use CodeIgniter\Model;

class PegawaiGajiModel extends Model
{
    protected $table = 'pegawai_gaji';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nip','nama', 'status','bulan', 'tahun', 'gaji_pokok', 'tunj_suami_istri', 'tunj_anak',
        'tunj_jabatan', 'tunj_beras', 'tunj_lain', 'tpp', 'thr_gaji', 'thr_tpp',
        'gaji13', 'tpp13', 'bruto_bulanan', 'pph_bruto_bulanan', 'pph_bruto_tpp_bulanan',
        'bruto_tahunan', 'iuran_pensiun', 'iuran_tahunan', 'biaya_jabatan',
        'total_pengurangan', 'netto_tahunan', 'ptkp', 'pkp', 'pph_setahun',
        'tarif', 'created_at','bulan', 'tahun'
    ];
    public $timestamps = false;
}
