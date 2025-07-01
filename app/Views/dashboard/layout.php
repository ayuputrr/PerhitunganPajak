<?php // Views/dashboard/layout.php ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Pajak</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body { background-color: #f5f8fa; }
    .card-stat { background: linear-gradient(135deg, #2F80ED, #56CCF2); color: #fff; border-radius: 15px; padding: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
    .sidebar {
      background: linear-gradient(135deg, #2F80ED, #56CCF2);
      height: 100vh;
      color: white;
      padding-top: 60px;
      width: 220px;
      position: fixed;
      transition: all 0.3s ease;
      z-index: 1020;
    }
    .sidebar a {
      color: #fff;
      display: block;
      padding: 15px 20px;
      text-decoration: none;
      font-weight: 500;
    }
    .sidebar a:hover {
      background-color: rgba(255,255,255,0.2);
      border-left: 4px solid #fff;
    }
    .main-content {
      margin-left: 220px;
      padding: 20px;
      transition: margin-left 0.3s ease;
    }
    .navbar {
      background: linear-gradient(135deg, #56CCF2, #2F80ED);
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      z-index: 1030;
    }
    .navbar-brand {
      color: white;
      font-weight: bold;
    }
    .sidebar-toggle-btn {
      background: none;
      border: none;
      color: white;
      font-size: 1.5rem;
    }
    @media (max-width: 768px) {
      .sidebar {
        margin-left: -220px;
      }
      .sidebar.show {
        margin-left: 0;
      }
      .main-content {
        margin-left: 0 !important;
      }
    }
  </style>
</head>
<body>

<?= $this->include('partials/navbar') ?>
<?= $this->include('partials/sidebar') ?>

<div class="main-content" id="mainContent">
  <?= $this->renderSection('content') ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById('toggleSidebar').addEventListener('click', function () {
    document.getElementById('sidebarMenu').classList.toggle('show');
  });
</script>
</body>
</html>
