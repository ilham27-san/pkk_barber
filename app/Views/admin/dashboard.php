<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="admin-container">
    <div class="content-box">

        <div class="admin-header">
            <h2 class="admin-title">Admin Dashboard</h2>
        </div>

        <div class="dashboard-info">
            <p>Total Pelanggan: <span><?= $total_pelanggan ?? 0 ?></span></p>
            <p>Total Booking: <span><?= $total_booking ?? 0 ?></span></p>
        </div>

        <ul class="dashboard-links">
            <li><a href="<?= base_url('admin/layanan'); ?>">Kelola Layanan</a></li>
            <li><a href="<?= base_url('admin/pelanggan'); ?>">Daftar Pelanggan</a></li>
            <li><a href="<?= base_url('admin/booking'); ?>">Daftar Booking</a></li>
        </ul>

    </div> </div> <?= $this->endSection() ?>