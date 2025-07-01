<!DOCTYPE html>
<html>
<head>
  <title>Form Tambah Pegawai</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Form Tambah Pegawai</h4>
    </div>
    <div class="card-body">
      <form action="/pegawai/store" method="post" class="row g-3">

        <div class="col-md-6">
          <label class="form-label">Nama</label>
          <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">NIP</label>
          <input type="text" name="nip" class="form-control" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Status</label>
          <select name="status" class="form-select" required>
            <option value="">-- Pilih Status --</option>
            <option>TK/0</option><option>TK/1</option><option>K/0</option><option>HB/0</option>
            <option>HB/1</option><option>TK/2</option><option>TK/3</option><option>K/1</option>
            <option>K/2</option><option>HB/2</option><option>HB/3</option>
          </select>
        </div>

        <div class="col-md-6">
          <label class="form-label">Gaji Pokok</label>
          <input type="number" name="gaji_pokok" class="form-control" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Tunjangan Suami/Istri</label>
          <input type="number" name="tunj_suami_istri" class="form-control">
        </div>

        <div class="col-md-6">
          <label class="form-label">Tunjangan Anak</label>
          <input type="number" name="tunj_anak" class="form-control">
        </div>

        <div class="col-md-6">
          <label class="form-label">Tunjangan Jabatan</label>
          <input type="number" name="tunj_jabatan" class="form-control">
        </div>

        <div class="col-md-6">
          <label class="form-label">Tunjangan Beras</label>
          <input type="number" name="tunj_beras" class="form-control">
        </div>

        <div class="col-md-6">
          <label class="form-label">Tunjangan Lain</label>
          <input type="number" name="tunj_lain" class="form-control">
        </div>

        <div class="col-md-6">
          <label class="form-label">Iuran Pensiun</label>
          <input type="number" name="iuran_pensiun" class="form-control">
        </div>

        <div class="col-md-6">
          <label class="form-label">TPP</label>
          <input type="number" name="tpp" class="form-control">
        </div>

        <div class="col-md-6">
          <label class="form-label">Gaji THR</label>
          <input type="number" name="thr_gaji" class="form-control">
        </div>

        <div class="col-md-6">
          <label class="form-label">TPP THR</label>
          <input type="number" name="thr_tpp" class="form-control">
        </div>

        <div class="col-md-6">
          <label class="form-label">Gaji 13</label>
          <input type="number" name="gaji13" class="form-control">
        </div>

        <div class="col-md-6">
          <label class="form-label">TPP 13</label>
          <input type="number" name="tpp13" class="form-control">
        </div>

        <div class="col-12">
          <button type="submit" class="btn btn-success">Simpan</button>
          <a href="/pegawai" class="btn btn-secondary">Kembali</a>
        </div>

      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

