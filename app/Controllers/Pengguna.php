<?php

namespace App\Controllers;

use App\Models\ArsipLaporanModel;
use App\Models\LaporanModel;
use App\Models\PegawaiModel;
use CodeIgniter\Controller;

class Pengguna extends Controller
{
    public function dashboard()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'pengguna') {
            return redirect()->to('/login/pengguna')->with('error', 'Silakan login terlebih dahulu.');
        }

        $nip = session()->get('nip');
        $laporanModel = new LaporanModel();
        $pegawaiModel = new PegawaiModel();

        $laporan = $laporanModel->where('nip', $nip)
                                ->orderBy('tahun', 'DESC')
                                ->orderBy('bulan', 'DESC')
                                ->first();

        $pegawai = $pegawaiModel->where('nip', $nip)->first();

        return view('pengguna/dashboard', [
            'laporan' => $laporan,
            'pegawai' => $pegawai
        ]);
    }

    public function arsip()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'pengguna') {
            return redirect()->to('/login/pengguna')->with('error', 'Silakan login terlebih dahulu.');
        }

        $nip = session()->get('nip');
        $laporanModel = new LaporanModel();
        $pegawaiModel = new PegawaiModel();

        $arsip = $laporanModel->where('nip', $nip)
                              ->orderBy('tahun DESC, bulan DESC')
                              ->findAll();

        $pegawai = $pegawaiModel->where('nip', $nip)->first();

        return view('pengguna/arsip', [
            'arsip' => $arsip,
            'pegawai' => $pegawai
        ]);
    }

    public function exportPdf($id)
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'pengguna') {
            return redirect()->to('/login/pengguna')->with('error', 'Silakan login terlebih dahulu.');
        }

        $nip = session()->get('nip');
        $laporanModel = new LaporanModel();
        $laporan = $laporanModel->find($id);

        if (!$laporan || $laporan['nip'] !== $nip) {
            return redirect()->to('/pengguna/dashboard')->with('error', 'Akses tidak diizinkan.');
        }

        $html = view('pengguna/pajak_pdf', ['laporan' => $laporan]);

        helper('pdf');
        generatePdf($html, 'Laporan_Pajak_' . $laporan['bulan'] . '_' . $laporan['tahun']);
    }
}
