<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
  <h3>📄 Detail Pajak Pegawai</h3>

  <table class="table table-bordered mt-3">
    <tr><th>Nama</th><td><?= $pegawai['nama'] ?></td></tr>
    <tr><th>NIP</th><td><?= $pegawai['nip'] ?></td></tr>
    <tr><th>Status</th><td><?= $pegawai['status'] ?></td></tr>
    <tr><th>Gaji Bruto Bulanan</th><td>Rp <?= number_format($pegawai['bruto_bulanan']) ?></td></tr>
    <tr><th>PPH Bruto Bulanan</th><td>Rp <?= number_format($pegawai['pph_bruto_bulanan']) ?></td></tr>
    <tr><th>PPH + TPP</th><td>Rp <?= number_format($pegawai['pph_bruto_tpp_bulanan']) ?></td></tr>
  </table>

  <a href="/pengguna/export_pdf/<?= $pegawai['id'] ?>" class="btn btn-danger mt-2">
    <i class="bi bi-file-earmark-pdf"></i> Export PDF
  </a>
</div>

<?= $this->endSection() ?>
