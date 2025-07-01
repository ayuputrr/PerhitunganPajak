<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
  <h3 class="mb-4">🔍 Cek Pajak Pegawai</h3>

  <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
  <?php endif ?>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif ?>

  <form method="post" action="/pengguna/lihat">
    <div class="mb-3">
      <label for="nip" class="form-label">Masukkan NIP</label>
      <input type="text" name="nip" id="nip" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Lihat Pajak</button>
  </form>
</div>

<?= $this->endSection() ?>
