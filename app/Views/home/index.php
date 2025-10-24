<h1>Selamat datang di BarberNow</h1>
<p>Pilih layanan untuk memesan:</p>
<ul>
  <?php foreach($layanan as $l): ?>
    <li>
      <strong><?= esc($l['nama_layanan']) ?></strong> - Rp <?= number_format($l['harga']) ?>
      <a href="/booking/<?= $l['id'] ?>">Booking</a>
    </li>
  <?php endforeach; ?>
</ul>
