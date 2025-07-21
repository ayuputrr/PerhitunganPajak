<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<style>
  .card-gradient {
    background: linear-gradient(135deg, #2F80ED, #56CCF2);
    color: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 12px #56CCF2;
    width: 100%;
    max-width: 320px;
    min-width: 220px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 1.5rem 1rem;
    margin-bottom: 0;
  }
  .card-gradient h5 {
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 0.4rem;
  }
  .card-gradient h3 {
    font-size: 2rem;
    font-weight: bold;
    margin: 0;
    letter-spacing: 1px;
  }
  .row-equal {
    display: flex;
    gap: 18px;
    justify-content: center;
    flex-wrap: nowrap;
    margin-bottom: 2rem;
  }
  .row-equal > div {
    flex-grow: 1;
    flex-basis: 0;
    max-width: 50%;
    display: flex;
    justify-content: center;
  }
  .row-equal-3 > div {
    max-width: 33.3333%;
  }
  @media (max-width: 992px) {
    .row-equal, .row-equal-3 {
      flex-wrap: wrap;
      gap: 12px;
    }
    .row-equal > div,
    .row-equal-3 > div {
      max-width: 100%;
      min-width: 220px;
      margin-bottom: 12px;
    }
  }
  @media (max-width: 600px) {
    .row-equal > div,
    .row-equal-3 > div {
      max-width: 100%;
      min-width: 180px;
    }
    .card-gradient {
      font-size: 0.95rem;
      padding: 1rem !important;
    }
  }
  .modal-header.bg-primary {
    background: linear-gradient(135deg, #2F80ED, #56CCF2) !important;
    color: #fff !important;
  }
  .btn-gradient {
    background: linear-gradient(135deg, #2F80ED, #56CCF2);
    color: #fff !important;
    border: none;
  }
  .btn-gradient:hover {
    filter: brightness(0.95);
    color: #fff !important;
  }
  .badge-gradient {
    background: linear-gradient(135deg, #2F80ED, #56CCF2);
    color: #fff;
  }
  .floating-download {
    position: fixed;
    right: 30px;
    bottom: 120px;
    z-index: 999;
    box-shadow: 0 4px 16px rgba(47,128,237,0.18);
    border-radius: 30px;
    padding: 0.75rem 1.5rem;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }
  @media (max-width: 992px) {
    .floating-download {
      right: 16px;
      bottom: 90px;
      font-size: 1rem;
      padding: 0.6rem 1.2rem;
    }
    .container {
      padding-left: 8px;
      padding-right: 8px;
    }
    .card-gradient {
      padding: 1rem !important;
      max-width: 100%;
      min-width: auto;
    }
  }
  /* Toast di tengah layar */
  .toast-center {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1080;
    min-width: 320px;
    max-width: 90vw;
  }
  /* Animasi tertarik ke notifikasi */
  @keyframes tarikNotif {
    0% { box-shadow: 0 0 0 0 rgba(255,193,7,0.7); transform: scale(1) rotate(0deg);}
    20% { transform: scale(1.15) rotate(-10deg);}
    40% { transform: scale(1.2) rotate(10deg);}
    60% { transform: scale(1.15) rotate(-10deg);}
    80% { transform: scale(1.1) rotate(10deg);}
    100% { box-shadow: 0 0 0 0 rgba(255,193,7,0.0); transform: scale(1) rotate(0deg);}
  }
  .tarik-animasi {
    animation: tarikNotif 1s cubic-bezier(.68,-0.55,.27,1.55) 1;
    background: linear-gradient(90deg, #ffe082, #ffd54f, #fffde7) !important;
    color: #222 !important;
    border: 2px solid #ffc107 !important;
  }
</style>

<!-- Audio notifikasi -->
<audio id="notifSound" src="https://cdn.pixabay.com/audio/2022/07/26/audio_124bfae5c7.mp3" preload="auto"></audio>

<div class="container mt-5">
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-2">
    <h3 class="mb-0">Selamat Datang, <?= esc($pegawai['nama']) ?></h3>
    <!-- Tombol Notifikasi -->
    <button type="button" class="btn btn-outline-primary position-relative" data-bs-toggle="modal" data-bs-target="#modalNotifikasi" id="btnBell">
      <i class="bi bi-bell" style="color:#222;"></i>
      Notifikasi
      <?php
        $notifikasiModel = new \App\Models\NotifikasiModel();
        $jumlahBaru = $notifikasiModel
            ->where('nip', $pegawai['nip'])
            ->where('dibaca', 0)
            ->countAllResults();
      ?>
      <?php if ($jumlahBaru > 0): ?>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge-gradient text-white" id="badgeNotif">
          <?= $jumlahBaru ?>
        </span>
      <?php endif; ?>
    </button>
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
        ?>
        <?php foreach ($bulanList as $b): ?>
          <option value="<?= $b['bulan'] ?>" <?= $bulanFilter == $b['bulan'] ? 'selected' : '' ?>>
            <?= $nama_bulan[(int)$b['bulan']] ?>
          </option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="col-12 col-md-auto">
      <button type="submit" class="btn btn-gradient w-100"><i class="bi bi-search" style="color:#222;"></i> Tampilkan</button>
    </div>
  </form>
  <!-- END FILTER -->

  <!-- CARD BULAN & TAHUN (ATAS) -->
  <div class="row-equal">
    <!-- Card Bulan -->
    <div>
      <div class="card p-3 card-gradient text-white rounded shadow w-100 h-100 d-flex flex-column align-items-center justify-content-center">
        <h5><i class="bi bi-calendar2-month"></i> Bulan</h5>
        <h3>
          <?php
            $nama_bulan = [
              1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
              5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
              9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ];
            echo $nama_bulan[(int)$bulanFilter];
          ?>
        </h3>
      </div>
    </div>
    <!-- Card Tahun -->
    <div>
      <div class="card p-3 card-gradient text-white rounded shadow w-100 h-100 d-flex flex-column align-items-center justify-content-center">
        <h5><i class="bi bi-calendar2"></i> Tahun</h5>
        <h3><?= esc($tahunFilter) ?></h3>
      </div>
    </div>
  </div>
  <!-- END CARD BULAN & TAHUN -->

  <!-- CARD BRUTO, PPH BULANAN, GAJI POKOK (BAWAH) -->
  <div class="row-equal row-equal-3">
    <!-- Card Bruto Bulanan -->
    <div>
      <div class="card p-3 card-gradient text-white rounded shadow w-100 h-100 d-flex flex-column align-items-center justify-content-center">
        <h5><i class="bi bi-cash-coin"></i> Bruto Bulanan</h5>
        <h3>Rp <?= number_format($pegawai['bruto_bulanan'], 0, ',', '.') ?></h3>
      </div>
    </div>
    <!-- Card PPH Bruto Bulanan -->
    <div>
      <div class="card p-3 card-gradient text-white rounded shadow w-100 h-100 d-flex flex-column align-items-center justify-content-center">
        <h5><i class="bi bi-percent"></i> PPH Bruto Bulanan</h5>
        <h3>Rp <?= number_format($pegawai['pph_bruto_bulanan'], 0, ',', '.') ?></h3>
      </div>
    </div>
    <!-- Card Gaji Pokok -->
    <div>
      <div class="card p-3 card-gradient text-white rounded shadow w-100 h-100 d-flex flex-column align-items-center justify-content-center">
        <h5><i class="bi bi-wallet2"></i> Gaji Pokok</h5>
        <h3>Rp <?= number_format($pegawai['gaji_pokok'], 0, ',', '.') ?></h3>
      </div>
    </div>
  </div>
  <!-- END CARD BRUTO, PPH BULANAN, GAJI POKOK -->

  <!-- Floating Download Button Kanan Bawah (naik lebih tinggi) -->
  <a href="<?= base_url('/pengguna/export_pdf') ?>" class="btn btn-gradient floating-download" title="Download Laporan Pajak">
    <i class="bi bi-download" style="color:#222;"></i> Download Laporan Pajak
  </a>

  <!-- Toast Notifikasi Baru di Tengah (HANYA MUNCUL JIKA ADA NOTIFIKASI BARU DARI ADMIN) -->
  <?php if (!empty($showToast) && $showToast): ?>
  <div class="toast toast-center align-items-center text-bg-primary border-0"
       id="toastNotifBaru" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        <i class="bi bi-bell-fill"></i>
        <span id="toastNotifText">Sekilas: <?= esc($pesanToast) ?></span>
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto"
              data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
  <?php endif; ?>

  <!-- Modal Notifikasi -->
  <div class="modal fade" id="modalNotifikasi" tabindex="-1" aria-labelledby="modalNotifikasiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="modalNotifikasiLabel"><i class="bi bi-bell" style="color:#222;"></i> Notifikasi Anda</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <?php
            $notifikasiModel = new \App\Models\NotifikasiModel();
            $notifikasi = $notifikasiModel
                ->where('nip', $pegawai['nip'])
                ->orderBy('created_at', 'DESC')
                ->findAll();
          ?>
          <?php if (!empty($notifikasi)): ?>
            <ul class="list-group" id="listNotifikasi">
              <?php foreach ($notifikasi as $notif): ?>
                <li class="list-group-item d-flex justify-content-between align-items-start <?= $notif['dibaca'] ? '' : 'list-group-item-primary' ?>" data-id="<?= $notif['id'] ?>">
                  <div>
                    <div class="fw-bold"><?= esc($notif['pesan']) ?></div>
                    <small class="text-muted"><i class="bi bi-clock" style="color:#222;"></i> <?= date('d M Y H:i', strtotime($notif['created_at'])) ?></small>
                    <?php if (!$notif['dibaca']): ?>
                      <span class="badge badge-gradient ms-2">Baru</span>
                    <?php endif; ?>
                  </div>
                  <button class="btn btn-sm btn-outline-primary btnHapusNotif ms-2" title="Hapus Notifikasi">
                    <i class="bi bi-trash" style="color:#222;"></i>
                  </button>
                </li>
              <?php endforeach ?>
            </ul>
            <button class="btn btn-gradient mt-3 w-100" id="btnTandaiDibaca">
              <i class="bi bi-check2-circle" style="color:#222;"></i> Tandai Telah Dibaca
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
</div>

<!-- Bootstrap Icons & JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Toast notifikasi baru
  var toastEl = document.getElementById('toastNotifBaru');
  if (toastEl) {
    var toast = new bootstrap.Toast(toastEl, { delay: 3500 });
    var audio = document.getElementById('notifSound');
    if (audio) {
      audio.play().catch(function(){});
    }
    toast.show();

    toastEl.addEventListener('hidden.bs.toast', function() {
      var notifBtn = document.getElementById('btnBell');
      if (notifBtn) {
        notifBtn.scrollIntoView({ behavior: 'smooth', block: 'center' });
        notifBtn.classList.add('tarik-animasi');
        if (window.navigator && window.navigator.vibrate) {
          window.navigator.vibrate([100, 50, 100]);
        }
        setTimeout(function() {
          notifBtn.classList.remove('tarik-animasi');
        }, 1000);
      }
    });
  }

  // Event hapus notifikasi
  document.querySelectorAll('.btnHapusNotif').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      var li = btn.closest('li.list-group-item');
      var notifId = li.getAttribute('data-id');

      if (!notifId) {
        alert('ID notifikasi tidak ditemukan');
        return;
      }

      if (!confirm('Anda yakin ingin menghapus notifikasi ini?')) {
        return;
      }

      fetch('<?= base_url('pengguna/hapusNotifikasi') ?>/' + notifId, {
        method: 'DELETE',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Content-Type': 'application/json',
          // Tambahkan token CSRF jika perlu, contoh:
          // 'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.status) {
          // Hapus elemen li dari list
          li.remove();

          // Update badge notifikasi
          var badge = document.getElementById('badgeNotif');
          if (badge) {
            var count = parseInt(badge.textContent);
            count = count > 0 ? count - 1 : 0;
            if (count === 0) {
              badge.remove();
            } else {
              badge.textContent = count;
            }
          }

          // Jika list kosong, tampilkan pesan "Belum ada notifikasi"
          var listNotif = document.getElementById('listNotifikasi');
          if (listNotif && listNotif.children.length === 0) {
            listNotif.innerHTML = '<div class="alert alert-light mb-0">Belum ada notifikasi.</div>';
          }
        } else {
          alert('Gagal menghapus notifikasi: ' + (data.msg || 'Unknown error'));
        }
      })
      .catch(err => {
        console.error(err);
        alert('Terjadi kesalahan saat menghapus notifikasi.');
      });
    });
  });

  // Event tandai sudah dibaca
  var btnTandai = document.getElementById('btnTandaiDibaca');
  if (btnTandai) {
    btnTandai.addEventListener('click', function() {
      fetch('<?= base_url('pengguna/tandaiNotifikasiDibaca') ?>', {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Content-Type': 'application/json',
          // Tambahkan token CSRF jika perlu
        }
      })
      .then(res => res.json())
      .then(data => {
        if(data.status){
          // Update tampilan list notifikasi
          document.querySelectorAll('#listNotifikasi li').forEach(function(item){
            item.classList.remove('list-group-item-primary');
            var badgeBaru = item.querySelector('.badge');
            if(badgeBaru) badgeBaru.remove();
          });
          // Hilangkan badge notifikasi di tombol
          var badge = document.getElementById('badgeNotif');
          if(badge) badge.remove();
          alert('Semua notifikasi telah ditandai sebagai dibaca');
        } else {
          alert('Gagal menandai notifikasi: ' + (data.msg || 'Unknown error'));
        }
      })
      .catch(err=>{
        console.error(err);
        alert('Terjadi kesalahan saat menandai notifikasi.');
      });
    });
  }
});
</script>


<?= $this->endSection() ?>
