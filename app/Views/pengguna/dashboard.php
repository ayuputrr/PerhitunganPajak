<<<<<<< HEAD
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pajak</title>
</head>
<body>
    <h2>Selamat Datang, <?= session('nama') ?></h2>

    <h3>Laporan Pajak Terbaru</h3>
    <?php if ($laporan): ?>
        <ul>
            <li>Bulan: <?= $laporan['bulan'] ?></li>
            <li>Tahun: <?= $laporan['tahun'] ?></li>
            <li>Bruto Bulanan: Rp<?= number_format($laporan['bruto_bulanan'], 0, ',', '.') ?></li>
            <li>PPH Bruto Gaji: Rp<?= number_format($laporan['pph_bruto_bulanan'], 0, ',', '.') ?></li>
            <li>PPH Bruto TPP: Rp<?= number_format($laporan['pph_bruto_tpp_bulanan'], 0, ',', '.') ?></li>
        </ul>
    <?php else: ?>
        <p>Tidak ada laporan tersedia.</p>
    <?php endif; ?>

    <p><a href="<?= base_url('pengguna/arsip') ?>">Lihat Arsip Laporan</a></p>
</body>
</html>
=======
<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
  <h3 class="mb-4">Selamat Datang, <?= esc($pegawai['nama']) ?></h3>

  <div class="row">
    <div class="col-md-4 mb-3">
      <div class="card p-3 bg-primary text-white rounded shadow">
        <h5>Bruto Bulanan</h5>
        <h3>Rp <?= number_format($pegawai['bruto_bulanan'], 0, ',', '.') ?></h3>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card p-3 bg-info text-white rounded shadow">
        <h5>PPH Bruto Bulanan</h5>
        <h3>Rp <?= number_format($pegawai['pph_bruto_bulanan'], 0, ',', '.') ?></h3>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card p-3 bg-success text-white rounded shadow">
        <h5>PPH Setahun</h5>
        <h3>Rp <?= number_format($pegawai['pph_setahun'], 0, ',', '.') ?></h3>
      </div>
    </div>
  </div>

  <a href="/pengguna/export_pdf/<?= $pegawai['id'] ?>" class="btn btn-danger mt-4">
    <i class="bi bi-file-earmark-pdf"></i> Unduh Laporan PDF
  </a>
  <a href="/pengguna/logout" class="btn btn-secondary mt-4">🔒 Logout</a>
</div>

<?= $this->endSection() ?>
>>>>>>> 1dae537324ce403d4bb1015628acd988641ee27a
