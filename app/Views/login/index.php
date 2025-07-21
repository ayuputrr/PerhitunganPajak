<!DOCTYPE html>
<html>
<head>
  <title>Pilih Role Login</title>
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
    /* Layer blur putih di seluruh background */
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      z-index: 0;
      background: rgba(255,255,255,0.82);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
    }
    .role-card {
      position: relative;
      z-index: 1;
      border: none;
      border-radius: 2.5rem;
      box-shadow: 0 10px 40px 0 rgba(31, 38, 135, 0.15), 0 0 32px 0 #56CCF222;
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
    .role-icon {
      width: 90px;
      height: 90px;
      margin: 0 auto 18px auto;
      background: linear-gradient(135deg, #56CCF2 0%, #27ae60 100%);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 0 24px 0 #56CCF2, 0 0 0 8px #fff inset;
      border: 4px solid #fff;
      animation: iconPop 1.2s cubic-bezier(.23,1.01,.32,1);
    }
    @keyframes iconPop {
      0% { filter: blur(2px) brightness(0.7);}
      100% { filter: blur(0) brightness(1);}
    }
    .role-icon i {
      font-size: 2.7rem;
      color: #fff;
      filter: drop-shadow(0 0 8px #56CCF2);
      animation: iconPulse 1.7s infinite alternate;
    }
    @keyframes iconPulse {
      0% { filter: drop-shadow(0 0 8px #56CCF2);}
      100% { filter: drop-shadow(0 0 18px #27ae60);}
    }
    .role-title {
      font-weight: 900;
      letter-spacing: 1.3px;
      color: #27ae60;
      margin-bottom: 0.5rem;
      font-size: 1.6rem;
      text-shadow: 0 2px 8px #56CCF233;
    }
    .role-desc {
      font-size: 1.08rem;
      color: #4a5a6a;
      margin-bottom: 1.7rem;
      font-weight: 500;
    }
    .btn-role {
      font-size: 1.15rem;
      font-weight: 700;
      padding: 1rem 1.2rem;
      border-radius: 2.5rem;
      transition: transform 0.17s, box-shadow 0.17s, background 0.17s;
      box-shadow: 0 2px 12px rgba(47, 128, 237, 0.07);
      display: flex;
      align-items: center;
      gap: 0.8rem;
      position: relative;
      overflow: hidden;
      z-index: 1;
      border: none;
      outline: none;
      margin-bottom: 1.1rem;
      background: #fff;
    }
    .btn-role:active {
      transform: scale(0.98);
    }
    .btn-admin {
      background: linear-gradient(90deg, #2F80ED 0%, #56CCF2 100%);
      color: #fff;
      border: none;
      box-shadow: 0 4px 16px 0 #2F80ED22;
      position: relative;
    }
    .btn-admin:hover, .btn-admin:focus {
      background: linear-gradient(90deg, #56CCF2 0%, #2F80ED 100%);
      color: #fff;
      box-shadow: 0 8px 32px 0 #2F80ED33;
      transform: translateY(-2px) scale(1.04);
    }
    .btn-pengguna {
      background: linear-gradient(90deg, #27ae60 0%, #6dd5ed 100%);
      color: #fff;
      border: none;
      box-shadow: 0 4px 16px 0 #27ae6022;
      position: relative;
    }
    .btn-pengguna:hover, .btn-pengguna:focus {
      background: linear-gradient(90deg, #6dd5ed 0%, #27ae60 100%);
      color: #fff;
      box-shadow: 0 8px 32px 0 #27ae6033;
      transform: translateY(-2px) scale(1.04);
    }
    .btn-role .bi {
      font-size: 1.45em;
    }
    .role-divider {
      margin: 1.3rem 0 1.2rem 0;
      font-size: 0.97rem;
      color: #b6b6b6;
      font-weight: 500;
      letter-spacing: 0.5px;
      position: relative;
      text-align: center;
    }
    .role-divider:before, .role-divider:after {
      content: "";
      display: inline-block;
      width: 40px;
      height: 2px;
      background: #e0eafc;
      vertical-align: middle;
      margin: 0 10px;
      border-radius: 2px;
    }
    .footer-tiny {
      color: #4a5a6a;
      font-size: 0.97em;
      text-align: center;
      margin-top: 2.5rem;
      letter-spacing: 0.5px;
      font-weight: 400;
      user-select: none;
      text-shadow: 0 1px 8px #2F80ED33;
    }
    @media (max-width: 500px) {
      .role-card .card-body {
        padding: 1.3rem 0.6rem 1.2rem 0.6rem;
      }
      .role-title {
        font-size: 1.13rem;
      }
      .role-icon {
        width: 54px;
        height: 54px;
      }
      .role-icon i {
        font-size: 1.7rem;
      }
    }
  </style>
</head>
<body>
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh; position:relative; z-index:1;">
  <div class="role-card card shadow-sm mx-auto" style="max-width: 400px; width:100%;">
    <div class="card-body text-center">
      <div class="role-icon mb-2">
        <i class="bi bi-stars"></i>
      </div>
      <h4 class="role-title">Pilih Role Login</h4>
      <div class="role-desc mb-4">Masuk sebagai Admin atau Pengguna<br><span style="color:#2F80ED;font-weight:600;">Sistem Pajak</span></div>
      <a href="/login/admin" class="btn btn-role btn-admin w-100 shadow-sm">
        <i class="bi bi-person-gear"></i> Admin
      </a>
      <div class="role-divider">atau</div>
      <a href="/login/pengguna" class="btn btn-role btn-pengguna w-100 shadow-sm">
        <i class="bi bi-person-circle"></i> Pengguna
      </a>
    </div>
  </div>
</div>
<div class="footer-tiny">
  &copy; <?= date('Y') ?> Sistem Login Pajak | <span style="color:#27ae60;">Banjarmasin</span>
</div>
</body>
</html>
