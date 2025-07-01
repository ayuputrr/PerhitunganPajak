<!DOCTYPE html>
<html>
<head>
  <title>Laporan Pajak Tahunan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Laporan Pajak Tahunan</h4>
    </div>
    <div class="card-body">

      <p><strong>Nama:</strong> <?= $pegawai['nama'] ?></p>
      <p><strong>NIP:</strong> <?= $pegawai['nip'] ?></p>

      <hr>
      <p><strong>Total Gaji Bruto Bulanan:</strong> Rp <?= number_format($pegawai['bruto_bulanan'], 0, ',', '.') ?></p>
      <p><strong>PPH Bruto Bulanan:</strong> Rp <?= number_format($pegawai['pph_bruto_bulanan'], 0, ',', '.') ?></p>
      <p><strong>PPH Bruto + TPP Bulanan:</strong> Rp <?= number_format($pegawai['pph_bruto_tpp_bulanan'], 0, ',', '.') ?></p>
      <p><strong>Total Bruto Tahunan:</strong> Rp <?= number_format($total_bruto, 0, ',', '.') ?></p>
      <p><strong>Iuran Pensiun Tahunan:</strong> Rp <?= number_format($iuran_tahunan, 0, ',', '.') ?></p>
      <p><strong>Biaya Jabatan:</strong> Rp <?= number_format($biaya_jabatan, 0, ',', '.') ?></p>
      <p><strong>Total Pengurangan:</strong> Rp <?= number_format($total_pengurangan, 0, ',', '.') ?></p>
      <p><strong>Penghasilan Netto Tahunan:</strong> Rp <?= number_format($netto, 0, ',', '.') ?></p>
      <p><strong>PTKP:</strong> Rp <?= number_format($ptkp, 0, ',', '.') ?></p>
      <p><strong>Penghasilan Kena Pajak (PKP):</strong> Rp <?= number_format($pkp, 0, ',', '.') ?></p>

      <hr>

      <h5 class="text-danger"><strong>PPH 21 Setahun: Rp <?= number_format($pph_setahun, 0, ',', '.') ?></strong></h5>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
