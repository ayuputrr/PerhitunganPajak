<!DOCTYPE html>
<html>
<head>
  <title>Edit Data Pegawai</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-warning text-white">
      <h4 class="mb-0">Edit Data Pegawai</h4>
    </div>
    <div class="card-body">
      <form action="/pegawai/update/<?= $pegawai['id'] ?>" method="post" class="row g-3">

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

        <div class="col-12">
          <button type="submit" class="btn btn-success">Update</button>
          <a href="/pegawai" class="btn btn-secondary">Kembali</a>
        </div>

      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
