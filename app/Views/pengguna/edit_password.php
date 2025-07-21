<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<style>
  .edit-password-card {
    background: linear-gradient(120deg, #f4f8fb 80%, #e3f0fa 100%);
    border-radius: 22px;
    box-shadow: 0 8px 32px 0 #2F80ED22;
    padding: 2.2rem 2rem 1.7rem 2rem;
    max-width: 440px;
    margin: 0 auto 2rem auto;
    border: none;
    position: relative;
  }
  .edit-password-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.2rem;
  }
  .edit-password-icon i {
    font-size: 2.4rem;
    color: #e63946;
    background: #fff;
    border-radius: 50%;
    padding: 0.7rem;
    box-shadow: 0 2px 16px #e6394633;
  }
  .edit-password-title {
    font-size: 1.35rem;
    font-weight: 700;
    color: #e63946;
    letter-spacing: 1.1px;
    margin-bottom: 0.7rem;
    text-align: center;
  }
  .form-label {
    font-weight: 600;
    color: #2F80ED;
    margin-bottom: 0.2rem;
    font-size: 1.03rem;
  }
  .form-control:focus {
    border-color: #2F80ED;
    box-shadow: 0 0 0 2px #56CCF244;
  }
  .btn-ubah-password {
    background: linear-gradient(90deg, #e63946 0%, #ff7675 100%);
    color: #fff;
    font-weight: 700;
    border: none;
    border-radius: 1.5rem;
    padding: 0.85rem 2.2rem;
    font-size: 1.08rem;
    box-shadow: 0 4px 18px 0 #e6394633;
    letter-spacing: 1.2px;
    text-shadow: 0 1px 8px #e6394633;
    transition: 0.18s;
    margin-top: 1.2rem;
    display: inline-block;
  }
  .btn-ubah-password:hover, .btn-ubah-password:focus {
    background: linear-gradient(90deg, #ff7675 0%, #e63946 100%);
    color: #fff;
    transform: translateY(-2px) scale(1.04);
    box-shadow: 0 8px 36px 0 #e63946cc;
    text-decoration: none;
  }
  @media (max-width: 600px) {
    .edit-password-card {
      padding: 1.2rem 0.7rem 1rem 0.7rem;
      max-width: 100%;
    }
    .edit-password-icon i {
      font-size: 2rem;
      padding: 0.5rem;
    }
  }
</style>

<div class="container py-4">
  <div class="edit-password-card">
    <div class="edit-password-icon">
      <i class="bi bi-key"></i>
    </div>
    <div class="edit-password-title">Edit Password</div>
    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success text-center"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger text-center"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('errors')): ?>
      <div class="alert alert-danger">
        <?php foreach (session()->getFlashdata('errors') as $err): ?>
          <div><?= $err ?></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    <form method="post" action="<?= base_url('/pengguna/update_password') ?>">
      <div class="mb-3">
        <label class="form-label">Password Lama</label>
        <input type="password" name="password_lama" class="form-control" required autocomplete="current-password">
      </div>
      <div class="mb-3">
        <label class="form-label">Password Baru</label>
        <input type="password" name="password_baru" class="form-control" required autocomplete="new-password">
      </div>
      <div class="mb-3">
        <label class="form-label">Konfirmasi Password Baru</label>
        <input type="password" name="konfirmasi_password" class="form-control" required autocomplete="new-password">
      </div>
      <button type="submit" class="btn btn-ubah-password w-100 fw-bold">Ubah Password</button>
    </form>
  </div>
</div>

<?= $this->endSection() ?>
