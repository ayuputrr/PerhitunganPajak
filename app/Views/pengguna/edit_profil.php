<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<style>
  .edit-profil-card {
    background: linear-gradient(120deg, #f4f8fb 82%, #e3f0fa 100%);
    border-radius: 22px;
    box-shadow: 0 8px 32px 0 #2F80ED22;
    padding: 2.2rem 2rem 1.7rem 2rem;
    max-width: 500px;
    margin: 0 auto 2rem auto;
    border: none;
    position: relative;
  }
  .edit-profil-avatar {
    width: 95px;
    height: 95px;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid #fff;
    box-shadow: 0 0 24px 0 #2F80ED33, 0 0 0 8px #e3f0fa inset;
    margin-bottom: 1.1rem;
    background: #f4f8fb;
    transition: 0.2s;
    display: block;
    margin-left: auto;
    margin-right: auto;
  }
  .edit-profil-label {
    font-weight: 600;
    color: #2F80ED;
    margin-bottom: 0.2rem;
    font-size: 1.03rem;
  }
  .edit-profil-nip {
    background: #f4f8fb;
    border-radius: 8px;
    padding: 0.5rem 1rem;
    font-size: 1.08rem;
    color: #444;
    font-weight: 600;
    letter-spacing: 1px;
    margin-bottom: 1.1rem;
    display: inline-block;
    border: none;
    pointer-events: none;
  }
  .btn-simpan {
    background: linear-gradient(90deg, #2F80ED 0%, #56CCF2 100%);
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
    margin-top: 1.2rem;
    display: inline-block;
  }
  .btn-simpan:hover, .btn-simpan:focus {
    background: linear-gradient(90deg, #56CCF2 0%, #2F80ED 100%);
    color: #fff;
    transform: translateY(-2px) scale(1.04);
    box-shadow: 0 8px 36px 0 #56CCF2cc;
    text-decoration: none;
  }
  .btn-batal {
    border-radius: 1.5rem;
    font-weight: 700;
    margin-top: 0.7rem;
  }
  @media (max-width: 600px) {
    .edit-profil-card {
      padding: 1.2rem 0.7rem 1rem 0.7rem;
    }
    .edit-profil-avatar {
      width: 62px;
      height: 62px;
    }
  }
</style>

<div class="container py-4">
  <div class="edit-profil-card">
    <h4 class="mb-3 text-primary fw-bold text-center"><i class="bi bi-person-lines-fill me-2"></i>Edit Profil Pengguna</h4>
    <?php if (session()->getFlashdata('errors')): ?>
      <div class="alert alert-danger">
        <?php foreach (session()->getFlashdata('errors') as $err): ?>
          <div><?= $err ?></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php
    $nama    = isset($pengguna['nama']) ? esc($pengguna['nama']) : '';
    $nip     = isset($pengguna['nip']) ? esc($pengguna['nip']) : '';
    $foto    = isset($pengguna['foto']) ? $pengguna['foto'] : '';
    $jabatan = isset($pengguna['jabatan']) ? esc($pengguna['jabatan']) : '';
    $alamat  = isset($pengguna['alamat']) ? esc($pengguna['alamat']) : '';
    $telepon = isset($pengguna['telepon']) ? esc($pengguna['telepon']) : '';
    $status  = isset($pengguna['status']) ? esc($pengguna['status']) : '';
    ?>

    <form method="post" action="<?= base_url('/pengguna/update_profil') ?>" enctype="multipart/form-data">
      <div class="text-center mb-3">
        <img src="<?= !empty($foto) ? base_url('uploads/foto/' . $foto) : base_url('default-avatar.png') ?>"
             alt="Foto Profil"
             class="edit-profil-avatar"
             id="previewFoto">
      </div>
      <div class="mb-3">
        <label class="form-label edit-profil-label">NIP</label>
        <input type="text" name="nip" class="form-control edit-profil-nip" value="<?= $nip ?>" readonly tabindex="-1" style="background:#f4f8fb; pointer-events:none;">
      </div>
      <div class="mb-3">
        <label class="form-label edit-profil-label">Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" value="<?= $nama ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label edit-profil-label">Jabatan</label>
        <input type="text" name="jabatan" class="form-control" value="<?= $jabatan ?>">
      </div>
      <div class="mb-3">
        <label class="form-label edit-profil-label">Alamat</label>
        <input type="text" name="alamat" class="form-control" value="<?= $alamat ?>">
      </div>
      <div class="mb-3">
        <label class="form-label edit-profil-label">Telepon</label>
        <input type="text" name="telepon" class="form-control" value="<?= $telepon ?>">
      </div>
      <div class="mb-3">
        <label class="form-label edit-profil-label">Status</label>
        <select name="status" class="form-select" required>
          <option value="">Pilih Status</option>
          <option value="Aktif" <?= $status === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
          <option value="Tidak Aktif" <?= $status === 'Tidak Aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
          <option value="Pensiun" <?= $status === 'Pensiun' ? 'selected' : '' ?>>Pensiun</option>
        </select>
      </div>
      <hr class="my-4">
      <div class="mb-3">
        <label class="form-label edit-profil-label text-danger"><i class="bi bi-key me-1"></i>Password Lama</label>
        <input type="password" name="password_lama" class="form-control" autocomplete="current-password">
      </div>
      <div class="mb-3">
        <label class="form-label edit-profil-label text-danger">Password Baru</label>
        <input type="password" name="password_baru" class="form-control" autocomplete="new-password">
      </div>
      <div class="mb-3">
        <label class="form-label edit-profil-label text-danger">Konfirmasi Password Baru</label>
        <input type="password" name="konfirmasi_password" class="form-control" autocomplete="new-password">
      </div>
      <div class="small text-muted mb-3">* Kosongkan bagian password jika tidak ingin mengubah password.</div>
      <div class="mb-3">
        <label class="form-label edit-profil-label">Foto Profil</label>
        <input type="file" name="foto" class="form-control" accept="image/*" onchange="previewFotoProfil(event)">
      </div>
      <button type="submit" class="btn btn-simpan w-100 fw-bold">Simpan Perubahan</button>
      <a href="<?= base_url('/pengguna/profil') ?>" class="btn btn-secondary btn-batal w-100 fw-bold mt-2">Batal</a>
    </form>
  </div>
</div>

<script>
function previewFotoProfil(event) {
  const [file] = event.target.files;
  if (file) {
    document.getElementById('previewFoto').src = URL.createObjectURL(file);
  }
}
</script>

<?= $this->endSection() ?>
