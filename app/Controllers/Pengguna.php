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
    }

    public function exportPdf($id)
    {
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
    }
}
