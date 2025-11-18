<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BarberNow</title>

  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

  <header class="main-header">
    <div class="container">

      <div class="logo">
      </div>

      <nav class="main-nav">
        <?php
        // Mengambil URI service CodeIgniter
        $uri = service('uri');
        // Mengecek segmen URL pertama
        $segment1 = $uri->getSegment(1);
        ?>
        <ul>
          <li><a href="<?= base_url('/'); ?>" class="<?= ($segment1 == '') ? 'active' : '' ?>">Home</a></li>
         <li class="dropdown">
  <a href="<?= base_url('about'); ?>" class="<?= ($segment1 == 'about') ? 'active' : '' ?>">About Us ▾</a>

  <ul class="dropdown-menu">
    <li><a href="<?= base_url('about/history'); ?>">History</a></li>
    <li><a href="<?= base_url('about/lokasi'); ?>">Lokasi</a></li>
    <li><a href="<?= base_url('about/review'); ?>">Review</a></li>
  </ul>
</li>


          <li><a href="<?= base_url('products'); ?>" class="<?= ($segment1 == 'products') ? 'active' : '' ?>">Products</a></li>
          <li><a href="<?= base_url('gallery'); ?>" class="<?= ($segment1 == 'gallery') ? 'active' : '' ?>">Gallery</a></li>
          <li><a href="<?= base_url('contact'); ?>" class="<?= ($segment1 == 'contact') ? 'active' : '' ?>">Contact</a></li>
         <li class="dropdown">
  <a href="<?= base_url('layanan'); ?>" class="<?= ($segment1 == 'layanan') ? 'active' : '' ?>">Layanan ▾</a>

  <ul class="dropdown-menu">
    <li><a href="<?= base_url('layanan/pricelist'); ?>">Pricelist</a></li>
    <li><a href="<?= base_url('layanan/capster'); ?>">Capster</a></li>
  </ul>
</li>

<li><a href="<?= base_url('booking'); ?>" class="<?= ($segment1 == 'booking') ? 'active' : '' ?>">Booking</a></li>


          <?php if (session()->get('logged_in')): ?>
            <li><span>Hi, <?= session()->get('username') ?></span></li>

            <?php if (session()->get('role') === 'admin'): ?>
              <li><a href="<?= base_url('admin'); ?>" class="<?= ($segment1 == 'admin') ? 'active' : '' ?>">Admin</a></li>
            <?php endif; ?>

            <li><a href="<?= base_url('auth/logout'); ?>">Logout</a></li>

          <?php else: ?>

            <li><a href="<?= base_url('auth/login'); ?>" class="<?= ($segment1 == 'auth') ? 'active' : '' ?>">Login</a></li>
            <li><a href="<?= base_url('auth/register'); ?>" class="btn-reservasi">Register</a></li>

          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </header>
  <main>
    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert error"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?= $this->renderSection('content'); ?>
  </main>

  <footer class="main-footer">
    <div class="container">
      <p>&copy; <?= date('Y') ?> BarberNow</p>
    </div>
  </footer>

  <script>
    // Pilih elemen header
    // [SUDAH BENAR] Kode ini sekarang akan berhasil menemukan .main-header
    const header = document.querySelector('.main-header');

    // Variabel untuk menyimpan posisi scroll terakhir
    let lastScrollY = window.scrollY;

    // Tambahkan event listener saat pengguna scroll
    window.addEventListener('scroll', () => {
      const currentScrollY = window.scrollY;

      // Cek jika scroll ke bawah dan sudah melewati 10px
      if (currentScrollY > lastScrollY && currentScrollY > 10) {
        // === SCROLL KE BAWAH ===
        // Sembunyikan Header (Animasi ke atas)
        header.classList.add('header-hidden');

      } else if (currentScrollY < lastScrollY) {
        // === SCROLL KE ATAS ===
        // Tampilkan Header (Animasi dari atas)
        header.classList.remove('header-hidden');
      }

      // Jika scroll mentok di paling atas (0)
      if (currentScrollY <= 10) {
        header.classList.remove('header-hidden'); // Pastikan header terlihat
      }

      // Perbarui posisi scroll terakhir
      lastScrollY = currentScrollY <= 0 ? 0 : currentScrollY;
    });
  </script>

</body>

</html>