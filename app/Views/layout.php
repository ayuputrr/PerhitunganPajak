<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= isset($title) ? $title : 'Aplikasi Pegawai' ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Google Fonts: Inter -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <!-- Bootstrap CSS & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
    }
    body {
      min-height: 100vh;
      background: #f4f8fb;
      font-family: 'Inter', Arial, sans-serif;
      font-size: 15px;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      transition: background 0.2s;
    }
    .navbar-custom {
      background: rgba(47,128,237,0.85);
      backdrop-filter: blur(8px);
      box-shadow: 0 2px 12px rgba(47,128,237,0.10);
      border-radius: 0 0 18px 18px;
      transition: all 0.18s cubic-bezier(.4,0,.2,1);
    }
    .navbar-custom .navbar-brand {
      font-size: 1.25rem;
      font-weight: 600;
      color: #fff !important;
      letter-spacing: 1px;
      transition: color 0.2s;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .navbar-custom .navbar-brand:hover {
      color: #eaf2fb !important;
    }
    .navbar-custom .nav-link {
      color: #fff !important;
      font-size: 1.07rem;
      margin-right: 7px;
      padding: 0.35rem 1rem;
      border-radius: 8px;
      transition: all 0.18s cubic-bezier(.4,0,.2,1);
    }
    .navbar-custom .nav-link.active,
    .navbar-custom .nav-link[aria-current="page"] {
      background: linear-gradient(90deg, #2F80ED 60%, #56CCF2 100%) !important;
      color: #fff !important;
      font-weight: 500;
      box-shadow: 0 4px 16px 0 #2F80ED33;
    }
    .navbar-custom .nav-link:hover {
      background: linear-gradient(90deg, #2F80ED 60%, #56CCF2 100%) !important;
      color: #fff !important;
      box-shadow: 0 4px 16px 0 #2F80ED33;
      font-weight: 500;
    }
    .navbar-custom .btn-logout {
      background: #fff;
      color: #2F80ED !important;
      border-radius: 20px;
      font-weight: 500;
      box-shadow: 0 2px 8px rgba(47,128,237,0.08);
      transition: all 0.18s cubic-bezier(.4,0,.2,1);
      margin-left: 10px;
    }
    .navbar-custom .btn-logout:hover {
      background: #56CCF2;
      color: #fff !important;
    }
    .mode-toggle-btn {
      background: transparent;
      border: none;
      color: #fff;
      font-size: 1.4rem;
      margin-left: 10px;
      outline: none;
      transition: color 0.2s;
    }
    .mode-toggle-btn:focus {
      color: #FFD600;
    }
    .main-content {
      flex: 1 0 auto;
      padding-top: 30px;
      padding-bottom: 30px;
      background: transparent;
      transition: background 0.2s;
    }
    .card-modern {
      background: #fff;
      border: none;
      border-radius: 1.5rem;
      box-shadow: 0 4px 24px 0 rgba(47,128,237,0.07);
      transition: box-shadow 0.18s cubic-bezier(.4,0,.2,1), background 0.2s, color 0.2s;
    }
    .card-modern:hover {
      box-shadow: 0 8px 32px 0 rgba(47,128,237,0.13);
    }
    .footer-custom {
      background: #fff;
      color: #7b8ca5;
      border-top: 1px solid #e3eaf1;
      font-size: 0.85rem;
      padding: 1rem 0 0.5rem 0;
      box-shadow: 0 -2px 8px rgba(47,128,237,0.05);
      text-align: center;
      flex-shrink: 0;
      transition: background 0.2s, color 0.2s;
    }
    .footer-custom small {
      color: #7b8ca5;
      letter-spacing: 0.1px;
    }
    @media (max-width: 900px) {
      .main-content { padding: 16px 2px; }
    }
    @media (max-width: 600px) {
      .navbar-custom .navbar-brand { font-size: 1rem; }
      .main-content { padding: 8px 0; }
      .card-modern { border-radius: 1rem; }
    }
    body.dark-mode {
      background: #181f2a;
      color: #eaf2fb;
    }
    body.dark-mode .navbar-custom {
      background: rgba(24,31,42,0.96);
      box-shadow: 0 2px 12px rgba(24,31,42,0.13);
    }
    body.dark-mode .navbar-custom .navbar-brand,
    body.dark-mode .navbar-custom .nav-link,
    body.dark-mode .navbar-custom .btn-logout,
    body.dark-mode .mode-toggle-btn {
      color: #fff !important;
    }
    body.dark-mode .navbar-custom .nav-link.active,
    body.dark-mode .navbar-custom .nav-link[aria-current="page"],
    body.dark-mode .navbar-custom .nav-link:hover {
      background: linear-gradient(90deg, #232d3a 60%, #2F80ED 100%) !important;
      color: #fff !important;
      box-shadow: 0 4px 16px 0 #232d3a33;
    }
    body.dark-mode .navbar-custom .btn-logout {
      background: #232d3a;
      color: #fff !important;
      border: 1px solid #2F80ED;
    }
    body.dark-mode .navbar-custom .btn-logout:hover {
      background: #2F80ED;
      color: #fff !important;
    }
    body.dark-mode .main-content {
      background: transparent;
    }
    body.dark-mode .card-modern {
      background: #232d3a;
      color: #eaf2fb;
      box-shadow: 0 4px 24px 0 rgba(24,31,42,0.13);
    }
    body.dark-mode .footer-custom {
      background: #232d3a;
      color: #b8c7e0;
      border-top: 1px solid #2F80ED;
    }
    body.dark-mode .footer-custom small {
      color: #b8c7e0;
    }
    body.dark-mode table {
      color: #eaf2fb;
      background: #232d3a;
    }
    body.dark-mode .table-primary {
      background-color: #2F80ED !important;
      color: #fff;
    }
    body.dark-mode .table-striped>tbody>tr:nth-of-type(odd)>* {
      background-color: #232d3a;
      color: #eaf2fb;
    }
    body.dark-mode .table-bordered th,
    body.dark-mode .table-bordered td {
      border-color: #2F80ED;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url('/') ?>">
        <i class="bi bi-people-fill"></i> Pajak Pegawai
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-center">
          <li class="nav-item">
            <a class="nav-link<?= (current_url() == base_url('/pengguna/dashboard')) ? ' active' : '' ?>" href="<?= base_url('/pengguna/dashboard') ?>">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link<?= (current_url() == base_url('/pengguna/arsip?mode=bulanan')) ? ' active' : '' ?>" href="<?= base_url('/pengguna/arsip?mode=bulanan') ?>">Arsip Bulanan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link<?= (current_url() == base_url('/pengguna/arsip_tahunan')) ? ' active' : '' ?>" href="<?= base_url('/pengguna/arsip_tahunan') ?>">Arsip Tahunan</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-logout px-3" href="<?= base_url('/pengguna/logout') ?>">
              <i class="bi bi-box-arrow-right"></i> Logout
            </a>
          </li>
          <li class="nav-item">
            <button class="mode-toggle-btn" id="toggleModeBtn" title="Ganti Mode">
              <i class="bi bi-moon-stars-fill" id="toggleModeIcon"></i>
            </button>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Spacer for fixed navbar -->
  <div style="height: 70px;"></div>

  <!-- Konten Utama -->
  <main class="main-content">
    <div class="container py-4">
      <div class="card card-modern shadow-sm rounded-4 border-0">
        <div class="card-body">
          <?= $this->renderSection('content') ?>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer-custom">
    <small>
      &copy; <?= date('Y') ?> Pajak Pegawai &mdash; Dinas Komunikasi dan Informatika Kabupaten Pringsewu
    </small>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Dark Mode Toggle Script -->
  <script>
    function setMode(mode) {
      if (mode === 'dark') {
        document.body.classList.add('dark-mode');
        document.getElementById('toggleModeIcon').classList.remove('bi-moon-stars-fill');
        document.getElementById('toggleModeIcon').classList.add('bi-sun-fill');
        document.getElementById('toggleModeBtn').setAttribute('title', 'Mode Terang');
      } else {
        document.body.classList.remove('dark-mode');
        document.getElementById('toggleModeIcon').classList.remove('bi-sun-fill');
        document.getElementById('toggleModeIcon').classList.add('bi-moon-stars-fill');
        document.getElementById('toggleModeBtn').setAttribute('title', 'Mode Gelap');
      }
    }
    document.addEventListener('DOMContentLoaded', function () {
      const navLinks = document.querySelectorAll('.nav-link');
      const navCollapse = document.querySelector('.navbar-collapse');
      navLinks.forEach(function(link) {
        link.addEventListener('click', function () {
          const bsCollapse = new bootstrap.Collapse(navCollapse, { toggle: false });
          bsCollapse.hide();
        });
      });

      let savedMode = localStorage.getItem('themeMode');
      if (!savedMode) {
        savedMode = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
      }
      setMode(savedMode);

      document.getElementById('toggleModeBtn').addEventListener('click', function() {
        let mode = document.body.classList.contains('dark-mode') ? 'light' : 'dark';
        setMode(mode);
        localStorage.setItem('themeMode', mode);
      });
    });
  </script>
</body>
</html>
