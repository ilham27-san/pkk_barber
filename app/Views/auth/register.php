<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - MyApp</title>
  <!-- Menggunakan file CSS yang sama dengan login -->
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<!-- Menggunakan class body yang sama dengan login -->

<body class="body-login">

  <div class="login-container">
    <div class="login-card">
      <h2>Buat Akun Baru</h2>
      <p>Silakan isi data untuk mendaftar</p>

      <!-- [FIX] Menggunakan base_url() agar lebih aman -->
      <form method="post" action="<?= base_url('/auth/register') ?>">

        <!-- [FIX] Menghilangkan <br> dan memakai style label/input -->
        <label>Nama</label>
        <input type="text" name="username" placeholder="Masukkan nama..." required>

        <label>Email</label>
        <input type="email" name="email" placeholder="Masukkan email..." required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan password..." required>

        <button type"submit">Daftar</button>
      </form>

      <!-- [OPSIONAL] Link untuk kembali ke login -->
      <p style="text-align: center; margin-top: 15px; font-size: 14px; color: #777;">
        Sudah punya akun? <a href="<?= base_url('/auth/login') ?>">Login di sini</a>
      </p>
    </div>
  </div>

</body>

</html>