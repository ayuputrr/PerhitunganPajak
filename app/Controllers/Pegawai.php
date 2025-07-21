<?php namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use App\Models\PegawaiModel;
use App\Models\NotifikasiModel;
use Config\Services;

class Pegawai extends BaseController
{
    public function dashboard()
    {
        $pegawaiModel = new PegawaiModel();
        $notifikasiModel = new NotifikasiModel();

        $search = $this->request->getGet('search');
        $pegawai = $pegawaiModel->findAll();

        if ($search) {
            $pegawai = array_filter($pegawai, function ($row) use ($search) {
                return stripos($row['nama'], $search) !== false;
            });
        }

        $bulan = date('n');
        $tahun = date('Y');
        $notifikasi_terkirim = $notifikasiModel
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('pegawai/dashboard', [
            'pegawai' => $pegawai,
            'search' => $search,
            'notifikasi_terkirim' => $notifikasi_terkirim
        ]);
    }
    public function index()
    {
        $model = new PegawaiModel();
        $search = $this->request->getGet('search');

        if ($search) {
            $pegawai = $model->like('nama', $search)->findAll();
        } else {
            $pegawai = $model->findAll();
        }

        return view('pegawai/index', [
            'pegawai' => $pegawai,
            'search' => $search
        ]);
    }

    public function create()
    {
        return view('pegawai/form');
    }

    public function edit($id)
    {
        $model = new PegawaiModel();
        $pegawai = $model->find($id);

        if (!$pegawai) {
            return redirect()->to('/pegawai');
        }

        return view('pegawai/edit', ['pegawai' => $pegawai]);
    }
public function detail($id)
{
    $model = new PegawaiModel();
    $pegawai = $model->find($id);

    if (!$pegawai) {
        return redirect()->to('/pegawai')->with('error', 'Data pegawai tidak ditemukan.');
    }

    return view('pegawai/detail', ['pegawai' => $pegawai]);
}

   public function update($id)
{
    $model = new PegawaiModel();
    $dataBaru = $this->request->getPost();
    $dataLama = $model->find($id);

    $dataUpdate = array_merge($dataLama, $dataBaru);

    $dataUpdate['bruto_bulanan'] = $dataUpdate['gaji_pokok'] + $dataUpdate['tunj_suami_istri'] + $dataUpdate['tunj_anak'] +
                                   $dataUpdate['tunj_jabatan'] + $dataUpdate['tunj_beras'] + $dataUpdate['tunj_lain'];

    // Ambil bulan & tahun dari form, bukan dari sistem
    $dataUpdate['bulan'] = $this->request->getPost('bulan');
    $dataUpdate['tahun'] = $this->request->getPost('tahun');

    $model->update($id, $dataUpdate);

    // Otomatis hitung dan update data tahunan
    $this->hitungTahunan($id);

    return redirect()->to('/pegawai');
}

 public function store()
{
    $model = new PegawaiModel();
    $data = $this->request->getPost();

    $bruto = $data['gaji_pokok'] + $data['tunj_suami_istri'] + $data['tunj_anak'] +
             $data['tunj_jabatan'] + $data['tunj_beras'] + $data['tunj_lain'];
    $data['bruto_bulanan'] = $bruto;

    // Ambil bulan & tahun dari form, bukan dari sistem
    $data['bulan'] = $this->request->getPost('bulan');
    $data['tahun'] = $this->request->getPost('tahun');

    $model->insert($data);
    $id = $model->getInsertID();

    // Otomatis hitung dan update data tahunan
    $this->hitungTahunan($id);

    return redirect()->to('/pegawai/dashboard')->with('success', 'Pegawai berhasil ditambahkan dan data tahunan terupdate.');
}
public function kirimNotifikasi()
{
    $pegawaiModel   = new PegawaiModel();
    $notifikasiModel = new NotifikasiModel();
    $penggunaModel  = new \App\Models\PenggunaModel();

    $nip   = $this->request->getPost('nip');
    $bulan = $this->request->getPost('bulan');
    $tahun = $this->request->getPost('tahun');

    if (!$nip || !$bulan || !$tahun) {
        return redirect()->back()->with('error', 'Data NIP, bulan, atau tahun tidak lengkap.');
    }

    $pegawai = $pegawaiModel->where('nip', $nip)
                            ->where('bulan', $bulan)
                            ->where('tahun', $tahun)
                            ->first();
    if (!$pegawai) {
        return redirect()->back()->with('error', 'Data pegawai tidak ditemukan untuk bulan & tahun tersebut.');
    }

    $sudahAda = $notifikasiModel->where('nip', $nip)
                                ->where('bulan', $bulan)
                                ->where('tahun', $tahun)
                                ->first();
    if ($sudahAda) {
        return redirect()->back()->with('error', 'Notifikasi sudah pernah dikirim untuk bulan ini.');
    }

    $namaBulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];
    $namaBulanStr = $namaBulan[(int)$bulan] ?? 'Bulan Tidak Valid';

    // Pesan panjang resmi dan formal, sudah siap pakai HTML!
    $pesanPanjang = '
        <p>Yth. <strong>' . esc($pegawai['nama']) . '</strong> (NIP: ' . esc($pegawai['nip']) . '),</p>
        <p>
            Dengan hormat,<br><br>
            Kami informasikan bahwa laporan pajak penghasilan Anda untuk periode <b>' . $namaBulanStr . ' ' . $tahun . '</b> telah berhasil diterbitkan oleh sistem aplikasi Pajak Pringsewu.<br><br>
            Berikut beberapa hal penting terkait laporan ini:
        </p>
        <ol>
            <li>
                Silakan login ke dashboard aplikasi menggunakan akun Anda untuk mengecek rincian laporan pajak bulan ini.
            </li>
            <li>
                Pastikan seluruh data penghasilan, tunjangan, dan potongan pada laporan sudah sesuai dengan kondisi yang sebenarnya.
            </li>
            <li>
                Jika Anda menemukan ketidaksesuaian data atau membutuhkan klarifikasi lebih lanjut,
                harap segera melakukan konfirmasi kepada admin melalui fitur bantuan pada aplikasi atau langsung menghubungi admin Dinas Komunikasi dan Informatika Pringsewu.
            </li>
            <li>
                Laporan pajak bulanan ini menjadi bagian penting dari rekapitulasi tahunan, sehingga akurasi data sangat diperlukan.
                Mohon kerjasama Anda untuk selalu memeriksa dan melakukan update data pribadi secara berkala.
            </li>
            <li>
                Simpan dan arsipkan setiap notifikasi serta dokumen pendukung sebagai kelengkapan administrasi pribadi.
            </li>
        </ol>
        <p>
            Kami berkomitmen untuk terus meningkatkan pelayanan administrasi kepegawaian melalui sistem yang transparan, akuntabel, dan mudah diakses.<br>
            Jika ada ide, kritik, atau saran terkait pengelolaan data pajak pegawai, silakan sampaikan melalui kanal resmi kami.
        </p>
        <p>
            Atas perhatian, kerjasama, dan dedikasi Bapak/Ibu sekalian, kami sampaikan terima kasih yang sebesar-besarnya.<br><br>
            Salam hormat,<br>
            <b>Dinas Komunikasi dan Informatika Pringsewu</b><br>
            <i>dkominfopringsewu@gmail.com</i>
        </p>
    ';

    // Simpan log notifikasi ke database (bisa simpan HTML atau text saja)
    $notifikasiModel->save([
        'nip'    => $pegawai['nip'],
        'nama'   => $pegawai['nama'],
        'pesan'  => strip_tags($pesanPanjang), // di DB hanya text jika mau rapi
        'dibaca' => 0,
        'bulan'  => $bulan,
        'tahun'  => $tahun
    ]);

    // Kirim email notifikasi
    $pengguna = $penggunaModel->where('nip', $nip)->first();
    if ($pengguna && !empty($pengguna['email'])) {
        $email = \Config\Services::email();
        $email->setTo($pengguna['email']);
        $email->setSubject('Notifikasi Laporan Pajak Bulan ' . $namaBulanStr . ' ' . $tahun);
        $email->setMessage($pesanPanjang); // Isi email HTML yang panjang

        if (!$email->send()) {
            log_message('error', 'Gagal mengirim email ke ' . $pengguna['email'] . ': ' . $email->printDebugger(['headers']));
        }
    }

    return redirect()->to('/pegawai/dashboard')->with('success', 'Notifikasi berhasil dikirim ke pengguna.');
}

    public function exportExcelAll()
    {
        $model = new PegawaiModel();
        $pegawaiList = $model->findAll();

        if (!$pegawaiList) {
            return redirect()->to('/pegawai');
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $firstPegawai = $pegawaiList[0];
        $col = 'A';
        foreach (array_keys($firstPegawai) as $key) {
            $sheet->setCellValue($col . '1', ucfirst(str_replace('_', ' ', $key)));
            $col++;
        }

        $rowNum = 2;
        foreach ($pegawaiList as $pegawai) {
            $col = 'A';
            foreach ($pegawai as $value) {
                $sheet->setCellValue($col . $rowNum, $value);
                $col++;
            }
            $rowNum++;
        }

        $filename = 'semua_pegawai.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function export($id)
    {
        $model = new PegawaiModel();
        $pegawai = $model->find($id);

        if (!$pegawai) {
            return redirect()->to('/pegawai');
        }

        return view('pegawai/laporan', ['data' => $pegawai]);
    }

    public function hitung($id)
    {
        $model = new PegawaiModel();
        $pegawai = $model->find($id);

        if (!$pegawai) {
            return redirect()->to('/pegawai');
        }

        $bruto = $pegawai['bruto_bulanan'];
        $tpp = $pegawai['tpp'];
        $status = $pegawai['status'];
        $bruto_tpp = $bruto + $tpp;

        $tarif_bruto = 0;
        if (in_array($status, ['TK/0', 'TK/1', 'K/0', 'HB/0', 'HB/1'])) {
            $tarif_bruto = $this->getTER($bruto, 'A');
        } elseif (in_array($status, ['TK/2', 'TK/3', 'K/1', 'K/2', 'HB/2', 'HB/3'])) {
            $tarif_bruto = $this->getTER($bruto, 'B');
        } else {
            $tarif_bruto = $this->getTER($bruto, 'C');
        }

        $tarif_bruto_tpp = 0;
        if (in_array($status, ['TK/0', 'TK/1', 'K/0', 'HB/0', 'HB/1'])) {
            $tarif_bruto_tpp = $this->getTER($bruto_tpp, 'A');
        } elseif (in_array($status, ['TK/2', 'TK/3', 'K/1', 'K/2', 'HB/2', 'HB/3'])) {
            $tarif_bruto_tpp = $this->getTER($bruto_tpp, 'B');
        } else {
            $tarif_bruto_tpp = $this->getTER($bruto_tpp, 'C');
        }

        $pph_bruto = ($tarif_bruto / 100) * $bruto;
        $pph_bruto_tpp = ($tarif_bruto_tpp / 100) * ($bruto + $tpp);

        $model->update($id, [
            'pph_bruto_bulanan' => round($pph_bruto),
            'pph_bruto_tpp_bulanan' => round($pph_bruto_tpp),
        ]);

        // Otomatis hitung dan update data tahunan juga
        $this->hitungTahunan($id);

        return redirect()->to('/pegawai');
    }

    /**
     * Fungsi khusus untuk menghitung dan mengupdate data tahunan pegawai.
     * Tidak return view, hanya update data.
     */
   
   
   
   
     public function hitungTahunan($id)
    {
        $model = new PegawaiModel();
        $pegawai = $model->find($id);

        if (!$pegawai) {
            return false;
        }

        $brutoBulanan = $pegawai['bruto_bulanan'];
        $tppBulanan = $pegawai['tpp'];
        $iuran = $pegawai['iuran_pensiun'];

        $brutoTahunan = $brutoBulanan * 12;
        $tppTahunan = $tppBulanan * 12;

        $totalBrutoTahunan = $brutoTahunan + $tppTahunan + $pegawai['thr_gaji'] + $pegawai['thr_tpp'] + $pegawai['gaji13'] + $pegawai['tpp13'];
        $iuranTahunan = $iuran * 12;

        $biayaJabatan = 0.05 * $totalBrutoTahunan;
        if ($biayaJabatan > 6000000) {
            $biayaJabatan = 6000000;
        }

        $totalPengurangan = $biayaJabatan + $iuranTahunan;
        $netto = $totalBrutoTahunan - $totalPengurangan;
        $ptkp = $this->getPTKP($pegawai['status']);
        $pkp = $netto - $ptkp;
        if ($pkp < 0) $pkp = 0;

        $pphSetahun = $this->hitungProgresif($pkp);

        $model->update($id, [
            'bruto_tahunan' => $brutoTahunan,
            'iuran_tahunan' => $iuranTahunan,
            'biaya_jabatan' => $biayaJabatan,
            'total_pengurangan' => $totalPengurangan,
            'netto_tahunan' => $netto,
            'ptkp' => $ptkp,
            'pkp' => $pkp,
            'pph_setahun' => $pphSetahun,
            'tarif' => $this->getTER($pkp, 'A')
        ]);
        return true;
    }

    private function getTER($bruto, $tipe = 'A')
    {
        $terArray = [];
        switch ($tipe) {
            case 'A':
                $terArray = [
                    [0, 5400000, 0], [5400001, 5650000, 0.25], [5650001, 5950000, 0.5],
                    [5950001, 6300000, 0.75], [6300001, 6750000, 1], [6750001, 7500000, 1.25],
                    [7500001, 8550000, 1.5], [8550001, 9650000, 1.75], [9650001, 10050000, 2],
                    [10050001, 10350000, 2.25], [10350001, 10700000, 2.5], [10700001, 11050000, 3],
                    [11050001, 11600000, 3.5], [11600001, 12500000, 4], [12500001, 13750000, 5],
                    [13750001, 15100000, 6], [15100001, 16950000, 7], [16950001, 19750000, 8],
                    [19750001, 24150000, 9], [24150001, 26450000, 10], [26450001, 28000000, 11],
                    [28000001, 30050000, 12], [30050001, 32400000, 13], [32400001, 35400000, 14],
                    [35400001, 39100000, 15], [39100001, 43850000, 16], [43850001, 47800000, 17],
                    [47800001, 51400000, 18], [51400001, 56300000, 19], [56300001, 62200000, 20],
                    [62200001, 68600000, 21], [68600001, 77500000, 22], [77500001, 89000000, 23],
                    [89000001, 103000000, 24], [103000001, 125000000, 25], [125000001, 157000000, 26],
                    [157000001, 206000000, 27], [206000001, 337000000, 28], [337000001, 454000000, 29],
                    [454000001, 550000000, 30], [550000001, 695000000, 31], [695000001, 910000000, 32],
                    [910000001, 1400000000, 33], [1400000001, PHP_INT_MAX, 34]
                ];
                break;
            case 'B':
                $terArray = [
                    [0, 6200000, 0], [6200001, 6500000, 0.25], [6500001, 6850000, 0.5],
                    [6850001, 7300000, 0.75], [7300001, 9200000, 1], [9200001, 10750000, 1.5],
                    [10750001, 11250000, 2], [11250001, 11600000, 2.5], [11600001, 12600000, 3],
                    [12600001, 13600000, 4], [13600001, 14950000, 5], [14950001, 16400000, 6],
                    [16400001, 18450000, 7], [18450001, 21850000, 8], [21850001, 26000000, 9],
                    [26000001, 27700000, 10], [27700001, 29350000, 11], [29350001, 31450000, 12],
                    [31450001, 33950000, 13], [33950001, 37100000, 14], [37100001, 41100000, 15],
                    [41100001, 45800000, 16], [45800001, 49500000, 17], [49500001, 53800000, 18],
                    [53800001, 58500000, 19], [58500001, 64000000, 20], [64000001, 71000000, 21],
                    [71000001, 80000000, 22], [80000001, 93000000, 23], [93000001, 109000000, 24],
                    [109000001, 129000000, 25], [129000001, 163000000, 26], [163000001, 211000000, 27],
                    [211000001, 374000000, 28], [374000001, 459000000, 29], [459000001, 555000000, 30],
                    [555000001, 704000000, 31], [704000001, 957000000, 32], [957000001, 1405000000, 33],
                    [1405000001, PHP_INT_MAX, 34]
                ];
                break;
            case 'C':
                $terArray = [
                    [0, 6600000, 0], [6600001, 6950000, 0.25], [6950001, 7350000, 0.5],
                    [7350001, 7800000, 0.75], [7800001, 8850000, 1], [8850001, 9800000, 1.25],
                    [9800001, 10950000, 1.5], [10950001, 11200000, 1.75], [11200001, 12050000, 2],
                    [12050001, 12950000, 3], [12950001, 14150000, 4], [14150001, 15550000, 5],
                    [15550001, 17050000, 6], [17050001, 19500000, 7], [19500001, 22700000, 8],
                    [22700001, 26600000, 9], [26600001, 28100000, 10], [28100001, 30100000, 11],
                    [30100001, 32600000, 12], [32600001, 35400000, 13], [35400001, 38900000, 14],
                    [38900001, 43000000, 15], [43000001, 47400000, 16], [47400001, 51200000, 17],
                    [51200001, 55800000, 18], [55800001, 60400000, 19], [60400001, 66700000, 20],
                    [66700001, 74500000, 21], [74500001, 83200000, 22], [83200001, 95600000, 23],
                    [95600001, 110000000, 24], [110000001, 134000000, 25], [134000001, 169000000, 26],
                    [169000001, 221000000, 27], [221000001, 390000000, 28], [390000001, 463000000, 29],
                    [463000001, 561000000, 30], [561000001, 709000000, 31], [709000001, 965000000, 32],
                    [965000001, 1419000000, 33], [1419000001, PHP_INT_MAX, 34]
                ];
                break;
        }
        foreach ($terArray as $range) {
            if ($bruto >= $range[0] && $bruto <= $range[1]) {
                return $range[2];
            }
        }
        return 0;
    }

    private function getPTKP($status)
    {
        switch ($status) {
            case 'TK/0': return 54000000;
            case 'TK/1': return 58500000;
            case 'TK/2': return 63000000;
            case 'TK/3': return 67500000;
            case 'K/0':  return 58500000;
            case 'K/1':  return 63000000;
            case 'K/2':  return 67500000;
            case 'K/3':  return 72000000;
            case 'HB/0': return 58500000;
            case 'HB/1': return 63000000;
            case 'HB/2': return 67500000;
            case 'HB/3': return 72000000;
            default: return 54000000;
        }
    }

    private function hitungProgresif($pkp)
    {
        $pajak = 0;
        if ($pkp <= 60000000) {
            $pajak = 0.05 * $pkp;
        } elseif ($pkp <= 250000000) {
            $pajak = (0.05 * 60000000) + (0.15 * ($pkp - 60000000));
        } elseif ($pkp <= 500000000) {
            $pajak = (0.05 * 60000000) + (0.15 * 190000000) + (0.25 * ($pkp - 250000000));
        } elseif ($pkp <= 5000000000) {
            $pajak = (0.05 * 60000000) + (0.15 * 190000000) + (0.25 * 250000000) + (0.30 * ($pkp - 500000000));
        } else {
            $pajak = (0.05 * 60000000) + (0.15 * 190000000) + (0.25 * 250000000) + (0.30 * 4500000000) + (0.35 * ($pkp - 5000000000));
        }
        return $pajak;
    }
}
