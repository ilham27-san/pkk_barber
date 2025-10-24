<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - MyApp</title>
  <!-- Pastikan path 'href' ini benar -->
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<!-- [FIX] Menggunakan class="body-login" -->

<body class="body-login">

  <div class="login-container">
    <div class="login-card">
      <h2>Selamat Datang</h2>
      <p>Silakan login untuk melanjutkan</p>

      <?php $session = session(); ?>

      <!-- [FIX] Menampilkan pesan error jika ada -->
      <?php if ($session->getFlashdata('error')) : ?>
        <div class="alert error">
          <?= $session->getFlashdata('error') ?>
        </div>
      <?php endif; ?>

      <!-- [FIX] Menampilkan pesan sukses jika ada (misal: setelah registrasi) -->
      <?php if ($session->getFlashdata('success')) : ?>
        <div class="alert success">
          <?= $session->getFlashdata('success') ?>
        </div>
      <?php endif; ?>


      <!-- [FIX] Action form diubah ke '/auth/attempt' -->
      <form method="post" action="<?= base_url('/auth/attempt') ?>">
        <label>Email</label>
        <input type="email" name="email" placeholder="Masukkan email..." required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan password..." required>

        <button type="submit">Masuk</button>
      </form>

      <!-- [OPSIONAL] Link untuk registrasi -->
      <p style="text-align: center; margin-top: 15px; font-size: 14px; color: #777;">
        Belum punya akun? <a href="<?= base_url('/auth/register') ?>">Daftar di sini</a>
      </p>
    </div>
  </div>

</body>

</html>