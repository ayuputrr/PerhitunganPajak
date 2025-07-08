<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
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
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="Aktif" <?= old('status', $pengguna['status']) == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                <option value="Non-Aktif" <?= old('status', $pengguna['status']) == 'Non-Aktif' ? 'selected' : '' ?>>Non-Aktif</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Profil</label><br>
            <?php if (!empty($pengguna['foto'])): ?>
                <img src="<?= base_url('uploads/foto/' . $pengguna['foto']) ?>" width="100" class="mb-2">
            <?php endif; ?>
            <input type="file" name="foto" id="foto" class="form-control">
        </div>

        <hr>
        <h5>Ganti Password (Opsional)</h5>

        <div class="mb-3">
            <label for="password_lama" class="form-label">Password Lama</label>
            <div class="input-group">
                <input type="password" name="password_lama" id="password_lama" class="form-control">
                <span class="input-group-text toggle-password" data-target="password_lama" style="cursor: pointer;">
                    <i class="bi bi-eye-slash"></i>
                </span>
            </div>
        </div>

        <div class="mb-3">
            <label for="password_baru" class="form-label">Password Baru</label>
            <div class="input-group">
                <input type="password" name="password_baru" id="password_baru" class="form-control">
                <span class="input-group-text toggle-password" data-target="password_baru" style="cursor: pointer;">
                    <i class="bi bi-eye-slash"></i>
                </span>
            </div>
        </div>

        <div class="mb-3">
            <label for="konfirmasi_password" class="form-label">Konfirmasi Password Baru</label>
            <div class="input-group">
                <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="form-control">
                <span class="input-group-text toggle-password" data-target="konfirmasi_password" style="cursor: pointer;">
                    <i class="bi bi-eye-slash"></i>
                </span>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="<?= base_url('/pengguna/profil') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>

<!-- Toggle password -->
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
