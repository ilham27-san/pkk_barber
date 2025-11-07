<!doctype html>
<html lang="id"> <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BarberNow</title>
  
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
  
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

    <?= $this->renderSection('content'); ?>
  </main>

  <footer class="main-footer">
    <div class="container">
        <p>&copy; <?= date('Y') ?> BarberNow</p>
    </div>
  </footer>
  
  <script>
    // Pilih elemen header
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