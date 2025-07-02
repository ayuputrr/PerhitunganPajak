<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
  <h3>📁 Arsip Laporan Pajak</h3>

  <?php if ($arsip): ?>
    <table class="table table-bordered mt-3">
      <thead class="table-dark">
        <tr>
          <th>Bulan</th>
          <th>Tahun</th>
          <th>Bruto</th>
          <th>PPH</th>
          <th>Total</th>
          <th>Unduh</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($arsip as $item): ?>
        <tr>
          <td><?= $item['bulan'] ?></td>
          <td><?= $item['tahun'] ?></td>
          <td>Rp <?= number_format($item['bruto'], 0, ',', '.') ?></td>
          <td>Rp <?= number_format($item['pph'], 0, ',', '.') ?></td>
          <td>Rp <?= number_format($item['total'], 0, ',', '.') ?></td>
          <td>
            <a href="/pengguna/export_pdf/<?= $item['id'] ?>" class="btn btn-sm btn-danger">
              PDF
            </a>
          </td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class="alert alert-info mt-3">Belum ada arsip laporan pajak.</div>
  <?php endif ?>
</div>

<?= $this->endSection() ?>
