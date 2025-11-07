<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<h2>Admin Dashboard</h2>
<p>Total Pelanggan: <?= $total_pelanggan ?? 0 ?></p>
<p>Total Booking: <?= $total_booking ?? 0 ?></p>

<ul>
  <li><a href="<?= base_url('admin/layanan'); ?>">Kelola Layanan</a></li>
  <li><a href="<?= base_url('admin/pelanggan'); ?>">Daftar Pelanggan</a></li>
  <li><a href="<?= base_url('admin/booking'); ?>">Daftar Booking</a></li>
</ul>

<?= $this->endSection() ?>
