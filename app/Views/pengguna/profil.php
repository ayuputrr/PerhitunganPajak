<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<style>
  .profil-card {
    background: linear-gradient(120deg, #f4f8fb 80%, #e3f0fa 100%);
    border-radius: 22px;
    box-shadow: 0 8px 32px 0 #2F80ED22;
    padding: 2.4rem 2rem 2rem 2rem;
    max-width: 480px;
    margin: 0 auto 2rem auto;
    border: none;
    position: relative;
  }
  .profil-avatar {
    width: 110px;
    height: 110px;
    object-fit: cover;
    border-radius: 50%;
    border: 5px solid #fff;
    box-shadow: 0 0 24px 0 #2F80ED33, 0 0 0 10px #e3f0fa inset;
    margin-bottom: 1.2rem;
    background: #f4f8fb;
    transition: 0.2s;
  }
  .profil-avatar:hover {
    transform: scale(1.04) rotate(-2deg);
    box-shadow: 0 8px 42px 0 #56CCF255, 0 0 0 10px #e3f0fa inset;
  }
  .profil-nama {
    font-size: 1.25rem;
    font-weight: 700;
    color: #2F80ED;
    margin-bottom: 0.2rem;
    letter-spacing: 0.5px;
  }
  .profil-nip-badge {
    display: inline-block;
    background: linear-gradient(90deg, #56CCF2 0%, #2F80ED 100%);
    color: #fff;
    font-size: 1.04rem;
    font-weight: 600;
    border-radius: 20px;
    padding: 0.3rem 1.2rem;
    letter-spacing: 1.1px;
    margin-bottom: 1rem;
    box-shadow: 0 2px 8px #56CCF233;
  }
  .profil-info-list {
    text-align: left;
    margin: 0 auto 1.5rem auto;
    max-width: 350px;
  }
  .profil-info-label {
    color: #888;
    font-size: 0.98rem;
    font-weight: 600;
    margin-bottom: 0.1rem;
    letter-spacing: 0.2px;
  }
  .profil-info-value {
    font-size: 1.09rem;
    font-weight: 500;
    color: #222;
    margin-bottom: 0.8rem;
    border-bottom: 1px dashed #e3e3e3;
    padding-bottom: 0.2rem;
  }
  .btn-edit-profil {
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
  .btn-edit-profil:hover, .btn-edit-profil:focus {
    background: linear-gradient(90deg, #56CCF2 0%, #2F80ED 100%);
    color: #fff;
    transform: translateY(-2px) scale(1.04);
    box-shadow: 0 8px 36px 0 #56CCF2cc;
    text-decoration: none;
  }
  @media (max-width: 600px) {
    .profil-card {
      padding: 1.2rem 0.7rem 1rem 0.7rem;
    }
    .profil-avatar {
      width: 70px;
      height: 70px;
    }
    .profil-info-list {
      max-width: 100%;
    }
  }
</style>

<div class="container py-4">
  <div class="profil-card text-center">
    <img
      src="<?= !empty($pengguna['foto']) ? base_url('uploads/foto/' . $pengguna['foto']) : base_url('default-avatar.png') ?>"
      alt="Foto Profil"
      class="profil-avatar mb-2"
    >
    <div class="profil-nama"><?= esc($pengguna['nama']) ?></div>
    <div class="profil-nip-badge"><?= esc($pengguna['nip']) ?></div>
    <div class="profil-info-list">
      <div>
        <div class="profil-info-label">Jabatan</div>
        <div class="profil-info-value"><?= esc($pengguna['jabatan'] ?? '-') ?></div>
      </div>
      <div>
        <div class="profil-info-label">Status</div>
        <div class="profil-info-value"><?= esc($pengguna['status'] ?? '-') ?></div>
      </div>
      <div>
        <div class="profil-info-label">Alamat</div>
        <div class="profil-info-value"><?= esc($pengguna['alamat'] ?? '-') ?></div>
      </div>
      <div>
        <div class="profil-info-label">Telepon</div>
        <div class="profil-info-value"><?= esc($pengguna['telepon'] ?? '-') ?></div>
      </div>
    </div>
    <a href="<?= base_url('/pengguna/edit_profil') ?>" class="btn btn-edit-profil mt-3">
      <i class="bi bi-pencil-square me-1"></i> Edit Profil
    </a>
  </div>
  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success text-center"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>
  <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger text-center"><?= session()->getFlashdata('error') ?></div>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>
