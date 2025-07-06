<?php

namespace App\Controllers;

use App\Models\ArsipTahunanModel;
use App\Models\LaporanModel;
use App\Models\PegawaiModel;
use App\Models\NotifikasiModel;
use App\Models\PenggunaModel;
use CodeIgniter\Controller;

class Pengguna extends Controller
{
    protected $penggunaModel;

    public function __construct()
    {
        $this->penggunaModel = new PenggunaModel();
    }

   public function dashboard()
{
    if (!session()->get('logged_in') || session()->get('role') !== 'pengguna') {
        return redirect()->to('/login/pengguna')->with('error', 'Silakan login terlebih dahulu.');
    }

    $nip = session()->get('nip');
    $pegawaiModel = new PegawaiModel();
    $notifikasiModel = new NotifikasiModel();
    $arsipTahunanModel = new ArsipTahunanModel();

    // Ambil daftar tahun & bulan dari tabel PEGAWAI
    $tahunList = $pegawaiModel
        ->select('tahun')
        ->where('nip', $nip)
        ->where('tahun IS NOT NULL', null, false)
        ->groupBy('tahun')
        ->orderBy('tahun', 'DESC')
        ->findAll();

    $bulanList = $pegawaiModel
        ->select('bulan')
        ->where('nip', $nip)
        ->where('bulan IS NOT NULL', null, false)
        ->groupBy('bulan')
        ->orderBy('bulan', 'ASC')
        ->findAll();

    // Ambil filter dari URL
    $tahunFilter = $this->request->getGet('tahun');
    $bulanFilter = $this->request->getGet('bulan');

    // Ambil data pegawai berdasarkan filter
    if ($tahunFilter && $bulanFilter) {
        $laporan = $pegawaiModel->where('nip', $nip)
                                ->where('tahun', $tahunFilter)
                                ->where('bulan', $bulanFilter)
                                ->first();
    } else {
        $laporan = $pegawaiModel->where('nip', $nip)
                                ->orderBy('tahun', 'DESC')
                                ->orderBy('bulan', 'DESC')
                                ->first();
        $tahunFilter = $laporan['tahun'] ?? date('Y');
        $bulanFilter = $laporan['bulan'] ?? date('n');
    }

    // Cek arsip tahunan tersedia
    $arsip_tahunan_tersedia = $arsipTahunanModel
        ->where('nip', $nip)
        ->where('tahun', date('Y'))
        ->countAllResults() > 0;

    // Notifikasi popup
    $notifikasiBaru = $notifikasiModel
        ->where('nip', $nip)
        ->where('dibaca', 0)
        ->where('sudah_popup', 0)
        ->orderBy('created_at', 'DESC')
        ->first();

    $showToast = false;
    $pesanToast = '';
    if ($notifikasiBaru) {
        $showToast = true;
        $pesanToast = $notifikasiBaru['pesan'];
        $notifikasiModel->update($notifikasiBaru['id'], ['sudah_popup' => 1]);
    }

    return view('pengguna/dashboard', [
        'laporan' => $laporan,
        'pengguna' => (new PenggunaModel())->where('nip', $nip)->first(),
        'tahunList' => $tahunList,
        'bulanList' => $bulanList,
        'tahunFilter' => $tahunFilter,
        'bulanFilter' => $bulanFilter,
        'showToast' => $showToast,
        'pesanToast' => $pesanToast,
        'arsip_tahunan_tersedia' => $arsip_tahunan_tersedia
    ]);
}


       public function arsipTahunan()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'pengguna') {
            return redirect()->to('/login/pengguna')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Tidak ada pembatasan bulan, bisa diakses kapan saja
        $nip = session()->get('nip');
        $arsipTahunanModel = new ArsipTahunanModel();
        $pegawaiModel = new PegawaiModel();

        $pegawai = $pegawaiModel->where('nip', $nip)->first();
        $arsip = $arsipTahunanModel->where('nip', $nip)->orderBy('tahun', 'DESC')->findAll();

        return view('pengguna/arsip_tahunan', [
            'arsip' => $arsip,
            'pegawai' => $pegawai
        ]);
    }

public function exportpdftahunan($tahun)
{
    if (!session()->get('logged_in') || session()->get('role') !== 'pengguna') {
        return redirect()->to('/login/pengguna')->with('error', 'Silakan login terlebih dahulu.');
    }

    $nip = session()->get('nip');
    $pegawaiModel = new PegawaiModel();
    $arsipTahunanModel = new ArsipTahunanModel();

    $pegawai = $pegawaiModel->where('nip', $nip)->first();
    if (!$pegawai) {
        return redirect()->back()->with('error', 'Data pegawai tidak ditemukan.');
    }

    // Siapkan data
    $dataArsip = [
        'nip' => $pegawai['nip'],
        'nama' => $pegawai['nama'],
        'status' => $pegawai['status'],
        'tahun' => $tahun,
        'iuran_tahunan' => $pegawai['iuran_tahunan'],
        'tpp' => $pegawai['tpp'],
        'thr_gaji' => $pegawai['thr_gaji'],
        'thr_tpp' => $pegawai['thr_tpp'],
        'gaji13' => $pegawai['gaji13'],
        'tpp13' => $pegawai['tpp13'],
        'bruto_tahunan' => $pegawai['bruto_tahunan'],
        'biaya_jabatan' => $pegawai['biaya_jabatan'],
        'total_pengurangan' => $pegawai['total_pengurangan'],
        'netto_tahunan' => $pegawai['netto_tahunan'],
        'ptkp' => $pegawai['ptkp'],
        'pkp' => $pegawai['pkp'],
        'pph_setahun' => $pegawai['pph_setahun'],
        'tarif' => $pegawai['tarif'],
        'bulan' => date('m'), // Optional, bisa null atau bulan sekarang
    ];

    // Simpan jika belum ada
    $cekArsip = $arsipTahunanModel->where('nip', $nip)->where('tahun', $tahun)->first();
    if (!$cekArsip) {
        $arsipTahunanModel->insert($dataArsip);
    }

    // Generate PDF
    $html = view('pengguna/pdf_laporan_tahunan', [
        'laporan' => $dataArsip,
        'tahun' => $tahun
    ]);

    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream('Laporan_Pajak_Tahunan_'.$tahun.'.pdf', ['Attachment' => 1]);
    exit;
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

    public function profil()
    {
        $nip = session()->get('nip');
        $pengguna = $this->penggunaModel->where('nip', $nip)->first();

        if (!$pengguna) {
            return redirect()->to('/pengguna/dashboard')->with('error', 'Data pengguna tidak ditemukan.');
        }

        return view('pengguna/profil', ['pengguna' => $pengguna]);
    }

    public function editProfil()
    {
        $nip = session()->get('nip');
        $pengguna = $this->penggunaModel->where('nip', $nip)->first();

        if (!$pengguna) {
            return redirect()->to('/pengguna/dashboard')->with('error', 'Data pengguna tidak ditemukan.');
        }

        return view('pengguna/edit_profil', ['pengguna' => $pengguna]);
    }

    public function updateProfil()
    {
        $nip = session()->get('nip');
        if (!$nip) {
            return redirect()->to('/login/pengguna')->with('error', 'Session habis, silakan login ulang.');
        }

        $validation = \Config\Services::validation();
        $rules = [
            'nama'    => 'required',
            'jabatan' => 'permit_empty',
            'alamat'  => 'permit_empty',
            'telepon' => 'permit_empty',
            'status'  => 'required',
            'foto'    => [
                'label' => 'Foto Profil',
                'rules' => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,2048]'
            ],
            'password_lama'        => 'permit_empty',
            'password_baru'        => 'permit_empty|min_length[6]',
            'konfirmasi_password'  => 'permit_empty|matches[password_baru]'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $dataUpdate = [
            'nama'    => $this->request->getPost('nama'),
            'jabatan' => $this->request->getPost('jabatan'),
            'alamat'  => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
            'status'  => $this->request->getPost('status')
        ];

        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = uniqid() . '.' . $foto->getExtension();
            $foto->move('uploads/foto', $newName);
            $dataUpdate['foto'] = $newName;

            $pengguna = $this->penggunaModel->where('nip', $nip)->first();
            if (!empty($pengguna['foto']) && file_exists('uploads/foto/' . $pengguna['foto'])) {
                unlink('uploads/foto/' . $pengguna['foto']);
            }
        }

        $passwordLama = $this->request->getPost('password_lama');
        $passwordBaru = $this->request->getPost('password_baru');
        $konfirmasi   = $this->request->getPost('konfirmasi_password');
        if ($passwordLama || $passwordBaru || $konfirmasi) {
            $pengguna = $this->penggunaModel->where('nip', $nip)->first();
            if (!password_verify($passwordLama, $pengguna['password'])) {
                return redirect()->back()->withInput()->with('error', 'Password lama salah');
            }
            if (empty($passwordBaru) || strlen($passwordBaru) < 6) {
                return redirect()->back()->withInput()->with('error', 'Password baru minimal 6 karakter');
            }
            if ($passwordBaru !== $konfirmasi) {
                return redirect()->back()->withInput()->with('error', 'Konfirmasi password tidak cocok');
            }
            $dataUpdate['password'] = password_hash($passwordBaru, PASSWORD_DEFAULT);
        }

        $this->penggunaModel->where('nip', $nip)->set($dataUpdate)->update();
        return redirect()->to('/pengguna/profil')->with('success', 'Profil berhasil diperbarui');
    }

    public function editPassword()
    {
        return view('pengguna/edit_password');
    }

    public function updatePassword()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'password_lama' => 'required',
            'password_baru' => 'required|min_length[6]',
            'konfirmasi_password' => 'required|matches[password_baru]'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $user = $this->penggunaModel->find(session()->get('user_id'));
        if (!password_verify($this->request->getPost('password_lama'), $user['password'])) {
            return redirect()->back()->with('error', 'Password lama salah');
        }
        $this->penggunaModel->update(session()->get('user_id'), [
            'password' => password_hash($this->request->getPost('password_baru'), PASSWORD_DEFAULT)
        ]);
        return redirect()->to('/pengguna/edit_password')->with('success', 'Password berhasil diubah');
    }

    public function export_pdf()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login/pengguna');
        }

        $nip = session()->get('nip');
        $bulan = date('m');
        $tahun = date('Y');

        $pegawaiModel = new PegawaiModel();
        $laporanModel = new LaporanModel();

        $pegawai = $pegawaiModel->where('nip', $nip)->first();
        if (!$pegawai) {
            return redirect()->back()->with('error', 'Data pegawai tidak ditemukan.');
        }

        $laporan = $laporanModel->where([
            'nip' => $nip,
            'bulan' => $bulan,
            'tahun' => $tahun
        ])->first();

        $laporanData = [
            'nip' => $nip,
            'nama' => $pegawai['nama'],
            'status' => $pegawai['status'],
            'gaji_pokok' => $pegawai['gaji_pokok'],
            'tunj_suami_istri' => $pegawai['tunj_suami_istri'],
            'tunj_anak' => $pegawai['tunj_anak'],
            'tunj_jabatan' => $pegawai['tunj_jabatan'],
            'tunj_beras' => $pegawai['tunj_beras'],
            'tunj_lain' => $pegawai['tunj_lain'],
            'bruto_bulanan' => $pegawai['bruto_bulanan'],
            'pph_bruto_bulanan' => $pegawai['pph_bruto_bulanan'],
            'pph_bruto_tpp_bulanan' => $pegawai['pph_bruto_tpp_bulanan'],
            'bulan' => $bulan,
            'tahun' => $tahun,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        if (!$laporan) {
            $laporanModel->insert($laporanData);
        } else {
            $laporanModel->update($laporan['id'], $laporanData);
        }

        $laporan = $laporanModel->where([
            'nip' => $nip,
            'bulan' => $bulan,
            'tahun' => $tahun
        ])->first();

        $data = [
            'pegawai' => $pegawai,
            'laporan' => $laporan,
            'bulan' => $bulan,
            'tahun' => $tahun
        ];

        $html = view('pengguna/pdf_laporan', $data);

        helper('pdf');
        generatePdf($html, 'Laporan_Pajak_' . $bulan . '_' . $tahun);
    }

    public function notifikasi()
    {
        $nip = session()->get('nip');
        $model = new NotifikasiModel();
        $notifikasi = $model->where('nip', $nip)->orderBy('created_at', 'DESC')->findAll();

        return view('pengguna/notifikasi', ['notifikasi' => $notifikasi]);
    }

    public function tandaiNotifikasiDibaca()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'pengguna') {
            return $this->response->setJSON(['status' => false, 'msg' => 'Unauthorized']);
        }
        $nip = session()->get('nip');
        $notifikasiModel = new NotifikasiModel();
        $notifikasiModel->where('nip', $nip)->where('dibaca', 0)->set(['dibaca' => 1])->update();
        return $this->response->setJSON(['status' => true]);
    }

    public function hapusNotifikasi($id)
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'pengguna') {
            return $this->response->setJSON(['status' => false, 'msg' => 'Unauthorized']);
        }
        $nip = session()->get('nip');
        $notifikasiModel = new NotifikasiModel();
        $notif = $notifikasiModel->find($id);

        if ($notif && $notif['nip'] == $nip) {
            $notifikasiModel->delete($id);
            return $this->response->setJSON(['status' => true]);
        } else {
            return $this->response->setJSON(['status' => false, 'msg' => 'Notifikasi tidak ditemukan.']);
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login/pengguna')->with('success', 'Anda telah berhasil logout.');
    }
}
