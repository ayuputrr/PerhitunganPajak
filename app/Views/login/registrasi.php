<!DOCTYPE html>
<html>
<head>
  <title>Registrasi Pengguna</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card mx-auto" style="max-width: 400px;">
    <div class="card-header bg-primary text-white">Registrasi Pengguna</div>
    <div class="card-body">
      <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
          <ul>
            <?php foreach (session()->getFlashdata('errors') as $err): ?>
              <li><?= $err ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      <?php endif ?>
      <form method="post" action="/pengguna/registrasi">
        <div class="mb-3">
          <label>NIP</label>
          <input type="text" name="nip" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Nama</label>
          <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Registrasi</button>
        <div class="text-center mt-3">
          Sudah punya akun? <a href="/login/pengguna">Login di sini</a>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>
