<!DOCTYPE html>
<html>
<head>
  <title>Form Tambah Pegawai</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
      min-height: 100vh;
    }
    .card {
      border-radius: 1.2rem;
      overflow: hidden;
      margin-bottom: 2rem;
    }
    .card-header {
      background: linear-gradient(90deg, #007bff 70%, #00c6ff 100%);
      text-align: center;
      padding: 2rem 1rem 1rem 1rem;
    }
    .avatar {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      margin: -60px auto 10px auto;
      display: block;
      border: 4px solid #fff;
      background: #e6f0fa;
      object-fit: cover;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .form-label {
      font-weight: 500;
      color: #0d6efd;
    }
    .form-control, .form-select {
      border-radius: 0.5rem;
    }
    .btn-success {
      background: linear-gradient(90deg, #28a745 70%, #43e97b 100%);
      border: none;
      font-weight: bold;
      transition: background 0.3s;
    }
    .btn-success:hover {
      background: linear-gradient(90deg, #43e97b 70%, #38f9d7 100%);
    }
    .btn-secondary {
      border-radius: 0.5rem;
    }
    @media (max-width: 768px) {
      .card {
        margin-top: 2rem;
      }
    }
  </style>
</head>
<body>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10">
        <div class="card shadow-lg">
          <div class="card-header position-relative">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Avatar Pegawai" class="avatar shadow">
            <h4 class="mb-0 mt-2 text-white">Form Tambah Pegawai</h4>
            <p class="text-light mb-0" style="font-size: 0.95rem;">Isi data pegawai dengan lengkap dan benar.</p>
          </div>
          <div class="card-body">
            <form action="/pegawai/store" method="post" class="row g-4">
              <div class="col-12 col-md-6">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" required placeholder="Masukkan nama lengkap">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">NIP</label>
                <input type="text" name="nip" class="form-control" required placeholder="Nomor Induk Pegawai">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                  <option value="">-- Pilih Status --</option>
                  <option>TK/0</option><option>TK/1</option><option>K/0</option><option>HB/0</option>
                  <option>HB/1</option><option>TK/2</option><option>TK/3</option><option>K/1</option>
                  <option>K/2</option><option>HB/2</option><option>HB/3</option>
                </select>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Gaji Pokok</label>
                <input type="number" name="gaji_pokok" class="form-control" required placeholder="Rp.">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Tunjangan Suami/Istri</label>
                <input type="number" name="tunj_suami_istri" class="form-control" placeholder="Rp.">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Tunjangan Anak</label>
                <input type="number" name="tunj_anak" class="form-control" placeholder="Rp.">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Tunjangan Jabatan</label>
                <input type="number" name="tunj_jabatan" class="form-control" placeholder="Rp.">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Tunjangan Beras</label>
                <input type="number" name="tunj_beras" class="form-control" placeholder="Rp.">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Tunjangan Lain</label>
                <input type="number" name="tunj_lain" class="form-control" placeholder="Rp.">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Iuran Pensiun</label>
                <input type="number" name="iuran_pensiun" class="form-control" placeholder="Rp.">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">TPP</label>
                <input type="number" name="tpp" class="form-control" placeholder="Rp.">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Gaji THR</label>
                <input type="number" name="thr_gaji" class="form-control" placeholder="Rp.">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">TPP THR</label>
                <input type="number" name="thr_tpp" class="form-control" placeholder="Rp.">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Gaji 13</label>
                <input type="number" name="gaji13" class="form-control" placeholder="Rp.">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">TPP 13</label>
                <input type="number" name="tpp13" class="form-control" placeholder="Rp.">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Tahun</label>
                <input type="number" name="tahun" class="form-control" required placeholder="Contoh: 2025">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Bulan</label>
                <select name="bulan" class="form-select" required>
                  <option value="">-- Pilih Bulan --</option>
                  <?php
                    $bulanList = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                    foreach ($bulanList as $i => $namaBulan) {
                      echo "<option value='".($i+1)."'>$namaBulan</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="col-12 text-end mt-3">
                <button type="submit" class="btn btn-success px-4">Simpan</button>
                <a href="/pegawai" class="btn btn-secondary ms-2 px-4">Kembali</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
