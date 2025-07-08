<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Data Pegawai</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f7f9fc;
      font-family: 'Segoe UI', sans-serif;
    }
    .modern-card {
      border-radius: 18px;
      background: #fff;
      box-shadow: 0 10px 32px rgba(0, 0, 0, 0.08);
      padding: 2.5rem;
      margin-top: 3rem;
    }
    .modern-header {
      font-size: 1.6rem;
      font-weight: 700;
      color: #2f80ed;
      margin-bottom: 1.8rem;
      text-align: center;
    }
    .form-label {
      font-weight: 600;
      color: #333;
    }
    .form-control, .form-select {
      border-radius: 12px;
      padding: 0.75rem;
      font-size: 0.95rem;
    }
    .btn-modern {
      border-radius: 30px;
      padding: 0.7rem 2rem;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.2s ease;
    }
    .btn-modern-primary {
      background: linear-gradient(90deg, #2f80ed, #56ccf2);
      color: white;
      border: none;
    }
    .btn-modern-primary:hover {
      background: linear-gradient(90deg, #56ccf2, #2f80ed);
      transform: scale(1.02);
    }
    .btn-modern-secondary {
      background-color: #e0e0e0;
      color: #333;
    }
    .btn-modern-secondary:hover {
      background-color: #cacaca;
      transform: scale(1.01);
    }
    @media (max-width: 768px) {
      .modern-card {
        padding: 1.5rem;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <div class="modern-card mx-auto" style="max-width: 960px;">
    <div class="modern-header">Edit Data Pegawai</div>

    <form action="/pegawai/update/<?= $pegawai['id'] ?>" method="post" class="row g-4">

      <div class="col-md-6">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" value="<?= $pegawai['nama'] ?>" required>
      </div>

      <div class="col-md-6">
        <label class="form-label">NIP</label>
        <input type="text" name="nip" class="form-control" value="<?= $pegawai['nip'] ?>" required>
      </div>

      <div class="col-md-6">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
          <option value="">-- Pilih Status --</option>
          <?php
            $statusList = ['TK/0','TK/1','K/0','HB/0','HB/1','TK/2','TK/3','K/1','K/2','HB/2','HB/3'];
            foreach ($statusList as $st) {
              $selected = ($pegawai['status'] == $st) ? 'selected' : '';
              echo "<option value=\"$st\" $selected>$st</option>";
            }
          ?>
        </select>
      </div>

      <?php
      $fields = [
        'gaji_pokok', 'tunj_suami_istri', 'tunj_anak', 'tunj_jabatan', 'tunj_beras',
        'tunj_lain', 'iuran_pensiun', 'tpp', 'thr_gaji', 'thr_tpp', 'gaji13', 'tpp13'
      ];
      foreach ($fields as $f):
      ?>
      <div class="col-md-6">
        <label class="form-label"><?= ucwords(str_replace('_', ' ', $f)) ?></label>
        <input type="number" name="<?= $f ?>" class="form-control" value="<?= $pegawai[$f] ?>">
      </div>
      <?php endforeach; ?>

      <div class="col-md-6">
        <label class="form-label">Tahun</label>
        <input type="number" name="tahun" class="form-control" value="<?= $pegawai['tahun'] ?>" required>
      </div>

      <div class="col-md-6">
        <label class="form-label">Bulan</label>
        <select name="bulan" class="form-select" required>
          <option value="">-- Pilih Bulan --</option>
          <?php
            $bulanList = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            foreach ($bulanList as $i => $namaBulan) {
              $selected = ($pegawai['bulan'] == $i+1) ? 'selected' : '';
              echo "<option value='".($i+1)."' $selected>$namaBulan</option>";
            }
          ?>
        </select>
      </div>

      <div class="col-12 d-flex justify-content-between mt-3">
        <a href="/pegawai" class="btn btn-modern btn-modern-secondary">← Kembali</a>
        <button type="submit" class="btn btn-modern btn-modern-primary">Simpan Perubahan</button>
      </div>

    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
