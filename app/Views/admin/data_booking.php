<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    /* STYLE SUPER POLOS / MINIMALIS */
    .plain-container {
        padding: 20px;
        background-color: #fff;
        font-family: sans-serif;
    }

    .plain-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 15px;
    }

    .plain-title {
        font-size: 24px;
        margin: 0;
        color: #333;
    }

    .btn-plain {
        padding: 8px 15px;
        background-color: #333;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
    }

    .btn-plain:hover {
        background-color: #555;
    }

    /* Tabel Klasik */
    .plain-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .plain-table th,
    .plain-table td {
        border: 1px solid #ddd;
        /* Garis pemisah tegas */
        padding: 10px;
        text-align: left;
        vertical-align: top;
        color: #333;
    }

    .plain-table th {
        background-color: #f4f4f4;
        /* Header abu-abu tipis */
        font-weight: bold;
    }

    .plain-table tr:nth-child(even) {
        background-color: #fafafa;
        /* Zebra striping halus */
    }

    /* Status Dropdown Polos */
    .status-select-plain {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 3px;
        background: #fff;
        font-size: 13px;
    }

    .text-center {
        text-align: center;
    }

    .text-muted {
        color: #888;
        font-size: 12px;
    }

    /* Alert Sederhana */
    .alert-simple {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-success {
        background-color: #dff0d8;
        border-color: #d6e9c6;
        color: #3c763d;
    }

    .alert-error {
        background-color: #f2dede;
        border-color: #ebccd1;
        color: #a94442;
    }
</style>

<div class="plain-container">

    <div class="plain-header">
        <h2 class="plain-title">Daftar Booking</h2>
        <a href="<?= base_url('admin/booking/tambah') ?>" class="btn-plain">+ Tambah Data</a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert-simple alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert-simple alert-error"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>

    <div style="overflow-x: auto;">
        <table class="plain-table">
            <thead>
                <tr>
                    <th width="5%" class="text-center">No</th>
                    <th width="15%">Nama Pelanggan</th>
                    <th width="12%">No. HP</th>
                    <th width="15%">Email</th>
                    <th width="15%">Layanan</th>
                    <th width="13%">Stylist</th>
                    <th width="15%">Jadwal</th>
                    <th width="10%">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php if (!empty($bookings) && is_array($bookings)): ?>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>

                            <td>
                                <strong><?= esc($booking['name']) ?></strong><br>
                                <span class="text-muted">ID: #<?= esc($booking['id']) ?></span>
                            </td>

                            <td><?= esc($booking['phone']) ?></td>

                            <td><?= esc($booking['email']) ?></td>

                            <td><?= esc($booking['nama_layanan'] ?? 'ID: ' . $booking['id_layanan']) ?></td>

                            <td>
                                <?php if (!empty($booking['nama_capster'])) : ?>
                                    <?= esc($booking['nama_capster']) ?>
                                <?php else : ?>
                                    -
                                <?php endif; ?>
                            </td>

                            <td>
                                <?= esc($booking['tanggal']) ?><br>
                                <small><?= esc($booking['jam']) ?></small>
                            </td>

                            <td>
                                <form action="<?= base_url('admin/update_status/' . $booking['id']) ?>" method="post">
                                    <?= csrf_field() ?>
                                    <select name="status" onchange="this.form.submit()" class="status-select-plain">
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
                        <td colspan="8" class="text-center" style="padding: 20px;">Data kosong.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<?= $this->endSection(); ?>