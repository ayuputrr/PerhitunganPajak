<!DOCTYPE html>
<html>
<head>
  <title>Laporan Pajak Pegawai</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-success text-white">
      <h4 class="mb-0">Laporan Pajak Pegawai</h4>
    </div>
    <div class="card-body">

      <p><strong>Nama:</strong> <?= $data['nama'] ?></p>
      <p><strong>NIP:</strong> <?= $data['nip'] ?></p>
      <p><strong>Status:</strong> <?= $data['status'] ?></p>
      <hr>

      <p><strong>Total Gaji Bruto Bulanan:</strong> Rp <?= number_format($data['bruto_bulanan'], 0, ',', '.') ?></p>
      <p><strong>PPH Bruto Bulanan:</strong> Rp <?= number_format($data['pph_bruto_bulanan'], 0, ',', '.') ?></p>
      <p><strong>PPH Bruto + TPP Bulanan:</strong> Rp <?= number_format($data['pph_bruto_tpp_bulanan'], 0, ',', '.') ?></p>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
