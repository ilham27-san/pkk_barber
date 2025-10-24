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
      <a href="/">Home</a> |
         <a href="<?= base_url('about'); ?>">About Us</a> |
    <a href="<?= base_url('products'); ?>">Products</a> |
    <a href="<?= base_url('gallery'); ?>">Gallery</a> |
    <a href="<?= base_url('contact'); ?>">Contact</a>
      <a href="/layanan">Layanan</a> |
      <?php if(session()->get('isLoggedIn')): ?>
        <span>Hi, <?= session()->get('username') ?></span> |
        <?php if(session()->get('role') === 'admin'): ?>
          <a href="/admin">Admin</a> |
        <?php endif; ?>
        <a href="/auth/logout">Logout</a>
      <?php else: ?>
        <a href="/auth/login">Login</a> |
        <a href="/auth/register">Register</a>
      <?php endif; ?>
    </nav>
    <hr>
  </header>

  <main>
    <?php if(session()->getFlashdata('error')): ?>
      <div class="alert error"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('success')): ?>
      <div class="alert success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?= isset($content) ? $content : '' ?>
  </main>

  <footer>
    <hr>
    <p>&copy; <?= date('Y') ?> BarberNow</p>
  </footer>
</body>
</html>
