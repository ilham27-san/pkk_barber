<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>BarberNow</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body>
  <header>
    <nav>
      <!-- [FIX] Menggunakan base_url() untuk semua link agar konsisten -->
      <a href="<?= base_url('/'); ?>">Home</a> |
      <a href="<?= base_url('about'); ?>">About Us</a> |
      <a href="<?= base_url('products'); ?>">Products</a> |
      <a href="<?= base_url('gallery'); ?>">Gallery</a> |
      <a href="<?= base_url('contact'); ?>">Contact</a> |
      <a href="<?= base_url('layanan'); ?>">Layanan</a> |

      <?php if (session()->get('isLoggedIn')): ?>
        <span>Hi, <?= session()->get('username') ?></span> |
        <?php if (session()->get('role') === 'admin'): ?>
          <a href="<?= base_url('admin'); ?>">Admin</a> |
        <?php endif; ?>
        <a href="<?= base_url('auth/logout'); ?>">Logout</a>
      <?php else: ?>
        <a href="<?= base_url('auth/login'); ?>">Login</a> |
        <a href="<?= base_url('auth/register'); ?>">Register</a>
      <?php endif; ?>
    </nav>
    <hr>
  </header>

  <main>
    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert error"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <!-- 
      [FIX] Mengubah cara memuat konten.
      Ini akan mencari 'section('content')' dari file seperti about.php 
    -->
    <?= $this->renderSection('content'); ?>

  </main>

  <footer>
    <hr>
    <p>&copy; <?= date('Y') ?> BarberNow</p>
  </footer>
</body>

</html>