<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<style>
.container-arsip {
    max-width: 1100px;
    margin: 30px auto;
    background: #fff;
    padding: 32px 22px;
    border-radius: 1.7rem;
    box-shadow: 0 6px 28px 0 rgba(47,128,237,0.12);
    font-family: 'Poppins', Arial, sans-serif;
    transition: box-shadow 0.18s cubic-bezier(.4,0,.2,1), background 0.2s, color 0.2s;
}
.container-arsip:hover {
    box-shadow: 0 12px 40px 0 rgba(47,128,237,0.18);
}
h2 {
    text-align: center;
    margin-bottom: 24px;
    color: #2F80ED;
    font-size: 1.5rem;
    font-family: 'Poppins', Arial, sans-serif;
    font-weight: bold;
    letter-spacing: 0.5px;
}
.info-pegawai {
    background: #f2f7fc;
    border-radius: 10px;
    padding: 14px 20px;
    margin-bottom: 18px;
    font-size: 1.05rem;
    color: #2F80ED;
    font-weight: 500;
}
th, td {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 10px 8px;
    font-size: 14px;
    font-family: 'Poppins', Arial, sans-serif;
    vertical-align: middle;
}
.table-primary {
    background: linear-gradient(90deg, #2F80ED 60%, #56CCF2 100%) !important;
    color: #fff;
    font-weight: 600;
}
tr:hover td {
    background: #eaf2fb !important;
}
.no-data {
    text-align: center;
    color: #888;
    font-style: italic;
    font-family: 'Poppins', Arial, sans-serif;
    background: #f9fafc;
}
@media (max-width: 900px) {
    .container-arsip { padding: 10px 2px; }
    th, td { font-size: 12px; padding: 8px 3px; }
}
@media (max-width: 600px) {
    .container-arsip { border-radius: 1rem; }
    table, thead, tbody, th, td, tr { font-size: 11px; }
}
body.dark-mode .container-arsip {
    background: #232d3a;
    color: #eaf2fb;
    box-shadow: 0 4px 24px 0 rgba(24,31,42,0.13);
}
body.dark-mode .info-pegawai {
    background: #20293a;
    color: #56CCF2;
}
body.dark-mode table {
    color: #eaf2fb;
    background: #232d3a;
}
body.dark-mode .table-primary {
    background-color: #2F80ED !important;
    color: #fff;
}
body.dark-mode .table-striped>tbody>tr:nth-of-type(odd)>* {
    background-color: #232d3a;
    color: #eaf2fb;
}
body.dark-mode .table-bordered th,
body.dark-mode .table-bordered td {
    border-color: #2F80ED;
}
body.dark-mode tr:hover td {
    background: #1a2230 !important;
}
</style>

<div class="container-arsip">
    <h2>Arsip Laporan Pajak Pegawai (Bulanan)</h2>

    <?php if (!empty($pegawai)): ?>
    <div class="info-pegawai">
        <i class="bi bi-person-circle"></i>
        <strong>Nama:</strong> <?= esc($pegawai['nama']) ?> &nbsp; | &nbsp;
        <strong>NIP:</strong> <?= esc($pegawai['nip']) ?> &nbsp; | &nbsp;
        <strong>Status:</strong> <?= esc($pegawai['status']) ?>
    </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-sm table-bordered table-striped align-middle">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Status</th>
                    <th>Gaji Pokok</th>
                    <th>Tunj. Suami/Istri</th>
                    <th>Tunj. Anak</th>
                    <th>Tunj. Jabatan</th>
                    <th>Tunj. Beras</th>
                    <th>Tunj. Lain</th>
                    <th>Bruto Bulanan</th>
                    <th>PPH Bruto Bulanan</th>
                    <th>PPH Bruto TPP Bulanan</th>
                    <th>Tanggal Arsip</th>
                    <th>Aksi</th>

                </tr>
            </thead>
            <tbody>
            <?php
                $nama_bulan = [
                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                ];
            ?>
            <?php if (empty($arsip)): ?>
                <tr>
                    <td colspan="16" class="no-data">Tidak ada arsip laporan pajak ditemukan.</td>
                </tr>
            <?php else: ?>
                <?php $no = 1; foreach ($arsip as $laporan): ?>
               <tr>
  <td><?= $no++ ?></td>
  <td><?= $nama_bulan[(int)$laporan['bulan']] ?? '-' ?></td>
  <td><?= $laporan['tahun'] ?? '-' ?></td>
  <td><?= esc($pegawai['nama']) ?></td>
  <td><?= esc($pegawai['nip']) ?></td>
  <td><?= esc($pegawai['status']) ?></td>
  <td>Rp <?= number_format($laporan['gaji_pokok'], 0, ',', '.') ?></td>
  <td>Rp <?= number_format($laporan['tunj_suami_istri'], 0, ',', '.') ?></td>
  <td>Rp <?= number_format($laporan['tunj_anak'], 0, ',', '.') ?></td>
  <td>Rp <?= number_format($laporan['tunj_jabatan'], 0, ',', '.') ?></td>
  <td>Rp <?= number_format($laporan['tunj_beras'], 0, ',', '.') ?></td>
  <td>Rp <?= number_format($laporan['tunj_lain'], 0, ',', '.') ?></td>
  <td>Rp <?= number_format($laporan['bruto_bulanan'], 0, ',', '.') ?></td>
  <td>Rp <?= number_format($laporan['pph_bruto_bulanan'], 0, ',', '.') ?></td>
  <td>Rp <?= number_format($laporan['pph_bruto_tpp_bulanan'], 0, ',', '.') ?></td>
  <td><?= date('d-m-Y H:i', strtotime($laporan['created_at'])) ?></td>
  <td>
    <form action="<?= base_url('/pengguna/hapus_arsip_bulanan') ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus arsip laporan ini?')" style="display:inline;">
      <?= csrf_field() ?>
      <input type="hidden" name="id" value="<?= $laporan['id'] ?>">
      <button type="submit" class="btn btn-sm btn-danger" title="Hapus Arsip">
        <i class="bi bi-trash"></i>
      </button>
    </form>
  </td>
</tr>

                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>