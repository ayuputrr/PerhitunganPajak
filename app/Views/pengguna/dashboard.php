<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
:root {
  --primary: #2F80ED;
  --secondary: #56CCF2;
  --bg-light: #f7fafc;
  --bg-card: #f4f8fb;
  --text-dark: #222;
  --font-main: 'Inter', Arial, sans-serif;
  --shadow: 0 4px 18px #2F80ED22;
}
body {
  background: var(--bg-light);
  font-family: var(--font-main);
  color: var(--text-dark);
  transition: background 0.2s;
}
.odoo-main-container {
  margin-left: 190px;
  margin-top: 14px;
  padding: 0.6rem 1vw 2rem 1vw;
  transition: margin-left 0.18s cubic-bezier(.4,0,.2,1);
}
@media (max-width: 768px) {
  .odoo-main-container {
    margin-left: 0;
    padding: 1rem 1rem;
  }
}
.row.g-4.mb-2 {
  margin-top: 0 !important;
  margin-bottom: 0.48rem !important;
}
.dashboard-odoo-tiles {
  display: flex;
  flex-direction: column;
  gap: 0.7rem;
  margin: 0;
}
.odoo-tile-card {
  background: linear-gradient(120deg, #f4f8fb 85%, #e3f0fa 100%);
  border-radius: 14px;
  box-shadow: 0 3px 12px #2F80ED22;
  padding: 0.7rem 0.9rem 0.8rem 0.9rem;
  text-align: left;
  border: none;
  width: 100%;
  margin: 0 auto;
  transition: box-shadow 0.14s, transform 0.15s, background 0.15s, color 0.15s;
}
.odoo-tile-card .tile-header {
  font-size: 1.06rem;
  font-weight: 700;
  margin-bottom: 0.21rem;
  color: #2656a3;
  display: flex;
  align-items: center;
  gap: 0.31rem;
}
.odoo-tile-card .tile-header .bi {
  font-size: 1.16rem;
  margin-right: 0.09rem;
  color: #2F80ED;
}
.odoo-tile-card .tile-main {
  font-size: 1.16rem;
  font-weight: bold;
  color: #2F80ED;
}
.odoo-tile-card.top {
  min-height: 80px;
}
.odoo-tile-card.bottom {
  min-height: 80px;
}
.btn-gradient {
  background: linear-gradient(to right, var(--primary), var(--secondary));
  color: white !important;
  font-weight: 600;
  border: none;
  box-shadow: 0 2px 8px #2F80ED44;
  transition: background 0.3s ease, transform 0.2s ease;
  border-radius: 10px;
}
.btn-gradient:hover {
  background: linear-gradient(to right, #1b6edc, #3fb6f0);
  transform: translateY(-1px);
}
.btn-gradient i {
  margin-right: 5px;
}
@media(max-width: 900px) {
  .dashboard-odoo-tiles .row.g-3 > div {
    flex: 0 0 100%;
    max-width: 100%;
    margin-bottom: 0.47rem;
  }
  .dashboard-odoo-tiles { gap: 0.15rem; }

  .row.g-3.justify-content-center > div {
    max-width: 100%;
    flex: 0 0 100%;
  }

  .odoo-tile-card .tile-header {
    font-size: 0.96rem;
  }
  .odoo-tile-card .tile-main {
    font-size: 1rem;
  }

  .btn-gradient {
    font-size: 0.95rem;
    padding: 0.5rem 1rem;
  }
}

</style>

<div class="odoo-main-container">

  <!-- Profile User -->
  <div class="row g-4 mb-2">
    <div class="col-md-6 col-12">
      <div class="card shadow-sm p-3 mb-0" style="border-radius:18px; border:none; min-height: 124px;">
        <div class="d-flex align-items-center gap-4">
          <div>
            <img src="<?= base_url('uploads/foto/' . ($pengguna['foto'] ?? 'default-avatar.png')) ?>" alt="Foto Profil"
              style="border-radius:50%;width:60px;height:60px;object-fit:cover;border: 3px solid var(--primary);box-shadow: 0 1px 7px #2F80ED11;">
          </div>
          <div>
            <div class="fw-bold fs-5 mb-1" style="color:var(--primary);"><?= esc($pengguna['nama']) ?></div>
            <div class="badge rounded-pill bg-light text-dark mb-1 fs-6" style="font-size:.95rem;">
              NIP: <?= esc($pengguna['nip']) ?>
            </div>
            <div style="color:#7a889d;font-weight:600;"><?= esc($pengguna['jabatan'] ?? '-') ?></div>
            <div class="mt-2">
              <span class="badge <?= (strtolower($pengguna['status'] ?? '') == 'nonaktif' ? 'bg-danger text-white' : 'bg-success text-white') ?>">
                <?= esc($pengguna['status'] ?? '-') ?>
              </span>
              <a href="<?= base_url('/pengguna/profil') ?>" class="btn btn-link p-0 ps-2 text-decoration-none"
                 style="font-weight:600; color: var(--primary)"><i class="bi bi-pencil-square"></i> Edit Profil</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- FILTER -->
  <form method="get" class="row g-2 mb-2 mt-2">
    <div class="col-6 col-md-auto">
      <select name="tahun" class="form-select">
        <option value="">Pilih Tahun</option>
        <?php foreach ($tahunList as $t): ?>
          <option value="<?= $t['tahun'] ?>" <?= $tahunFilter == $t['tahun'] ? 'selected' : '' ?>><?= $t['tahun'] ?></option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="col-6 col-md-auto">
      <select name="bulan" class="form-select">
        <option value="">Pilih Bulan</option>
        <?php
          $nama_bulan = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
                         7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];
          for ($i = 1; $i <= 12; $i++):
        ?>
          <option value="<?= $i ?>" <?= $bulanFilter == $i ? 'selected' : '' ?>><?= $nama_bulan[$i] ?></option>
        <?php endfor ?>
      </select>
    </div>
    <div class="col-12 col-md-auto">
      <button type="submit" class="btn btn-gradient w-100">
        <i class="bi bi-search"></i> Tampilkan
      </button>
    </div>
  </form>

  <div class="dashboard-odoo-tiles">
    <!-- BULAN & TAHUN CARD TENGAH -->
    <div class="row g-3 mb-2 justify-content-center">
      <div class="col-md-3 col-6">
        <div class="odoo-tile-card top mx-auto">
          <div class="tile-header"><i class="bi bi-calendar2-month"></i> Bulan</div>
          <div class="tile-main"><?= $nama_bulan[(int)$bulanFilter] ?? '-' ?></div>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="odoo-tile-card top mx-auto">
          <div class="tile-header"><i class="bi bi-calendar2"></i> Tahun</div>
          <div class="tile-main"><?= esc($tahunFilter) ?></div>
        </div>
      </div>
    </div>

    <!-- LAPORAN -->
    <div class="row g-3">
      <div class="col-md-4 col-12">
        <div class="odoo-tile-card bottom">
          <div class="tile-header"><i class="bi bi-cash-coin"></i> Bruto Bulanan</div>
          <div class="tile-main">Rp <?= number_format($laporan['bruto_bulanan'] ?? 0, 0, ',', '.') ?></div>
        </div>
      </div>
      <div class="col-md-4 col-12">
        <div class="odoo-tile-card bottom">
          <div class="tile-header"><i class="bi bi-percent"></i> PPH Bruto Bulanan</div>
          <div class="tile-main">Rp <?= number_format($laporan['pph_bruto_bulanan'] ?? 0, 0, ',', '.') ?></div>
        </div>
      </div>
      <div class="col-md-4 col-12">
        <div class="odoo-tile-card bottom">
          <div class="tile-header"><i class="bi bi-wallet2"></i> Gaji Pokok</div>
          <div class="tile-main">Rp <?= number_format($laporan['gaji_pokok'] ?? 0, 0, ',', '.') ?></div>
        </div>
      </div>
    </div>
  </div>

  <!-- TOMBOL DOWNLOAD -->
  <div class="text-end" style="margin-top: 1.2rem;">
    <button type="button" class="btn btn-gradient" title="Download Laporan Pajak" data-bs-toggle="modal" data-bs-target="#modalDownload">
      <i class="bi bi-download"></i> Download Laporan Pajak
    </button>
  </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="modalDownload" tabindex="-1" aria-labelledby="modalDownloadLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title"><i class="bi bi-download"></i> Pilih Jenis Download</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body text-center">
        <p>Silakan pilih jenis laporan yang ingin didownload:</p>
        <?php $isDesember = (date('m') === '12'); $tahunSekarang = date('Y'); ?>
        <div class="d-flex flex-column gap-3">
          <a href="<?= base_url('/pengguna/export_pdf?tahun=' . $tahunFilter . '&bulan=' . $bulanFilter) ?>" class="btn btn-gradient w-100">
            <i class="bi bi-calendar2-week"></i> Download Bulanan
          </a>
          <?php if ($isDesember): ?>
            <a href="<?= base_url('/pengguna/exportpdftahunan/' . $tahunSekarang) ?>" class="btn btn-gradient w-100">
              <i class="bi bi-calendar2"></i> Download Tahunan
            </a>
          <?php else: ?>
            <button type="button" class="btn btn-secondary w-100" disabled title="Hanya tersedia pada bulan Desember">
              <i class="bi bi-calendar2"></i> Download Tahunan <small>(Hanya bulan Desember)</small>
            </button>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
