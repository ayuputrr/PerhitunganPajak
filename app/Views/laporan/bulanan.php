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
  .form-select, .form-control {
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

<div class="container-fluid px-5 py-5">
  <div class="card card-modern p-4 mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center">
      <h3 class="fw-bold mb-4 mb-lg-0">
        <i class="bi bi-bar-chart-fill text-primary me-2"></i>Laporan PPh 21 Bulanan Pegawai
      </h3>
      <form method="get" action="<?= base_url('laporan/bulanan') ?>" class="d-flex flex-wrap gap-2">
        <select name="bulan" id="bulan" class="form-select">
          <?php 
            $bulanList = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            foreach ($bulanList as $i => $namaBulan): ?>
              <option value="<?= $i + 1 ?>" <?= ($selectedMonth ?? date('n')) == ($i + 1) ? 'selected' : '' ?>>
                <?= $namaBulan ?>
              </option>
          <?php endforeach ?>
        </select>
        <select name="status" id="status" class="form-select">
          <option value="all" <?= ($selectedStatus ?? 'all') == 'all' ? 'selected' : '' ?>>-- Semua Status --</option>
          <option value="sudah" <?= ($selectedStatus ?? '') == 'sudah' ? 'selected' : '' ?>>Sudah Dihitung</option>
          <option value="belum" <?= ($selectedStatus ?? '') == 'belum' ? 'selected' : '' ?>>Belum Dihitung</option>
        </select>
        <button type="submit" class="btn btn-outline-primary">
          <i class="bi bi-funnel"></i> Tampilkan
        </button>
        <a href="<?= base_url('laporan/export_excel_bulanan?bulan=' . ($selectedMonth ?? date('n')) . '&status=' . ($selectedStatus ?? 'all')) ?>" class="btn btn-outline-success">
          <i class="bi bi-file-earmark-excel-fill"></i> Export Excel
        </a>
      </form>
    </div>
  </div>

  <?php
    $totalPegawai = count($laporan);
    $totalGaji = array_sum(array_map(fn($r) => $r['bruto_bulanan'] ?? 0, $laporan));
    $totalPPH = array_sum(array_map(fn($r) => $r['pph_bruto_bulanan'] ?? 0, $laporan));
  ?>

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
            <div class="text-muted small">Total Gaji Bruto Bulan Ini</div>
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
            <div class="text-muted small">Total PPH Bruto Bulan Ini</div>
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
            <th>Nama Pegawai</th>
            <th>Status</th>
            <th>Bulan</th>
            <th>Gaji Bruto</th>
            <th>Iuran Pensiun</th>
            <th>TPP</th>
            <th>Tarif (%)</th>
            <th class="text-danger">PPH Bruto</th>
            <th class="text-primary">PPH Bruto + TPP</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($laporan as $row): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= esc($row['nip']) ?></td>
              <td class="text-start"><?= esc($row['nama']) ?></td>
              <td><?= esc($row['status']) ?></td>
              <td><?= $row['bulan'] ?></td>
              <td class="text-end">Rp <?= number_format($row['bruto_bulanan']) ?></td>
              <td class="text-end">Rp <?= number_format($row['iuran_pensiun']) ?></td>
              <td class="text-end">Rp <?= number_format($row['tpp']) ?></td>
              <td><?= number_format($row['tarif'], 2) ?>%</td>
              <td class="text-end text-danger">Rp <?= number_format($row['pph_bruto_bulanan']) ?></td>
              <td class="text-end text-primary">Rp <?= number_format($row['pph_bruto_tpp_bulanan']) ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
