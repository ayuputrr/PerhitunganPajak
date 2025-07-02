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
        $model = new LaporanModel();

        $laporan = $model->where('nip', $nip)
                         ->orderBy('tahun', 'DESC')
                         ->orderBy('bulan', 'DESC')
                         ->first();

        return view('pengguna/dashboard', ['laporan' => $laporan]);
    }

    public function arsip()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'pengguna') {
            return redirect()->to('/login/pengguna')->with('error', 'Silakan login terlebih dahulu.');
        }

        $nip = session()->get('nip');
        $model = new LaporanModel();

        $arsip = $model->where('nip', $nip)
                       ->orderBy('tahun DESC, bulan DESC')
                       ->findAll();

        return view('pengguna/arsip', ['arsip' => $arsip]);
    }
}