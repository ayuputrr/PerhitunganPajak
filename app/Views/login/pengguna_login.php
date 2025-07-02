<!DOCTYPE html>
<html>
<head>
  <title>Login Pengguna</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card mx-auto" style="max-width: 400px;">
    <div class="card-header bg-success text-white">Login Pengguna</div>
    <div class="card-body">
      <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
      <?php endif ?>
      <form method="post" action="/login/pengguna">
        <div class="mb-3">
          <label>NIP</label>
          <input type="text" name="nip" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Login</button>
        <div class="text-center mt-3">
          Belum punya akun? <a href="/pengguna/registrasi">Daftar di sini</a>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>
