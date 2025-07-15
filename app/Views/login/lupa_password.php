<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<style>
  body {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80') center/cover no-repeat fixed;
    margin: 0;
    font-family: 'Poppins', Arial, sans-serif;
    position: relative;
  }
  body::before {
    content: "";
    position: fixed;
    inset: 0;
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    z-index: 0;
  }
  .forgot-card {
    position: relative;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 2rem;
    padding: 2.5rem 2rem;
    box-shadow: 0 8px 30px rgba(0, 128, 0, 0.15);
    max-width: 400px;
    width: 90%;
    z-index: 1;
    text-align: center;
    animation: fadePop 0.9s ease forwards;
  }
  @keyframes fadePop {
    0% { opacity: 0; transform: translateY(40px) scale(0.9); }
    100% { opacity: 1; transform: translateY(0) scale(1); }
  }

  h2 {
    font-weight: 900;
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
    color: #27ae60;
    text-shadow: 0 2px 8px #27ae6033;
    letter-spacing: 0.4px;
  }

  .form-label {
    display: block;
    text-align: left;
    font-weight: 700;
    color: #27ae60;
    margin-bottom: 0.5rem;
  }
  .form-control {
    width: 100%;
    padding: 0.85rem 1.2rem;
    font-size: 1rem;
    border: 2px solid #e3eafc;
    border-radius: 2rem;
    background: rgba(255,255,255,0.98);
    color: #222;
    box-shadow: 0 1px 8px rgba(39,174,96,0.07);
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    margin-bottom: 1.4rem;
  }
  .form-control:focus {
    border-color: #27ae60;
    box-shadow: 0 0 10px #6dd5ed44, 0 1px 16px #27ae60;
    outline: none;
  }

  .btn-primary {
    width: 100%;
    padding: 1rem;
    font-weight: 800;
    font-size: 1.1rem;
    color: white;
    background: linear-gradient(90deg, #27ae60 0%, #6dd5ed 100%);
    border: none;
    border-radius: 2rem;
    cursor: pointer;
    letter-spacing: 1.1px;
    box-shadow: 0 4px 18px rgba(39,174,96,0.75);
    transition: background 0.3s ease, box-shadow 0.3s ease;
  }
  .btn-primary:hover,
  .btn-primary:focus {
    background: linear-gradient(90deg, #6dd5ed 0%, #27ae60 100%);
    box-shadow: 0 8px 36px rgba(109,213,237,0.8);
  }

  .alert {
    border-radius: 1rem;
    margin-bottom: 1rem;
  }

  @media (max-width: 500px) {
    .forgot-card {
      padding: 2rem 1.5rem;
    }
    h2 {
      font-size: 1.5rem;
    }
  }
</style>

<div class="forgot-card">
    <h2>Lupa Password Pengguna</h2>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('auth/verifikasiNip') ?>" autocomplete="off">
        <?= csrf_field() ?>

        <label for="nip" class="form-label">NIP</label>
        <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukkan NIP Anda" required autofocus>

        <button type="submit" class="btn btn-primary">Lanjutkan</button>
    </form>
</div>

<?= $this->endSection() ?>
