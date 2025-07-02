<<<<<<< HEAD
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
=======
<?php namespace App\Controllers;

use App\Models\PegawaiModel;

class Pengguna extends BaseController
{
    public function cek()
    {
        return view('pengguna/cek_nip');
    }

    public function lihat()
    {
        $nip = $this->request->getPost('nip');
        $model = new PegawaiModel();
        $pegawai = $model->where('nip', $nip)->first();

        if (!$pegawai) {
            return redirect()->to('/pengguna/cek')->with('error', 'NIP tidak ditemukan.');
        }

        // Simpan NIP ke session
        session()->set('nip_pengguna', $nip);

        return redirect()->to('/pengguna/dashboard');
    }

    public function dashboard()
    {
        $nip = session()->get('nip_pengguna');
        if (!$nip) {
            return redirect()->to('/pengguna/cek')->with('error', 'Silakan masukkan NIP Anda.');
        }

        $model = new PegawaiModel();
        $pegawai = $model->where('nip', $nip)->first();

        if (!$pegawai) {
            return redirect()->to('/pengguna/cek')->with('error', 'Data tidak ditemukan.');
        }

        return view('pengguna/dashboard', ['pegawai' => $pegawai]);
>>>>>>> 1dae537324ce403d4bb1015628acd988641ee27a
    }

    public function exportPdf($id)
    {
<<<<<<< HEAD
        if (!session()->get('logged_in') || session()->get('role') !== 'pengguna') {
            return redirect()->to('/login/pengguna')->with('error', 'Silakan login terlebih dahulu.');
        }

        $nip = session()->get('nip');
        $model = new LaporanModel();
        $laporan = $model->find($id);

        if (!$laporan || $laporan['nip'] !== $nip) {
            return redirect()->to('/pengguna/dashboard')->with('error', 'Akses tidak diizinkan.');
        }

        $html = view('pengguna/pajak_pdf', ['laporan' => $laporan]);
        helper('pdf');
        generatePdf($html, 'Laporan_Pajak_' . $laporan['bulan'] . '_' . $laporan['tahun']);
=======
        $nipSession = session()->get('nip_pengguna');
        if (!$nipSession) {
            return redirect()->to('/pengguna/cek')->with('error', 'Akses ditolak.');
        }

        $model = new PegawaiModel();
        $pegawai = $model->find($id);

        // Cegah akses ke data orang lain
        if (!$pegawai || $pegawai['nip'] !== $nipSession) {
            return redirect()->to('/pengguna/dashboard')->with('error', 'Anda tidak diizinkan mengakses data ini.');
        }

        $html = view('pengguna/pajak_pdf', ['pegawai' => $pegawai]);

        // Panggil helper PDF
        helper('pdf');

        if (!function_exists('generatePdf')) {
            return redirect()->to('/pengguna/dashboard')->with('error', 'Helper PDF tidak ditemukan.');
        }

        generatePdf($html, 'Pajak_' . $pegawai['nama']);
    }

    public function logout()
    {
        session()->remove('nip_pengguna');
        return redirect()->to('/pengguna/cek')->with('success', 'Anda telah logout.');
>>>>>>> 1dae537324ce403d4bb1015628acd988641ee27a
    }
}
