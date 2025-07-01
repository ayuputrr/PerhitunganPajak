<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Laporan Pajak - <?= $pegawai['nama'] ?></title>
  <style>
    body { font-family: sans-serif; font-size: 12px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    h2 { text-align: center; }
  </style>
</head>
<body>
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
</body>
</html>
