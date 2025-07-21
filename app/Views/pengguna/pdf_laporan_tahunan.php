<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pajak Pegawai Tahunan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 15px; margin: 0; padding: 0; }
        .kop { text-align: center; border-bottom: 2.5px solid #222; margin-bottom: 20px; padding-bottom: 10px; }
        .kop .instansi { font-size: 22px; font-weight: bold; color: #222; }
        .kop .alamat { font-size: 16px; color: #444; }
        .judul { text-align: center; margin-bottom: 16px; margin-top: 14px; font-size: 19px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
        .info { margin-bottom: 12px; font-size: 16px; }
        .info td { padding: 3px 12px 3px 0; }
        table.data { width: 100%; border-collapse: collapse; margin-bottom: 22px; font-size: 16px; }
        table.data th, table.data td { border: 1.5px solid #222; padding: 10px 14px; text-align: left; }
        table.data th { background: #e3f0fa; color: #222; }
        .ttd { width: 100%; margin-top: 38px; }
        .ttd td { vertical-align: bottom; text-align: center; height: 100px; font-size: 16px; }
        .struk { margin: 0 auto; width: 700px; background: #fff; border: 2.5px dashed #222; padding: 28px 28px 18px 28px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); }
    </style>
</head>
<body>
    <?php
        $bulanNama = [
            '01' => 'JANUARI', '02' => 'FEBRUARI', '03' => 'MARET',
            '04' => 'APRIL', '05' => 'MEI', '06' => 'JUNI',
            '07' => 'JULI', '08' => 'AGUSTUS', '09' => 'SEPTEMBER',
            '10' => 'OKTOBER', '11' => 'NOVEMBER', '12' => 'DESEMBER'
        ];
        $tanggalCetak = date('d');
        $bulanCetak = $bulanNama[date('m')];
        $tahunCetak = date('Y');
    ?>

    <div class="struk">
        <div class="kop">
            <div class="instansi">PEMERINTAH KABUPATEN PRINGSEWU</div>
            <div class="instansi" style="font-size:18px;">DINAS KOMUNIKASI DAN INFORMATIKA</div>
            <div class="alamat">
                Jl. Raya Pemda Pringsewu, Jogyakarta, Kec. Gading Rejo,<br>
                Kabupaten Pringsewu, Lampung 35373
            </div>
        </div>

        <div class="judul">
            LAPORAN PAJAK PEGAWAI<br>
            <span style="font-size:17px;font-weight:normal;text-transform:none;">Tahun <?= $tahun ?></span>
        </div>

        <table class="info">
            <tr>
                <td><b>Nama</b></td>
                <td>: <?= esc($laporan['nama']) ?></td>
            </tr>
            <tr>
                <td><b>NIP</b></td>
                <td>: <?= esc($laporan['nip']) ?></td>
            </tr>
            <tr>
                <td><b>Status</b></td>
                <td>: <?= esc($laporan['status']) ?></td>
            </tr>
        </table>

        <table class="data">
            <tr><th>Uraian</th><th>Nominal</th></tr>
            <tr><td>Iuran Tahunan</td><td>Rp <?= number_format($laporan['iuran_tahunan'], 0, ',', '.') ?></td></tr>
            <tr><td>TPP</td><td>Rp <?= number_format($laporan['tpp'], 0, ',', '.') ?></td></tr>
            <tr><td>THR Gaji</td><td>Rp <?= number_format($laporan['thr_gaji'], 0, ',', '.') ?></td></tr>
            <tr><td>THR TPP</td><td>Rp <?= number_format($laporan['thr_tpp'], 0, ',', '.') ?></td></tr>
            <tr><td>Gaji 13</td><td>Rp <?= number_format($laporan['gaji13'], 0, ',', '.') ?></td></tr>
            <tr><td>TPP 13</td><td>Rp <?= number_format($laporan['tpp13'], 0, ',', '.') ?></td></tr>
            <tr><td>Bruto Tahunan</td><td>Rp <?= number_format($laporan['bruto_tahunan'], 0, ',', '.') ?></td></tr>
            <tr><td>Biaya Jabatan</td><td>Rp <?= number_format($laporan['biaya_jabatan'], 0, ',', '.') ?></td></tr>
            <tr><td>Total Pengurangan</td><td>Rp <?= number_format($laporan['total_pengurangan'], 0, ',', '.') ?></td></tr>
            <tr><td>Netto Tahunan</td><td>Rp <?= number_format($laporan['netto_tahunan'], 0, ',', '.') ?></td></tr>
            <tr><td>PTKP</td><td>Rp <?= number_format($laporan['ptkp'], 0, ',', '.') ?></td></tr>
            <tr><td>PKP</td><td>Rp <?= number_format($laporan['pkp'], 0, ',', '.') ?></td></tr>
            <tr><td>PPH Setahun</td><td>Rp <?= number_format($laporan['pph_setahun'], 0, ',', '.') ?></td></tr>
            <tr><td>Tarif</td><td><?= esc($laporan['tarif']) ?>%</td></tr>
        </table>

        <table class="ttd">
            <tr>
                <td width="50%">
                    Mengetahui,<br>
                    Kepala Dinas<br><br><br>
                    <u style="font-weight:bold;">.......................................</u><br>
                    NIP: ....................................
                </td>
                <td width="50%" style="text-align: right;">
                    Pringsewu, <?= $tanggalCetak . ' ' . $bulanCetak . ' ' . $tahunCetak ?><br>
                    Bendahara<br><br><br>
                    <u style="font-weight:bold;">.......................................</u><br>
                    NIP: ....................................
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
