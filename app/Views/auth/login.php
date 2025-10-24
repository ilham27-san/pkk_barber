<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - MyApp</title>
  <!-- Pastikan path 'href' ini benar sesuai struktur folder CI4 Anda -->
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<!-- [FIX] Tambahkan class="body-login" di sini -->

<body class="body-login">

  <div class="login-container">
    <div class="login-card">
      <h2>Selamat Datang</h2>
      <p>Silakan login untuk melanjutkan</p>

      <!-- Pastikan action URL ini benar -->
      <form method="post" action="/auth/login">
        <label>Email</label>
        <input type="email" name="email" placeholder="Masukkan email..." required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan password..." required>

        <button type="submit">Masuk</button>
      </form>
    </div>
  </div>

</body>

</html>