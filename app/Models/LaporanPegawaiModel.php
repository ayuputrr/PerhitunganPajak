<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanPegawaiModel extends Model
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

    /**
     * Ambil data laporan bulanan pegawai dengan filter bulan dan status.
     * @param int $bulan
     * @param string $status ('sudah', 'belum', 'all')
     * @return array
     */
    public function getLaporanBulanan($bulan, $status = 'all')
    {
        // Pastikan $bulan adalah integer (1-12)
        $bulan = (int)$bulan;

        $builder = $this->where('bulan', $bulan);

        if ($status === 'sudah') {
            $builder = $builder->where('pph_bruto_bulanan IS NOT NULL')->where('pph_bruto_bulanan !=', 0);
        } elseif ($status === 'belum') {
            $builder = $builder->groupStart()
                ->where('pph_bruto_bulanan', null)
                ->orWhere('pph_bruto_bulanan', 0)
                ->groupEnd();
        }
        // Jika 'all', tidak perlu filter status

        return $builder->findAll();
    }

    /**
     * Ambil data laporan tahunan pegawai.
     * @param int $tahun
     * @param string $status
     * @return array
     */
    public function getLaporanTahunan($tahun, $status = 'all')
    {
        $builder = $this->where('tahun', $tahun);

        if ($status && $status !== 'all') {
            $builder = $builder->where('status', $status);
        }

        return $builder->findAll();
    }
}
