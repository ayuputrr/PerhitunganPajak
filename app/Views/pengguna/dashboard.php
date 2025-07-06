<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Google Fonts & Bootstrap Icons -->
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
    --shadow-hover: 0 8px 32px #2F80ED33;
  }
  body {
    background: var(--bg-light);
    font-family: var(--font-main);
    color: var(--text-dark);
    transition: background 0.3s, color 0.3s;
  }
  .dashboard-container {
    margin-top: 2.7rem;
    margin-bottom: 2.2rem;
  }
  .dashboard-profile-card {
    background: linear-gradient(120deg, var(--bg-card) 80%, #e3f0fa 100%);
    border-radius: 18px;
    box-shadow: var(--shadow);
    padding: 1.7rem 2.2rem 1.4rem 2.2rem;
    margin-bottom: 2.2rem;
    display: flex;
    align-items: stretch;
    gap: 1.5rem;
    flex-wrap: wrap;
    justify-content: space-between;
    transition: background 0.3s;
    position: relative;
    overflow: visible;
  }
  .notif-pojok-kanan {
    position: absolute;
    top: 20px;
    right: 24px;
    z-index: 10;
  }
  .btn-notif-header {
    background: #fff;
    color: var(--primary);
    border: 2px solid var(--primary);
    border-radius: 50%;
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    position: relative;
    transition: background 0.18s, color 0.18s, border 0.18s;
    box-shadow: 0 2px 10px #2F80ED11;
  }
  .btn-notif-header:hover, .btn-notif-header:focus {
    background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
    color: #fff;
    border-color: var(--secondary);
    box-shadow: 0 4px 16px #56CCF244;
  }
  .badge-gradient {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: #fff;
    font-size: 0.95rem;
    font-weight: 600;
    border-radius: 1rem;
    padding: 0.2rem 0.7rem;
    position: absolute;
    top: 4px;
    right: 4px;
    box-shadow: 0 2px 8px #2F80ED33;
    z-index: 2;
  }
  .dashboard-profile-header {
    display: flex;
    align-items: center;
    gap: 1.2rem;
    margin-bottom: 0.7rem;
    position: relative;
  }
  .dashboard-avatar-lg {
    width: 95px;
    height: 95px;
    border-radius: 50%;
    object-fit: cover;
    box-shadow: 0 4px 24px #2F80ED44;
    border: 4px solid;
    border-image: linear-gradient(135deg, var(--primary), var(--secondary)) 1;
    background: #e3f0fa;
    display: block;
    transition: box-shadow 0.2s;
  }
  .dashboard-avatar-lg:hover {
    box-shadow: 0 8px 36px #2F80ED77;
    transform: scale(1.03);
  }
  .dashboard-profile-left {
    min-width: 240px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
    text-align: left;
    flex: 1;
  }
  .dashboard-profile-name {
    font-size: 1.35rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 0.1rem;
    letter-spacing: 0.5px;
  }
  .dashboard-profile-nip {
    font-size: 1.04rem;
    color: #444;
    font-weight: 500;
    background: var(--bg-card);
    border-radius: 8px;
    padding: 0.18rem 1.15rem;
    display: inline-block;
    margin-bottom: 0.2rem;
    margin-top: 0;
  }
  .dashboard-profile-jabatan {
    font-size: 1.01rem;
    color: #888;
    font-weight: 600;
    margin-bottom: 0.15rem;
  }
  .dashboard-profile-status {
    font-size: 1.04rem;
    font-weight: 600;
    color: #111 !important;
    background: #2F80ED !important;
    padding: 0.22rem 1.15rem;
    border-radius: 8px;
    margin-bottom: 0.2rem;
    display: inline-block;
    box-shadow: 0 2px 8px #2F80ED22;
    letter-spacing: 0.5px;
  }
  .dashboard-profile-status.status-nonaktif {
    background: linear-gradient(90deg, #e96443 0%, #904e95 100%) !important;
    color: #fff !important;
  }
  .dashboard-profile-actions {
    display: flex;
    flex-direction: row;
    gap: 0.8rem;
    align-items: center;
    margin-top: 0.7rem;
    justify-content: flex-start;
  }
  .btn-edit-profile {
    background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
    color: #fff;
    font-weight: 700;
    border: none;
    border-radius: 1.5rem;
    padding: 0.5rem 1.4rem;
    font-size: 1.02rem;
    box-shadow: 0 2px 8px 0 #2F80ED33;
    letter-spacing: 1px;
    transition: 0.18s;
    display: inline-block;
    text-decoration: none;
  }
  .btn-edit-profile:hover, .btn-edit-profile:focus {
    background: linear-gradient(90deg, var(--secondary) 0%, var(--primary) 100%);
    color: #fff;
    transform: translateY(-2px) scale(1.04);
    box-shadow: 0 6px 18px 0 #56CCF2cc;
    text-decoration: none;
  }
  .dashboard-profile-right {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
  .welcome-title {
    font-size: 1.35rem;
    font-weight: 700;
    margin-bottom: 0.3rem;
    color: var(--primary);
  }
  .welcome-desc {
    color: #666;
    font-size: 1.06rem;
    margin-bottom: 0.2rem;
  }
  .dashboard-row {
    display: flex;
    gap: 24px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 2.2rem;
  }
  .dashboard-card {
    background: #fff;
    color: var(--primary);
    border-radius: 20px;
    box-shadow: var(--shadow);
    padding: 1.5rem 1.2rem;
    margin-bottom: 1.2rem;
    text-align: center;
    min-width: 180px;
    max-width: 320px;
    width: 100%;
    transition: box-shadow 0.2s, transform 0.2s, background 0.3s, color 0.3s;
    border: none;
    position: relative;
    overflow: hidden;
  }
  .dashboard-card:hover {
    box-shadow: var(--shadow-hover);
    transform: translateY(-4px) scale(1.03);
    background: linear-gradient(120deg, #e0e7ff 80%, #c7d2fe 100%);
  }
  .dashboard-card:before {
    content: '';
    position: absolute;
    top: -30px; right: -30px;
    width: 80px; height: 80px;
    background: linear-gradient(135deg, #2F80ED88, #56CCF288);
    border-radius: 50%;
    opacity: 0.14;
    z-index: 0;
  }
  .dashboard-card h5 {
    font-weight: 700;
    font-size: 1.15rem;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.4rem;
    justify-content: center;
    color: #2656a3;
    z-index: 1;
    position: relative;
  }
  .dashboard-card h5 i {
    font-size: 1.3rem;
    margin-right: 0.2rem;
  }
  .dashboard-card h3 {
    font-size: 2.1rem;
    font-weight: bold;
    margin: 0;
    letter-spacing: 1px;
    color: var(--primary);
    text-shadow: 0 2px 10px #2f80ed11;
    z-index: 1;
    position: relative;
  }
  .download-kanan-bawah {
    width: 100%;
    display: flex;
    justify-content: flex-end;
    margin-top: 1.5rem;
  }
  .btn-download-pdf {
    background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
    color: #fff;
    font-weight: 700;
    border: none;
    border-radius: 1.5rem;
    padding: 0.85rem 2.2rem;
    font-size: 1.08rem;
    box-shadow: 0 4px 18px 0 #2F80ED33;
    letter-spacing: 1.2px;
    text-shadow: 0 1px 8px #2F80ED33;
    transition: 0.18s;
    display: inline-block;
  }
  .btn-download-pdf:hover, .btn-download-pdf:focus {
    background: linear-gradient(90deg, var(--secondary) 0%, var(--primary) 100%);
    color: #fff;
    transform: translateY(-2px) scale(1.04);
    box-shadow: 0 8px 36px 0 #56CCF2cc;
    text-decoration: none;
  }
  .btn-gradient {
    background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
    color: #fff;
    font-weight: 700;
    border: none;
    border-radius: 1.5rem;
    padding: 0.5rem 1.2rem;
    font-size: 1.02rem;
    box-shadow: 0 2px 8px 0 #2F80ED22;
    letter-spacing: 1px;
    transition: 0.18s;
    display: inline-block;
    text-decoration: none;
  }
  .btn-gradient:hover, .btn-gradient:focus {
    background: linear-gradient(90deg, var(--secondary) 0%, var(--primary) 100%);
    color: #fff;
    transform: translateY(-2px) scale(1.04);
    box-shadow: 0 6px 18px 0 #56CCF2cc;
    text-decoration: none;
  }
  @media (max-width: 900px) {
    .dashboard-profile-card {
      flex-direction: column;
      align-items: flex-start;
      gap: 1.2rem;
    }
    .notif-pojok-kanan {
      top: 12px;
      right: 12px;
    }
    .dashboard-profile-header {
      flex-direction: row;
      align-items: center;
      margin-bottom: 1rem;
    }
    .dashboard-profile-left, .dashboard-profile-right {
      min-width: 0;
    }
  }
  @media (max-width: 600px) {
    .notif-pojok-kanan {
      top: 8px;
      right: 8px;
    }
    .btn-notif-header {
      width: 36px;
      height: 36px;
      font-size: 1.1rem;
    }
    .badge-gradient {
      font-size: 0.8rem;
      padding: 0.15rem 0.5rem;
      top: 2px;
      right: 2px;
    }
    .dashboard-profile-card { padding: 1.1rem 0.7rem 1rem 0.7rem; }
    .welcome-title { font-size: 1.1rem; }
  }
</style>

<div class="container dashboard-container">
  <!-- Profile Card -->
  <div class="dashboard-profile-card">
    <div class="notif-pojok-kanan">
      <button type="button" class="btn btn-notif-header" data-bs-toggle="modal" data-bs-target="#modalNotifikasi" id="btnBell" title="Notifikasi">
        <i class="bi bi-bell"></i>
        <?php
          $notifikasiModel = new \App\Models\NotifikasiModel();
          $jumlahBaru = $notifikasiModel
              ->where('nip', $pengguna['nip'])
              ->where('dibaca', 0)
              ->countAllResults();
        ?>
        <?php if ($jumlahBaru > 0): ?>
          <span class="badge-gradient" id="badgeNotif"><?= $jumlahBaru ?></span>
        <?php endif; ?>
      </button>
    </div>
    <div class="dashboard-profile-left">
      <div class="dashboard-profile-header">
        <img src="<?= base_url('uploads/foto/' . ($pengguna['foto'] ?? 'default-avatar.png')) ?>"
             alt="Foto Profil"
             class="dashboard-avatar-lg mb-2">
      </div>
      <div class="dashboard-profile-name"><?= esc($pengguna['nama']) ?></div>
      <div class="dashboard-profile-nip">NIP: <?= esc($pengguna['nip']) ?></div>
      <div class="dashboard-profile-jabatan"><?= esc($pengguna['jabatan'] ?? '-') ?></div>
      <div class="dashboard-profile-status <?= (strtolower($pengguna['status'] ?? '') == 'nonaktif' ? 'status-nonaktif' : '') ?>">
      <?= esc($pengguna['status'] ?? '-') ?>
      </div>
      <div class="dashboard-profile-actions">
        <a href="<?= base_url('/pengguna/profil') ?>" class="btn-edit-profile">
          <i class="bi bi-pencil-square"></i> Edit Profil
        </a>
      </div>
    </div>
  </div>

  <!-- FILTER TAHUN & BULAN -->
  <form method="get" class="row g-2 mb-3">
    <div class="col-6 col-md-auto">
      <select name="tahun" class="form-select">
        <option value="">Pilih Tahun</option>
        <?php foreach ($tahunList as $t): ?>
          <option value="<?= $t['tahun'] ?>" <?= $tahunFilter == $t['tahun'] ? 'selected' : '' ?>>
            <?= $t['tahun'] ?>
          </option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="col-6 col-md-auto">
      <select name="bulan" class="form-select">
        <option value="">Pilih Bulan</option>
        <?php
          $nama_bulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
          ];
          for ($i = 1; $i <= 12; $i++):
        ?>
          <option value="<?= $i ?>" <?= $bulanFilter == $i ? 'selected' : '' ?>>
            <?= $nama_bulan[$i] ?>
          </option>
        <?php endfor ?>
      </select>
    </div>
    <div class="col-12 col-md-auto">
      <button type="submit" class="btn btn-gradient w-100"><i class="bi bi-search" style="color:#fff;"></i> Tampilkan</button>
    </div>
  </form>

  <!-- CARD BULAN & TAHUN (ATAS) -->
  <div class="dashboard-row">
    <div>
      <div class="dashboard-card">
        <h5><i class="bi bi-calendar2-month"></i> Bulan</h5>
        <h3>
          <?= $nama_bulan[(int)$bulanFilter] ?? '-' ?>
        </h3>
      </div>
    </div>
    <div>
      <div class="dashboard-card">
        <h5><i class="bi bi-calendar2"></i> Tahun</h5>
        <h3><?= esc($tahunFilter) ?></h3>
      </div>
    </div>
  </div>

  <!-- CARD BRUTO, PPH BULANAN, GAJI POKOK (BAWAH) -->
  <div class="dashboard-row">
    <div>
      <div class="dashboard-card">
        <h5><i class="bi bi-cash-coin"></i> Bruto Bulanan</h5>
        <h3>Rp <?= number_format($laporan['bruto_bulanan'] ?? 0, 0, ',', '.') ?></h3>
      </div>
    </div>
    <div>
      <div class="dashboard-card">
        <h5><i class="bi bi-percent"></i> PPH Bruto Bulanan</h5>
        <h3>Rp <?= number_format($laporan['pph_bruto_bulanan'] ?? 0, 0, ',', '.') ?></h3>
      </div>
    </div>
    <div>
      <div class="dashboard-card">
        <h5><i class="bi bi-wallet2"></i> Gaji Pokok</h5>
        <h3>Rp <?= number_format($laporan['gaji_pokok'] ?? 0, 0, ',', '.') ?></h3>
      </div>
    </div>
  </div>

  <!-- Tombol Download di Kanan Bawah Card -->
  <div class="download-kanan-bawah">
    <button type="button" class="btn btn-download-pdf" title="Download Laporan Pajak" data-bs-toggle="modal" data-bs-target="#modalDownload">
      <i class="bi bi-download"></i> Download Laporan Pajak
    </button>
  </div>
</div>

<!-- MODAL PILIHAN DOWNLOAD -->
<div class="modal fade" id="modalDownload" tabindex="-1" aria-labelledby="modalDownloadLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalDownloadLabel"><i class="bi bi-download"></i> Pilih Jenis Download</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body text-center">
        <p>Silakan pilih jenis laporan yang ingin didownload:</p>
        <div class="d-flex flex-column gap-3">
          <a href="<?= base_url('/pengguna/export_pdf?mode=bulanan') ?>" class="btn btn-gradient w-100">
            <i class="bi bi-calendar2-week"></i> Download Bulanan
          </a>
          <button id="btnDownloadTahunan" class="btn btn-gradient w-100" type="button">
            <i class="bi bi-calendar2"></i> Download Tahunan
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- MODAL NOTIFIKASI -->
<div class="modal fade" id="modalNotifikasi" tabindex="-1" aria-labelledby="modalNotifikasiLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalNotifikasiLabel"><i class="bi bi-bell"></i> Notifikasi Anda</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <?php
          $notifikasiModel = new \App\Models\NotifikasiModel();
          $notifikasi = $notifikasiModel
              ->where('nip', $pengguna['nip'])
              ->orderBy('created_at', 'DESC')
              ->findAll();
        ?>
        <?php if (!empty($notifikasi)): ?>
          <ul class="list-group" id="listNotifikasi">
            <?php foreach ($notifikasi as $notif): ?>
              <li class="list-group-item d-flex justify-content-between align-items-start <?= $notif['dibaca'] ? '' : 'list-group-item-primary' ?>" data-id="<?= $notif['id'] ?>">
                <div>
                  <div class="fw-bold"><?= esc($notif['pesan']) ?></div>
                  <small class="text-muted"><i class="bi bi-clock"></i> <?= date('d M Y H:i', strtotime($notif['created_at'])) ?></small>
                  <?php if (!$notif['dibaca']): ?>
                    <span class="badge badge-gradient ms-2">Baru</span>
                  <?php endif; ?>
                </div>
                <button class="btn btn-sm btn-outline-primary btnHapusNotif ms-2" title="Hapus Notifikasi">
                  <i class="bi bi-trash"></i>
                </button>
              </li>
            <?php endforeach ?>
          </ul>
          <button class="btn btn-gradient mt-3 w-100" id="btnTandaiDibaca">
            <i class="bi bi-check2-circle"></i> Tandai Telah Dibaca
          </button>
        <?php else: ?>
          <div class="alert alert-light mb-0">Belum ada notifikasi.</div>
        <?php endif; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Download Tahunan: sekarang SELALU bisa, tidak tergantung bulan
  const btnDownloadTahunan = document.getElementById('btnDownloadTahunan');
  btnDownloadTahunan.addEventListener('click', function () {
    <?php if (empty($arsip_tahunan_tersedia)): ?>
      alert('Arsip tahunan belum tersedia untuk diunduh. Silakan hubungi admin atau cek kembali di akhir tahun.');
    <?php else: ?>
    window.open('<?= base_url('/pengguna/exportPdfTahunan/' . date('Y')) ?>', '_blank');

    <?php endif; ?>
  });

  // Handler tombol "Tandai Telah Dibaca"
  const btnTandai = document.getElementById('btnTandaiDibaca');
  if (btnTandai) {
    btnTandai.addEventListener('click', function() {
      btnTandai.disabled = true;
      fetch('<?= base_url("/pengguna/notifikasi_dibaca") ?>', {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status) {
          document.querySelectorAll('#listNotifikasi li').forEach(function(li) {
            li.classList.remove('list-group-item-primary');
            li.querySelectorAll('.badge').forEach(function(badge){ badge.remove(); });
          });
          const badgeNotif = document.getElementById('badgeNotif');
          if(badgeNotif) badgeNotif.remove();
        } else {
          alert('Gagal menandai notifikasi');
        }
      })
      .finally(() => btnTandai.disabled = false);
    });
  }

  // Handler tombol hapus notifikasi
  document.querySelectorAll('.btnHapusNotif').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      const li = btn.closest('li[data-id]');
      const id = li.getAttribute('data-id');
      if (confirm('Hapus notifikasi ini?')) {
        btn.disabled = true;
        fetch('<?= base_url("/pengguna/hapus_notifikasi") ?>/' + id, {
          method: 'POST',
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(data => {
          if (data.status) {
            li.remove();
            const badgeNotif = document.getElementById('badgeNotif');
            if(badgeNotif) {
              let sisa = document.querySelectorAll('#listNotifikasi .list-group-item-primary').length;
              if(sisa > 0) {
                badgeNotif.innerText = sisa;
              } else {
                badgeNotif.remove();
              }
            }
          } else {
            alert(data.msg || 'Gagal menghapus notifikasi');
          }
        })
        .finally(() => btn.disabled = false);
      }
    });
  });
});
</script>

<?= $this->endSection() ?>
