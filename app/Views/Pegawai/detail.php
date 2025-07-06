<?= $this->extend('dashboard/layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
  <div class="card shadow">
    <div class="card-header bg-info text-white">
      <h4 class="mb-0">Detail Pegawai</h4>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr><th>ID</th><td><?= esc($pegawai['id']) ?></td></tr>
        <tr><th>Nama</th><td><?= esc($pegawai['nama']) ?></td></tr>
        <tr><th>NIP</th><td><?= esc($pegawai['nip']) ?></td></tr>
        <tr><th>Bulan</th><td><?= esc($pegawai['bulan']) ?></td></tr>
        <tr><th>Tahun</th><td><?= esc($pegawai['tahun']) ?></td></tr>
        <tr><th>Status</th><td><?= esc($pegawai['status']) ?></td></tr>
        <tr><th>Gaji Pokok</th><td><?= number_format($pegawai['gaji_pokok']) ?></td></tr>
        <tr><th>Tunjangan Suami/Istri</th><td><?= number_format($pegawai['tunj_suami_istri']) ?></td></tr>
        <tr><th>Tunjangan Anak</th><td><?= number_format($pegawai['tunj_anak']) ?></td></tr>
        <tr><th>Tunjangan Jabatan</th><td><?= number_format($pegawai['tunj_jabatan']) ?></td></tr>
        <tr><th>Tunjangan Beras</th><td><?= number_format($pegawai['tunj_beras']) ?></td></tr>
        <tr><th>Tunjangan Lain</th><td><?= number_format($pegawai['tunj_lain']) ?></td></tr>
        <tr><th>Iuran Pensiun</th><td><?= number_format($pegawai['iuran_pensiun']) ?></td></tr>
        <tr><th>TPP</th><td><?= number_format($pegawai['tpp']) ?></td></tr>
        <tr><th>THR Gaji</th><td><?= number_format($pegawai['thr_gaji']) ?></td></tr>
        <tr><th>THR TPP</th><td><?= number_format($pegawai['thr_tpp']) ?></td></tr>
        <tr><th>Gaji 13</th><td><?= number_format($pegawai['gaji13']) ?></td></tr>
        <tr><th>TPP 13</th><td><?= number_format($pegawai['tpp13']) ?></td></tr>
        <tr><th>Bruto Bulanan</th><td><?= number_format($pegawai['bruto_bulanan']) ?></td></tr>
        <tr><th>PPH Bruto Bulanan</th><td><?= number_format($pegawai['pph_bruto_bulanan']) ?></td></tr>
        <tr><th>PPH Bruto TPP Bulanan</th><td><?= number_format($pegawai['pph_bruto_tpp_bulanan']) ?></td></tr>
        <tr><th>Created At</th><td><?= esc($pegawai['created_at']) ?></td></tr>
        <tr><th>Bruto Tahunan</th><td><?= number_format($pegawai['bruto_tahunan']) ?></td></tr>
        <tr><th>Iuran Tahunan</th><td><?= number_format($pegawai['iuran_tahunan']) ?></td></tr>
        <tr><th>Biaya Jabatan</th><td><?= number_format($pegawai['biaya_jabatan']) ?></td></tr>
        <tr><th>Total Pengurangan</th><td><?= number_format($pegawai['total_pengurangan']) ?></td></tr>
        <tr><th>Netto Tahunan</th><td><?= number_format($pegawai['netto_tahunan']) ?></td></tr>
        <tr><th>PTKP</th><td><?= number_format($pegawai['ptkp']) ?></td></tr>
        <tr><th>PKP</th><td><?= number_format($pegawai['pkp']) ?></td></tr>
        <tr><th>PPH Setahun</th><td><?= number_format($pegawai['pph_setahun']) ?></td></tr>
        <tr><th>Tarif</th><td><?= number_format($pegawai['tarif'], 2) ?>%</td></tr>
      </table>
      <a href="/pegawai" class="btn btn-secondary">Kembali</a>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
