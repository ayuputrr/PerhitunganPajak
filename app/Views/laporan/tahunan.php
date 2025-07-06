<?= $this->extend('dashboard/layout') ?>
<?= $this->section('content') ?>

<style>
  .card-modern {
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    border: none;
  }
  .table thead th {
    vertical-align: middle;
    background: linear-gradient(to right, #0d6efd, #3ca9ff);
    color: white;
    position: sticky;
    top: 0;
    z-index: 1;
  }
  .form-control, .form-select {
    border-radius: 10px;
    font-size: 0.95rem;
  }
  .btn-outline-custom {
    border-color: #0d6efd;
    color: #0d6efd;
  }
  .btn-outline-custom:hover {
    background-color: #0d6efd;
    color: white;
  }
</style>

<?php
  $filterStatus = $selectedStatus ?? 'all';
  $filteredData = $filterStatus == 'all' ? $laporan : array_filter($laporan, fn($r) => $r['status'] === $filterStatus);
  $totalPegawai = count($filteredData);
  $totalGaji = array_sum(array_map(fn($r) => ($r['bruto_bulanan'] ?? 0) * 12, $filteredData));
  $totalPPH = array_sum(array_map(fn($r) => ($r['pph_bruto_bulanan'] ?? 0) * 12, $filteredData));
?>

<div class="container-fluid px-5 py-5">
  <div class="card card-modern p-4 mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center">
      <h3 class="fw-bold mb-4 mb-lg-0">
        <i class="bi bi-calendar2-week-fill text-primary me-2"></i>
        Laporan Pajak Tahunan Pegawai - Tahun <?= esc($selectedYear) ?>
      </h3>
      <form method="get" action="<?= base_url('laporan/tahunan') ?>" id="formFilter" class="d-flex flex-wrap gap-2">
        <select name="tahun" id="tahun" class="form-select">
          <?php for ($y = 2020; $y <= date('Y'); $y++): ?>
            <option value="<?= $y ?>" <?= $y == $selectedYear ? 'selected' : '' ?>><?= $y ?></option>
          <?php endfor ?>
        </select>
        <select name="status" id="status" class="form-select">
          <option value="all" <?= $filterStatus == 'all' ? 'selected' : '' ?>>-- Semua Status --</option>
          <?php foreach (array_unique(array_column($laporan, 'status')) as $st): ?>
            <option value="<?= $st ?>" <?= $filterStatus == $st ? 'selected' : '' ?>><?= $st ?></option>
          <?php endforeach ?>
        </select>
        <button type="submit" class="btn btn-outline-primary">
          <i class="bi bi-funnel-fill"></i> Tampilkan
        </button>
        <a href="<?= base_url('laporan/export_excel_tahunan?tahun=' . ($selectedYear ?? date('Y')) . '&status=' . ($filterStatus ?? 'all')) ?>" class="btn btn-outline-success">
          <i class="bi bi-file-earmark-excel-fill"></i> Export Excel
        </a>
      </form>
    </div>
  </div>

  <div class="row g-4 mb-4">
    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body d-flex align-items-center">
          <div class="me-3">
            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 48px; height: 48px;">
              <i class="bi bi-people-fill fs-5"></i>
            </div>
          </div>
          <div>
            <div class="text-muted small">Total Pegawai</div>
            <div class="fw-bold fs-5"><?= $totalPegawai ?></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body d-flex align-items-center">
          <div class="me-3">
            <div class="bg-info text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 48px; height: 48px;">
              <i class="bi bi-cash-stack fs-5"></i>
            </div>
          </div>
          <div>
            <div class="text-muted small">Total Gaji Bruto</div>
            <div class="fw-bold fs-5 text-primary">Rp <?= number_format($totalGaji) ?></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body d-flex align-items-center">
          <div class="me-3">
            <div class="bg-danger text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 48px; height: 48px;">
              <i class="bi bi-receipt fs-5"></i>
            </div>
          </div>
          <div>
            <div class="text-muted small">Total PPH Tahunan</div>
            <div class="fw-bold fs-5 text-danger">Rp <?= number_format($totalPPH) ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card card-modern p-4">
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle text-center">
        <thead>
          <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Status</th>
            <th>Gaji Bruto (Tahunan)</th>
            <th class="text-danger">PPH (Tahunan)</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($filteredData as $row): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= esc($row['nip']) ?></td>
              <td class="text-start"><?= esc($row['nama']) ?></td>
              <td><?= esc($row['status']) ?></td>
              <td class="text-end">Rp <?= number_format(($row['bruto_bulanan'] ?? 0) * 12) ?></td>
              <td class="text-end text-danger">Rp <?= number_format(($row['pph_bruto_bulanan'] ?? 0) * 12) ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
