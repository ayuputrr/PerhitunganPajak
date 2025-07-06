<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Pajak</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <style>
    body {
      background-color: #f5f8fa;
      transition: background 0.3s;
    }
    .sidebar {
      background: linear-gradient(135deg, #2F80ED, #56CCF2);
      height: 100vh;
      color: white;
      width: 220px;
      position: fixed;
      left: 0;
      top: 0;
      transition: width 0.3s, left 0.3s;
      z-index: 1020;
      overflow-x: hidden;
      box-shadow: 2px 0 18px 0 #56CCF244;
    }
    .sidebar.collapsed { width: 70px; }
    .sidebar .logo-full, .sidebar .menu-text { transition: opacity 0.3s, width 0.3s; }
    .sidebar.collapsed .logo-full, .sidebar.collapsed .menu-text { opacity: 0; width: 0; display: none; }
    .sidebar .nav-item {
      padding: 13px 22px;
      display: flex;
      align-items: center;
      gap: 13px;
      font-weight: 500;
      color: white;
      text-decoration: none;
      border-left: 4px solid transparent;
      transition: background 0.17s, border 0.17s;
      font-size: 1.09rem;
    }
    .sidebar .nav-item:hover, .sidebar .nav-item.active {
      background: rgba(255,255,255,0.10);
      border-left: 4px solid #fff;
      color: #fff;
    }
    .sidebar .nav-item i { font-size: 1.25rem; }
    .main-content {
      margin-left: 220px;
      padding: 28px 18px 18px 18px;
      min-height: 100vh;
      transition: margin-left 0.3s;
      background: #f5f8fa;
    }
    .main-content.collapsed { margin-left: 70px; }
    .navbar {
      background: linear-gradient(135deg, #56CCF2, #2F80ED);
      box-shadow: 0 4px 8px rgba(0,0,0,0.09);
      z-index: 1030;
    }
    .navbar-brand { color: white; font-weight: bold; margin-left: 1rem; }
    .sidebar-toggle-btn {
      background: none;
      border: none;
      color: white;
      font-size: 1.5rem;
      margin-right: 1rem;
    }
    .logo-img { max-height: 38px; width: auto; object-fit: contain; transition: all 0.3s; }
    .logo-small { max-height: 33px; margin: 0 auto; display: block; }
    .dark-mode body, .dark-mode .main-content { background: #181f2c !important; color: #e4e7ef !important;}
    .dark-mode .sidebar { background: linear-gradient(135deg, #232c43, #2F80ED);}
    .dark-mode .navbar { background: linear-gradient(135deg, #232c43, #2F80ED);}
    .dark-mode .sidebar .nav-item:hover, .dark-mode .sidebar .nav-item.active {
      background: rgba(255,255,255,0.13);
      color: #fff;
    }
    .dark-mode .sidebar hr { border-color: #4e5d7a; }
    .dark-mode .main-content { color: #e4e7ef; }
    .dark-mode .card { background: #232c43; color: #e4e7ef; }
    .dark-mode .table { color: #e4e7ef; }
    .dark-mode .table th, .dark-mode .table td { border-color: #4e5d7a; }
    .dark-mode .btn, .dark-mode .btn-secondary, .dark-mode .btn-outline-primary { color: #fff; }
    .dark-mode .btn-secondary { background: #2F80ED; border-color: #2F80ED; }
    .dark-mode .btn-outline-primary { border-color: #56CCF2; color: #56CCF2; }
    .dark-mode .btn-outline-primary:hover { background: #56CCF2; color: #fff; }
    @media (max-width: 768px) {
      .sidebar { left: -220px; }
      .sidebar.show { left: 0; }
      .main-content { margin-left: 0 !important; }
      .main-content.overlay { background-color: rgba(0,0,0,0.17); }
    }
    .toggle-darkmode {
      background: none;
      border: none;
      color: #fff;
      font-size: 1.5rem;
      margin-left: 1rem;
      cursor: pointer;
      transition: color 0.2s;
    }
    .toggle-darkmode:hover { color: #ffd700; }
    /* JUDUL HITAM SAAT DARK MODE */
    .dark-mode h1,
    .dark-mode h2,
    .dark-mode h3,
    .dark-mode h4,
    .dark-mode h5,
    .dark-mode h6 {
      color: #000 !important;
    }
    /* JUDUL DASHBOARD DATA PEGAWAI PUTIH SAAT DARK MODE */
    .dark-mode .judul-dashboard {
      color: #fff !important;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <button class="sidebar-toggle-btn" id="toggleSidebar" aria-label="Toggle Sidebar">
        <i class="bi bi-list"></i>
      </button>
      <a class="navbar-brand" href="#">Dinas Kominfo Pringsewu</a>
      <div class="d-flex align-items-center">
        <button class="toggle-darkmode" id="toggleDarkmode" aria-label="Dark Mode">
          <i class="bi bi-moon-stars"></i>
        </button>
        <img src="<?= base_url('assets/img/logo_pringsewu.png') ?>" alt="Logo" class="logo-img d-none d-md-block ms-2" />
      </div>
    </div>
  </nav>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebarMenu">
    <div class="text-center py-3">
      <img src="<?= base_url('assets/img/logo_pringsewu.png') ?>" alt="Logo" class="logo-small mb-2" />
    </div>
    <a href="/pegawai" class="nav-item <?= (uri_string() == 'pegawai') ? 'active' : '' ?>">
      <i class="bi bi-speedometer2"></i><span class="menu-text">Dashboard</span>
    </a>
    <a href="/laporan/bulanan" class="nav-item <?= (uri_string() == 'laporan/bulanan') ? 'active' : '' ?>">
      <i class="bi bi-bar-chart-fill"></i><span class="menu-text">Laporan Bulanan</span>
    </a>
    <a href="/laporan/tahunan" class="nav-item <?= (uri_string() == 'laporan/tahunan') ? 'active' : '' ?>">
      <i class="bi bi-calendar2-week-fill"></i><span class="menu-text">Laporan Tahunan</span>
    </a>
    <hr class="text-white mx-2" />
    <a href="/pegawai/logout" onclick="return confirm('Yakin ingin logout?')" class="nav-item">
      <i class="bi bi-box-arrow-right"></i><span class="menu-text">Logout</span>
    </a>
  </div>

  <!-- Main Content -->
  <div class="main-content" id="mainContent">
    <!-- Contoh konten -->

    <?= $this->renderSection('content') ?>
  </div>

  <!-- Script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const toggleBtn = document.getElementById('toggleSidebar');
      const sidebar = document.getElementById('sidebarMenu');
      const mainContent = document.getElementById('mainContent');
      const darkBtn = document.getElementById('toggleDarkmode');
      const body = document.body;

      // Sidebar toggle
      toggleBtn?.addEventListener('click', function () {
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('collapsed');
        sidebar.classList.toggle('show');
        mainContent.classList.toggle('overlay');
      });

      // Auto close sidebar on click outside (mobile only)
      document.addEventListener('click', function (e) {
        if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
          sidebar.classList.remove('show');
          mainContent.classList.remove('overlay');
        }
      });

      // Dark mode toggle
      darkBtn?.addEventListener('click', function () {
        body.classList.toggle('dark-mode');
        localStorage.setItem('darkMode', body.classList.contains('dark-mode'));
      });

      // Set dark mode from localStorage
      if (localStorage.getItem('darkMode') === 'true') {
        body.classList.add('dark-mode');
      }
    });
  </script>
</body>
</html>
