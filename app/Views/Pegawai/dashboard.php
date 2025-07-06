<?= $this->extend('dashboard/layout') ?>
<?= $this->section('content') ?>

<style>
  .card-stat {
    background: linear-gradient(135deg, #2F80ED, #56CCF2);
    color: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 12px  #56CCF2;
    padding: 20px;
    transition: 0.3s;
  }
  .card-stat:hover {
    transform: scale(1.02);
  }
  .chart-container, .info-section {
    background: #fff;
    border-radius: 12px;
    padding: 15px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  }
</style>

<div class="container-fluid px-7 py-5">
    <!-- POP UP NOTIFIKASI -->
  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-4" style="z-index:9999; min-width:300px;" role="alert" id="popupSuccess">
      <?= session()->getFlashdata('success') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
  <?php endif; ?>
  <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-4" style="z-index:9999; min-width:300px;" role="alert" id="popupError">
      <?= session()->getFlashdata('error') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
  <?php endif; ?>
  <!-- END POP UP NOTIFIKASI -->

  <h2 class="fw-bold text-dark mb-4" ><i class="bi bi-speedometer2 text-primary me-2 "></i> Dashboard Data Pegawai</h2>
  <div class="row g-4 mb-4">
    <div class="col-md-3">
      <div class="card-stat text-center">
        <h5 class="mb-2">Total Pegawai</h5>
        <h3><?= count($pegawai) ?></h3>
        <small class="text-light">Data yang terdaftar</small>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card-stat text-center">
        <h5 class="mb-2">Gaji Bruto Total</h5>
        <h3>Rp <?= number_format(array_sum(array_column($pegawai, 'bruto_bulanan'))) ?></h3>
        <small class="text-light">Bulanan</small>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card-stat text-center">
        <h5 class="mb-2">PPH Bruto Total</h5>
        <h3>Rp <?= number_format(array_sum(array_column($pegawai, 'pph_bruto_bulanan'))) ?></h3>
        <small class="text-light">Bulanan</small>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card-stat text-center">
        <h5 class="mb-2">PPH + TPP Total</h5>
        <h3>Rp <?= number_format(array_sum(array_column($pegawai, 'pph_bruto_tpp_bulanan'))) ?></h3>
        <small class="text-light">Bulanan</small>
      </div>
    </div>
  </div>

  <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 mb-3">
    <form class="d-flex" method="get" action="">
      <input type="text" name="search" class="form-control me-2" placeholder="Cari nama pegawai..." value="<?= esc($search ?? '') ?>">
      <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
    </form>
    <div class="d-flex gap-2">
      <a href="/pegawai/create" class="btn btn-outline-primary">
        <i class="bi bi-plus-circle"></i> Tambah Pegawai
      </a>
      <a href="/pegawai/export_excel_all" class="btn btn-success mb-3">
        <i class="bi bi-file-earmark-excel-fill"></i> Export Semua Data 
      </a>
    </div>
  </div>

  <!-- Informasi Ringkas Tambahan -->
  <!-- ... bagian info ringkas dan deadline tetap seperti kode Anda ... -->

  <!-- Riwayat Notifikasi -->
  <?php if (!empty($notifikasi_terkirim)): ?>
  <div class="mb-4">
    <div class="card shadow-sm border-0">
      <div class="card-body">
        <h5 class="fw-semibold mb-3 text-primary"><i class="bi bi-bell-fill me-2"></i>Riwayat Notifikasi yang Dikirim</h5>
        <ul class="list-group list-group-flush">
          <?php foreach ($notifikasi_terkirim as $notif): ?>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div>
                <div class="fw-bold"><?= esc($notif['pesan']) ?></div>
                <small class="text-muted">NIP: <?= esc($notif['nip']) ?> | <?= date('d M Y H:i', strtotime($notif['created_at'])) ?></small>
              </div>
              <span class="badge bg-success">Terkirim</span>
            </li>
          <?php endforeach ?>
        </ul>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <!-- Tabel Data Pegawai -->
  <div class="card shadow-sm border-0 chart-container mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle mb-0">
          <thead class="table text-center">
            <tr>
              <th scope="col">NIP</th>
              <th scope="col">Nama</th>
              <th scope="col">Status</th>
              <th scope="col">Gaji Bruto</th>
              <th scope="col">PPH Bruto</th>
              <th scope="col">PPH Bruto + TPP</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($pegawai as $row): ?>
              <tr>
                <td class="text-nowrap"><?= $row['nip'] ?></td>
                <td class="text-capitalize"><?= $row['nama'] ?></td>
                <td><?= $row['status'] ?></td>
                <td class="text-end"><?= number_format($row['bruto_bulanan']) ?></td>
                <td class="text-end"><?= number_format($row['pph_bruto_bulanan']) ?></td>
                <td class="text-end"><?= number_format($row['pph_bruto_tpp_bulanan']) ?></td>
                <td class="text-center">
                  <a href="/pegawai/edit/<?= $row['id'] ?>" class="btn btn-sm btn-secondary mb-1">
                    <i class="bi bi-pencil-square"></i> Edit
                  </a>
                  <a href="/pegawai/hitung/<?= $row['id'] ?>" class="btn btn-sm btn-warning mb-1">
                    <i class="bi bi-calculator"></i> Hitung
                  </a>
                  <a href="/pegawai/detail/<?= $row['id'] ?>" class="btn btn-sm btn-info mb-1">
                    <i class="bi bi-file-earmark-text"></i> Detail
                  </a>
                  <form action="/pegawai/kirimnotifikasi/" method="post" style="display:inline;">
                  <?= csrf_field() ?>
                     <input type="hidden" name="nip" value="<?= $row['nip'] ?>">
                     <input type="hidden" name="bulan" value="<?= $row['bulan'] ?>">
                      <input type="hidden" name="tahun" value="<?= $row['tahun'] ?>">
                   <button type="submit" class="btn btn-sm btn-danger ms-2" onclick="return confirm('Kirim notifikasi ke pengguna ini?')">
                     <i class="bi bi-bell-fill"></i> Kirim Notifikasi
                    </button>
                  </form>

                  <!-- END FORM -->
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
