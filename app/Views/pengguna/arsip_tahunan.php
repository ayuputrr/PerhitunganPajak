<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- (CSS tetap, tidak berubah) -->

<div class="container-arsip">
    <h2>Arsip Laporan Pajak Pegawai (Tahunan)</h2>

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
                    <th>Iuran Tahunan</th>
                    <th>TPP</th>
                    <th>THR Gaji</th>
                    <th>THR TPP</th>
                    <th>Gaji 13</th>
                    <th>TPP 13</th>
                    <th>Bruto Tahunan</th>
                    <th>Biaya Jabatan</th>
                    <th>Total Pengurangan</th>
                    <th>Netto Tahunan</th>
                    <th>PTKP</th>
                    <th>PKP</th>
                    <th>PPH Setahun</th>
                    <th>Tarif</th>
                    <th>Tahun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($arsip)): ?>
                <tr>
                    <td colspan="17" class="no-data">Tidak ada arsip tahunan ditemukan.</td>
                </tr>
            <?php else: ?>
                <?php $no = 1; foreach ($arsip as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>Rp <?= number_format($row['iuran_tahunan'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($row['tpp'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($row['thr_gaji'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($row['thr_tpp'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($row['gaji13'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($row['tpp13'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($row['bruto_tahunan'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($row['biaya_jabatan'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($row['total_pengurangan'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($row['netto_tahunan'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($row['ptkp'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($row['pkp'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($row['pph_setahun'], 0, ',', '.') ?></td>
                    <td><?= esc($row['tarif']) ?>%</td>
                    <td><?= esc($row['tahun']) ?></td>
                    <td>
                        <a href="<?= site_url('pengguna/exportPdfTahunan/' . $row['tahun']) ?>" target="_blank" class="btn btn-primary btn-sm">
                            Download PDF
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
