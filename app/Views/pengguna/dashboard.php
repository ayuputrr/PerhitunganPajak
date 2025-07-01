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
