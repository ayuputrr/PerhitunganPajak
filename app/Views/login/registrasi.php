<!DOCTYPE html>
<html>
<head>
  <title>Registrasi Pengguna</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    body {
      min-height: 100vh;
      background: url('https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=800&q=80') center/cover no-repeat fixed;
      position: relative;
      overflow-x: hidden;
    }
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      z-index: 0;
      background: rgba(255,255,255,0.82);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
    }
    .register-card {
      position: relative;
      z-index: 1;
      border: none;
      border-radius: 2.5rem;
      box-shadow: 0 10px 40px 0 rgba(39, 174, 96, 0.13), 0 0 32px 0 #27ae6022;
      background: rgba(255,255,255,0.89);
      backdrop-filter: blur(22px);
      -webkit-backdrop-filter: blur(22px);
      overflow: hidden;
      animation: fadePop 1s cubic-bezier(.23,1.01,.32,1) 1;
    }
    @keyframes fadePop {
      0% { opacity: 0; transform: scale(0.95) translateY(60px);}
      70% { opacity: 1; transform: scale(1.05) translateY(-10px);}
      100% { opacity: 1; transform: scale(1) translateY(0);}
    }
    .register-icon {
      width: 90px;
      height: 90px;
      margin: 0 auto 18px auto;
      background: linear-gradient(135deg, #27ae60 0%, #6dd5ed 100%);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 0 24px 0 #27ae60, 0 0 0 8px #fff inset;
      border: 4px solid #fff;
      animation: iconPop 1.2s cubic-bezier(.23,1.01,.32,1);
    }
    @keyframes iconPop {
      0% { filter: blur(2px) brightness(0.7);}
      100% { filter: blur(0) brightness(1);}
    }
    .register-icon i {
      font-size: 2.7rem;
      color: #fff;
      filter: drop-shadow(0 0 8px #6dd5ed);
      animation: iconPulse 1.7s infinite alternate;
    }
    @keyframes iconPulse {
      0% { filter: drop-shadow(0 0 8px #6dd5ed);}
      100% { filter: drop-shadow(0 0 18px #27ae60);}
    }
    .register-title {
      font-weight: 900;
      letter-spacing: 1.3px;
      color: #27ae60;
      margin-bottom: 0.5rem;
      font-size: 1.6rem;
      text-shadow: 0 2px 8px #27ae6033;
    }
    .register-desc {
      font-size: 1.08rem;
      color: #4a5a6a;
      margin-bottom: 1.7rem;
      font-weight: 500;
    }
    .form-label {
      font-weight: 700;
      color: #27ae60;
      letter-spacing: 0.2px;
      margin-bottom: 0.2rem;
      text-align: left;
      display: block;
    }
    .form-control {
      border-radius: 2rem;
      padding: 0.85rem 1.2rem;
      font-size: 1.08rem;
      background: rgba(255,255,255,0.98);
      border: 2px solid #e3eafc;
      color: #222;
      box-shadow: 0 1px 8px rgba(39,174,96,0.05);
      transition: border 0.18s, box-shadow 0.18s;
    }
    .form-control:focus {
      border-color: #27ae60;
      box-shadow: 0 0 0 2px #6dd5ed55, 0 1px 16px #27ae60;
      background: #fff;
      color: #222;
    }
    .password-label-custom {
      font-weight: 700;
      color: #27ae60;
      letter-spacing: 0.5px;
      font-size: 1.09rem;
      margin-bottom: 0.4rem;
      text-align: left;
    }
    .password-group {
      position: relative;
      display: flex;
      align-items: center;
    }
    .form-control[type="password"], .form-control[type="text"] {
      padding-right: 48px;
    }
    .toggle-password {
      position: absolute;
      right: 0;
      top: 0;
      height: 100%;
      width: 44px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      color: #27ae60;
      font-size: 1.35rem;
      z-index: 2;
      background: none;
      border: none;
      outline: none;
      transition: color 0.15s;
    }
    .toggle-password:hover {
      color: #6dd5ed;
    }
    .btn-register {
      background: linear-gradient(90deg, #27ae60 0%, #6dd5ed 100%);
      color: #fff;
      font-weight: 800;
      border: none;
      border-radius: 2rem 0.5rem 2rem 0.5rem;
      padding: 1rem 1.3rem;
      font-size: 1.19rem;
      margin-top: 0.9rem;
      transition: 0.18s;
      box-shadow: 0 4px 18px 0 #27ae60cc;
      letter-spacing: 1.2px;
      text-shadow: 0 1px 8px #27ae6088;
    }
    .btn-register:hover, .btn-register:focus {
      background: linear-gradient(90deg, #6dd5ed 0%, #27ae60 100%);
      color: #fff;
      transform: translateY(-2px) scale(1.04);
      box-shadow: 0 8px 36px 0 #6dd5edcc;
    }
    .alert {
      border-radius: 1.2rem;
      font-size: 0.97em;
    }
    .footer-tiny {
      color: #4a5a6a;
      font-size: 0.97em;
      text-align: center;
      margin-top: 2.5rem;
      letter-spacing: 0.5px;
      font-weight: 400;
      user-select: none;
      text-shadow: 0 1px 8px #27ae6033;
    }
    @media (max-width: 500px) {
      .register-card .card-body {
        padding: 1.3rem 0.6rem 1.2rem 0.6rem;
      }
      .register-title {
        font-size: 1.13rem;
      }
      .register-icon {
        width: 54px;
        height: 54px;
      }
      .register-icon i {
        font-size: 1.7rem;
      }
    }
  </style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh; position:relative; z-index:1;">
  <div class="register-card card mx-auto" style="max-width: 400px;">
    <div class="card-body text-center">
      <div class="register-icon mb-2">
        <i class="bi bi-person-plus-fill"></i>
      </div>
      <h3 class="register-title">Registrasi Pengguna</h3>
      <div class="register-desc mb-3">Buat akun untuk mengakses layanan pajak.</div>
      <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
          <ul class="mb-0">
            <?php foreach (session()->getFlashdata('errors') as $err): ?>
              <li><?= $err ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      <?php endif ?>
      <form method="post" action="/pengguna/registrasi" autocomplete="off">
        <div class="mb-3 text-start">
          <label class="form-label">NIP</label>
          <input type="text" name="nip" class="form-control" required placeholder="Masukkan NIP">
        </div>
        <div class="mb-3 text-start">
          <label class="form-label">Nama</label>
          <input type="text" name="nama" class="form-control" required placeholder="Masukkan nama lengkap">
        </div>
        <div class="password-label-custom">Password</div>
        <div class="mb-3 password-group">
          <input type="password" name="password" class="form-control" id="password-input" required placeholder="Buat password">
          <button type="button" class="toggle-password" tabindex="-1" onclick="togglePassword()" aria-label="Lihat Password">
            <i class="bi bi-eye-slash" id="icon-eye"></i>
          </button>
        </div>
        <button type="submit" class="btn btn-register w-100">
          <i class="bi bi-person-plus-fill me-2"></i>Registrasi
        </button>
        <div class="text-center mt-3">
          Sudah punya akun? <a href="/login/pengguna" style="color:#27ae60;font-weight:600;">Login di sini</a>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="footer-tiny">
  &copy; <?= date('Y') ?> Sistem Pajak Online | <span style="color:#27ae60;">Pringsewu</span>
</div>
<script>
function togglePassword() {
  const input = document.getElementById('password-input');
  const icon = document.getElementById('icon-eye');
  if (input.type === "password") {
    input.type = "text";
    icon.classList.remove('bi-eye-slash');
    icon.classList.add('bi-eye');
  } else {
    input.type = "password";
    icon.classList.remove('bi-eye');
    icon.classList.add('bi-eye-slash');
  }
}
</script>
</body>
</html>
