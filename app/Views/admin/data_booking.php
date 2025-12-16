<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="admin-container">
    <div class="content-box">

        <div class="admin-header">
            <h2 class="admin-title">Daftar Booking</h2>
            <a href="<?= base_url('admin/booking/tambah') ?>" class="btn-primary">+ Tambah Booking Baru</a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif; ?>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pelanggan</th>
                    <th>Layanan (ID)</th>
                    <th>Barber / Stylist</th>
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
                            <td><?= esc($booking['name']) ?></td>
                            <td><?= esc($booking['id_layanan']) ?></td>

                            <td>
                                <?php if (!empty($booking['nama_capster'])) : ?>
                                    <strong><?= esc($booking['nama_capster']) ?></strong>
                                <?php else : ?>
                                    <span style="color: #888; font-style: italic;">-- Bebas / Siapa Saja --</span>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($booking['tanggal']) ?></td>
                            <td><?= esc($booking['jam']) ?></td>

                            <td>
                                <form action="<?= base_url('admin/update_status/' . $booking['id']) ?>" method="post">
                                    <?= csrf_field() ?>
                                    <select name="status" onchange="this.form.submit()" style="padding: 5px; border-radius: 5px; border: 1px solid #ddd;">
                                        <option value="pending" <?= ($booking['status'] ?? '') === 'pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="confirmed" <?= ($booking['status'] ?? '') === 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                        <option value="done" <?= ($booking['status'] ?? '') === 'done' ? 'selected' : '' ?>>Done</option>
                                        <option value="canceled" <?= ($booking['status'] ?? '') === 'canceled' ? 'selected' : '' ?>>Canceled</option>
                                    </select>
                                </form>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 20px;">Tidak ada data booking.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
</div>

<?= $this->endSection(); ?>