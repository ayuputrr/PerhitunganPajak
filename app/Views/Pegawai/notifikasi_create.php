<!DOCTYPE html>
<html>
<head>
  <title>Form Tambah Pajak Pegawai</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
  <h2>Input Pajak Bulanan Pegawai</h2>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>

  <form action="/pegawai/notifikasi_kirim" method="post">
    <?= csrf_field() ?>

    <div class="mb-3">
      <label for="nip" class="form-label">NIP Pegawai</label>
      <input type="text" name="nip" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="bruto_bulanan" class="form-label">Bruto Bulanan</label>
      <input type="number" step="0.01" name="bruto_bulanan" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="pph_bruto_bulanan" class="form-label">PPH Bruto Bulanan</label>
      <input type="number" step="0.01" name="pph_bruto_bulanan" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="pph_bruto_tpp_bulanan" class="form-label">PPH Bruto TPP Bulanan</label>
      <input type="number" step="0.01" name="pph_bruto_tpp_bulanan" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan & Kirim Notifikasi</button>
  </form>
</body>
</html>
