<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="admin-container">
    <div class="content-box">

        <div class="admin-header">
            <h2 class="admin-title">Daftar Booking</h2>
            <a href="<?= base_url('admin/tambah_booking') ?>" class="btn-primary">+ Tambah Booking Baru</a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif; ?>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pelanggan</th>
                    <th>Layanan</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($bookings) && is_array($bookings)): ?>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?= esc($booking['id']) ?></td>
                            <td><?= esc($booking['nama_pelanggan']) ?></td>
                            <td><?= esc($booking['layanan']) ?></td>
                            <td><?= esc($booking['tanggal_booking']) ?></td>
                            <td><?= esc($booking['jam_booking']) ?></td>
                            <td><?= esc($booking['status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Tidak ada data booking.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
    </div> </div> <?= $this->endSection(); ?>