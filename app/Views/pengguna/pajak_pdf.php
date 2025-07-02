<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
<<<<<<< HEAD
  <title>Laporan Pajak</title>
=======
  <title>Laporan Pajak - <?= $pegawai['nama'] ?></title>
>>>>>>> 1dae537324ce403d4bb1015628acd988641ee27a
  <style>
    body { font-family: sans-serif; font-size: 12px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    h2 { text-align: center; }
  </style>
</head>
<body>
<<<<<<< HEAD
  <h2>Laporan Pajak Bulan <?= $laporan['bulan'] ?>/<?= $laporan['tahun'] ?></h2>
  <table>
    <tr><th>NIP</th><td><?= $laporan['nip'] ?></td></tr>
    <tr><th>Bruto</th><td>Rp <?= number_format($laporan['bruto']) ?></td></tr>
    <tr><th>PPH</th><td>Rp <?= number_format($laporan['pph']) ?></td></tr>
    <tr><th>Total Pajak</th><td>Rp <?= number_format($laporan['total']) ?></td></tr>
  </table>

  <?php if (!empty($laporan['detail'])): ?>
    <h4>Rincian:</h4>
    <p><?= nl2br($laporan['detail']) ?></p>
  <?php endif ?>
=======
  <h2>Laporan Pajak Pegawai</h2>
  <table>
    <tr><th>Nama</th><td><?= $pegawai['nama'] ?></td></tr>
    <tr><th>NIP</th><td><?= $pegawai['nip'] ?></td></tr>
    <tr><th>Status</th><td><?= $pegawai['status'] ?></td></tr>
    <tr><th>Gaji Bruto Bulanan</th><td>Rp <?= number_format($pegawai['bruto_bulanan']) ?></td></tr>
    <tr><th>PPH Bruto Bulanan</th><td>Rp <?= number_format($pegawai['pph_bruto_bulanan']) ?></td></tr>
    <tr><th>PPH + TPP Bulanan</th><td>Rp <?= number_format($pegawai['pph_bruto_tpp_bulanan']) ?></td></tr>
    <tr><th>PPH Setahun</th><td>Rp <?= number_format($pegawai['pph_setahun']) ?></td></tr>
  </table>
>>>>>>> 1dae537324ce403d4bb1015628acd988641ee27a
</body>
</html>
