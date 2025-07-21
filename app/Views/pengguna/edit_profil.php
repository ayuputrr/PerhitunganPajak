<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
.odoo-profile-card {
  background: linear-gradient(100deg, #f4f8fb 85%, #e3f0fa 100%);
  max-width: 485px;
  margin: 28px auto 0 auto;
  border-radius: 19px;
  padding: 2.3rem 2.1rem 2rem 2.1rem;
  box-shadow: 0 4px 22px #2F80ED15;
  border: none;
}
.odoo-profile-card h2 {
  font-size: 1.3rem;
  font-weight: bold;
  color: #2F80ED;
  letter-spacing: .4px;
  margin-bottom: .8rem;
}
.odoo-profile-card .form-label { font-weight:600; color: #2656a3; }
.odoo-profile-card .form-control:focus { border-color:#2F80ED; box-shadow: 0 2px 14px #2F80ED22; }
.odoo-profile-card .input-group-text { background:#f4f9fe; border-color:#d1e1fa; cursor:pointer; }
.odoo-profile-card .btn-primary {
  background: linear-gradient(93deg, #2F80ED 65%, #5cccf6 100%);
  border: none; font-weight: 600;
}
.odoo-profile-card .btn-secondary { background:#dfe6f8; color:#2F80ED; font-weight:600; border:none; }
.odoo-profile-card .alert { border-radius: 8px; font-size: 0.99rem; }
.odoo-photo-preview {
  width: 84px; height: 84px; object-fit:cover;
  border-radius: 50%; border: 3px solid #2F80ED; box-shadow: 0 2px 7px #2F80ED10;
  margin-bottom:.9rem;
  background: #fff;
}
@media(max-width:550px) {
  .odoo-profile-card {max-width:98vw;padding:1.2rem 0.8rem;}
}
</style>

<div class="odoo-profile-card">
    <h2>Edit Profil</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <?php foreach (session('errors') as $err): ?>
                <div><?= $err ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('/pengguna/updateProfil') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="mb-3 text-center">
            <?php if (!empty($pengguna['foto'])): ?>
                <img src="<?= base_url('uploads/foto/' . $pengguna['foto']) ?>" class="odoo-photo-preview" alt="Foto Profil">
                <br>
            <?php endif; ?>
            <label for="foto" class="form-label d-block">Foto Profil</label>
            <input type="file" name="foto" id="foto" class="form-control" style="margin-top:5px;">
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="<?= old('nama', $pengguna['nama']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan</label>
            <input type="text" name="jabatan" id="jabatan" class="form-control" value="<?= old('jabatan', $pengguna['jabatan']) ?>">
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control"><?= old('alamat', $pengguna['alamat']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="text" name="telepon" id="telepon" class="form-control" value="<?= old('telepon', $pengguna['telepon']) ?>">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Aktif (untuk Notifikasi)</label>
            <input type="email" name="email" id="email" class="form-control"
                   value="<?= old('email', $pengguna['email'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="Aktif" <?= old('status', $pengguna['status']) == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                <option value="Non-Aktif" <?= old('status', $pengguna['status']) == 'Non-Aktif' ? 'selected' : '' ?>>Non-Aktif</option>
            </select>
        </div>

        <hr class="mt-3 mb-3">
        <h5 class="mb-3" style="color:#2656A3;font-weight:600;">Ganti Password <small class="text-muted">(Opsional)</small></h5>

        <div class="mb-3">
            <label for="password_lama" class="form-label">Password Lama</label>
            <div class="input-group">
                <input type="password" name="password_lama" id="password_lama" class="form-control">
                <span class="input-group-text toggle-password" data-target="password_lama">
                    <i class="bi bi-eye-slash"></i>
                </span>
            </div>
        </div>

        <div class="mb-3">
            <label for="password_baru" class="form-label">Password Baru</label>
            <div class="input-group">
                <input type="password" name="password_baru" id="password_baru" class="form-control">
                <span class="input-group-text toggle-password" data-target="password_baru">
                    <i class="bi bi-eye-slash"></i>
                </span>
            </div>
        </div>

        <div class="mb-3">
            <label for="konfirmasi_password" class="form-label">Konfirmasi Password Baru</label>
            <div class="input-group">
                <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="form-control">
                <span class="input-group-text toggle-password" data-target="konfirmasi_password">
                    <i class="bi bi-eye-slash"></i>
                </span>
            </div>
        </div>

        <div class="d-flex gap-2 mt-3">
          <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save2"></i> Simpan Perubahan</button>
          <a href="<?= base_url('/pengguna/profil') ?>" class="btn btn-secondary px-4">Batal</a>
        </div>
    </form>
</div>

<script>
  document.querySelectorAll('.toggle-password').forEach(function (el) {
    el.addEventListener('click', function () {
      const target = document.getElementById(this.dataset.target);
      const icon = this.querySelector('i');
      if (target.type === 'password') {
        target.type = 'text';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
      } else {
        target.type = 'password';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
      }
    });
  });
</script>

<?= $this->endSection() ?>
