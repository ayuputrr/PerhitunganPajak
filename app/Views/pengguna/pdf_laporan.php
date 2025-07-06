<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pajak Pegawai</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 15px; margin: 0; padding: 0; }
        .kop { text-align: center; border-bottom: 2.5px solid #222; margin-bottom: 20px; padding-bottom: 10px; }
        .kop .instansi { font-size: 22px; font-weight: bold; color: #222; }
        .kop .alamat { font-size: 16px; color: #444; }
        .judul { text-align: center; margin-bottom: 16px; margin-top: 14px; font-size: 19px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
        .info { margin-bottom: 12px; font-size: 16px; }
        .info td { padding: 3px 12px 3px 0; }
        table.data { width: 100%; border-collapse: collapse; margin-bottom: 22px; font-size: 16px; }
        table.data th, table.data td { border: 1.5px solid #222; padding: 11px 16px; text-align: left; }
        table.data th { background: #e3f0fa; color: #222; }
        .ttd { width: 100%; margin-top: 38px; }
        .ttd td { vertical-align: bottom; text-align: center; height: 100px; font-size: 16px; }
        .struk { margin: 0 auto; width: 650px; background: #fff; border: 2.5px dashed #222; padding: 28px 28px 18px 28px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); }
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
            Bulan <?= $bulan ?> Tahun <?= $tahun ?>
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
        </table>

        <table class="data">
            <tr><th>Uraian</th><th>Nominal</th></tr>
            <tr><td>Status</td><td><?= esc($laporan['status']) ?></td></tr>
            <tr><td>Gaji Pokok</td><td>Rp <?= number_format($laporan['gaji_pokok'], 0, ',', '.') ?></td></tr>
            <tr><td>Tunjangan Suami/Istri</td><td>Rp <?= number_format($laporan['tunj_suami_istri'], 0, ',', '.') ?></td></tr>
            <tr><td>Tunjangan Anak</td><td>Rp <?= number_format($laporan['tunj_anak'], 0, ',', '.') ?></td></tr>
            <tr><td>Tunjangan Jabatan</td><td>Rp <?= number_format($laporan['tunj_jabatan'], 0, ',', '.') ?></td></tr>
            <tr><td>Tunjangan Beras</td><td>Rp <?= number_format($laporan['tunj_beras'], 0, ',', '.') ?></td></tr>
            <tr><td>Tunjangan Lain</td><td>Rp <?= number_format($laporan['tunj_lain'], 0, ',', '.') ?></td></tr>
            <tr><td>Bruto Bulanan</td><td>Rp <?= number_format($laporan['bruto_bulanan'], 0, ',', '.') ?></td></tr>
            <tr><td>PPH Bruto Bulanan</td><td>Rp <?= number_format($laporan['pph_bruto_bulanan'], 0, ',', '.') ?></td></tr>
            <tr><td>PPH Bruto TPP Bulanan</td><td>Rp <?= number_format($laporan['pph_bruto_tpp_bulanan'], 0, ',', '.') ?></td></tr>
            <tr><td>Tanggal Arsip</td><td><?= date('d-m-Y H:i', strtotime($laporan['created_at'])) ?></td></tr>
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
