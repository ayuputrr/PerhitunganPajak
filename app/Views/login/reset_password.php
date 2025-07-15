<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<style>
  body {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: url('https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=800&q=80') center/cover no-repeat fixed;
    position: relative;
    font-family: 'Poppins', Arial, sans-serif;
    margin: 0;
  }

  body::before {
    content: "";
    position: fixed;
    inset: 0;
    z-index: 0;
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
  }

  .reset-card {
    position: relative;
    z-index: 1;
    background: rgba(255, 255, 255, 0.95);
    padding: 2.5rem 2rem;
    border-radius: 1.7rem;
    box-shadow: 0 10px 40px rgba(39, 174, 96, 0.13), 0 0 32px rgba(39, 174, 96, 0.1);
    max-width: 400px;
    width: 90%;
    text-align: center;
    animation: fadePop 1s cubic-bezier(.23,1,.32,1);
  }

  @keyframes fadePop {
    0% { opacity: 0; transform: scale(0.9) translateY(40px); }
    70% { opacity: 1; transform: scale(1.05) translateY(-10px); }
    100% { opacity: 1; transform: scale(1) translateY(0); }
  }

  .reset-title {
    font-weight: 900;
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
    color: #27ae60;
    letter-spacing: 0.4px;
    text-shadow: 0 2px 8px #27ae6033;
  }

  .form-label {
    font-weight: 600;
    color: #27ae60;
    margin-bottom: 0.5rem;
    text-align: left;
    display: block;
  }

  .form-control {
    width: 100%;
    padding: 0.85rem 1.2rem;
    font-size: 1rem;
    border: 2px solid #e3eafc;
    border-radius: 2rem;
    background: rgba(255,255,255,0.98);
    color: #222;
    box-shadow: 0 1px 8px rgba(39, 174, 96, 0.05);
    transition: border 0.18s ease, box-shadow 0.18s ease;
    margin-bottom: 1.2rem;
  }

  .form-control:focus {
    border-color: #27ae60;
    box-shadow: 0 0 0 2px #6dd5ed55, 0 1px 16px #27ae60;
    background: #fff;
    outline: none;
    color: #222;
  }

  .btn-primary {
    background: linear-gradient(90deg, #27ae60 0%, #6dd5ed 100%);
    border: none;
    color: #fff;
    font-weight: 800;
    font-size: 1.1rem;
    padding: 1rem 0;
    border-radius: 2rem;
    letter-spacing: 1.2px;
    width: 100%;
    cursor: pointer;
    box-shadow: 0 4px 18px rgba(39,174,96,0.8);
    transition: background 0.25s ease, box-shadow 0.25s ease;
  }

  .btn-primary:hover,
  .btn-primary:focus {
    background: linear-gradient(90deg, #6dd5ed 0%, #27ae60 100%);
    box-shadow: 0 8px 36px rgba(109, 213, 237, 0.8);
  }

  .alert {
    margin-bottom: 1rem;
    border-radius: 1rem;
  }

  @media(max-width: 440px) {
    .reset-card {
      padding: 2rem 1.5rem;
    }
  }
</style>

<div class="reset-card">
  <h2 class="reset-title">Reset Password</h2>

  <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
  <?php endif; ?>

  <form method="post" action="<?= site_url('auth/prosesResetPassword') ?>" autocomplete="off">
    <?= csrf_field() ?>

    <label for="password" class="form-label">Password Baru</label>
    <input type="password" class="form-control" id="password" name="password" minlength="6" required autofocus>

    <label for="password_confirm" class="form-label">Konfirmasi Password</label>
    <input type="password" class="form-control" id="password_confirm" name="password_confirm" minlength="6" required>

    <button type="submit" class="btn btn-primary">Reset Password</button>
  </form>
</div>

<?= $this->endSection() ?>
