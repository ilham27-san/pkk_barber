<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    /* VARIABLES (Consistent Theme) */
    :root {
        --primary-brown: #3e2b26;
        --secondary-brown: #5d4037;
        --accent-gold: #cba155;
        --bg-light: #fdfaf7;
        --card-bg: #ffffff;
        --text-dark: #333;
        --text-muted: #777;
        --border-color: #eee;

        /* Status Colors */
        --status-pending-bg: #fff3e0;
        --status-pending-text: #e65100;
        --status-confirmed-bg: #e3f2fd;
        --status-confirmed-text: #1565c0;
        --status-done-bg: #e8f5e9;
        --status-done-text: #2e7d32;
        --status-canceled-bg: #ffebee;
        --status-canceled-text: #c62828;
    }

    body {
        background-color: var(--bg-light);
        font-family: 'Montserrat', sans-serif;
    }

    /* CONTAINER */
    .admin-wrapper {
        padding: 50px 20px;
        min-height: 90vh;
        max-width: 1200px;
        /* Lebih lebar karena tabel booking banyak kolom */
        margin: 0 auto;
    }

    /* HEADER */
    .page-header {
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }

    .page-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: #ffffff;
        margin: 0;
        font-weight: 700;
    }

    .page-subtitle {
        color: #ffffff;
        font-size: 1rem;
        margin-top: 5px;
    }

    /* BUTTON ADD */
    .btn-add {
        background-color: var(--primary-brown);
        color: #fff;
        padding: 10px 20px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 10px rgba(62, 43, 38, 0.2);
        transition: all 0.3s;
    }

    .btn-add:hover {
        background-color: var(--secondary-brown);
        transform: translateY(-2px);
    }

    /* ALERT */
    .alert-modern {
        background: #e8f5e9;
        color: #2e7d32;
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 15px;
        border-left: 5px solid #2e7d32;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    /* --- TABLE CARD CONTAINER --- */
    .table-card {
        background: var(--card-bg);
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.02);
    }

    .table-responsive {
        overflow-x: auto;
    }

    /* TABLE STYLING */
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
        white-space: nowrap;
    }

    /* Table Head */
    .custom-table thead {
        background-color: #fcf8f3;
        border-bottom: 2px solid #e0d0c0;
    }

    .custom-table th {
        padding: 18px 20px;
        text-align: left;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--primary-brown);
    }

    /* Table Body */
    .custom-table tbody tr {
        transition: background-color 0.2s;
        border-bottom: 1px solid var(--border-color);
    }

    .custom-table tbody tr:last-child {
        border-bottom: none;
    }

    .custom-table tbody tr:hover {
        background-color: #fafafa;
    }

    .custom-table td {
        padding: 18px 20px;
        vertical-align: middle;
        color: var(--text-dark);
        font-size: 0.9rem;
    }

    /* --- CONTENT STYLING --- */

    /* Customer Info */
    .customer-name {
        font-weight: 700;
        color: var(--primary-brown);
        display: block;
        margin-bottom: 3px;
    }

    .booking-id {
        font-size: 0.75rem;
        color: #aaa;
        background: #f5f5f5;
        padding: 2px 6px;
        border-radius: 4px;
    }

    /* Contact Info */
    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 3px;
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .contact-info i {
        width: 15px;
        text-align: center;
        margin-right: 5px;
        color: var(--accent-gold);
    }

    /* Service & Stylist */
    .service-badge {
        font-weight: 600;
        color: var(--text-dark);
    }

    .stylist-name {
        color: var(--text-muted);
        font-size: 0.85rem;
        font-style: italic;
    }

    /* Date & Time */
    .datetime-box {
        text-align: center;
        border: 1px solid #eee;
        padding: 5px 10px;
        border-radius: 8px;
        background: #fff;
    }

    .date-val {
        font-weight: 700;
        display: block;
    }

    .time-val {
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    /* Status Dropdown Custom */
    .status-select {
        padding: 6px 10px;
        border-radius: 20px;
        border: none;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        outline: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        text-align: center;
        min-width: 100px;
    }

    /* Warna Status Dinamis */
    .status-pending {
        background-color: var(--status-pending-bg);
        color: var(--status-pending-text);
    }

    .status-confirmed {
        background-color: var(--status-confirmed-bg);
        color: var(--status-confirmed-text);
    }

    .status-done {
        background-color: var(--status-done-bg);
        color: var(--status-done-text);
    }

    .status-canceled {
        background-color: var(--status-canceled-bg);
        color: var(--status-canceled-text);
    }

    /* EMPTY STATE */
    .empty-state-row {
        text-align: center;
        padding: 50px !important;
    }

    .empty-content {
        color: #ccc;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    /* RESPONSIVE */
    @media (max-width: 992px) {

        .custom-table th,
        .custom-table td {
            padding: 15px;
        }
    }
</style>

<div class="admin-wrapper">

    <div class="page-header">
        <div>
            <h2 class="page-title">Daftar Booking</h2>
            <p class="page-subtitle">Kelola jadwal reservasi pelanggan yang masuk.</p>
        </div>
        <a href="<?= base_url('admin/booking/tambah') ?>" class="btn-add">
            <i class="fas fa-plus"></i> Booking Manual
        </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert-modern">
            <i class="fas fa-check-circle"></i>
            <span><?= session()->getFlashdata('success'); ?></span>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert-modern" style="color: #c62828; border-color: #c62828; background: #ffebee;">
            <i class="fas fa-exclamation-circle"></i>
            <span><?= session()->getFlashdata('error'); ?></span>
        </div>
    <?php endif; ?>

    <div class="table-card">
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th width="5%" style="text-align:center;">No</th>
                        <th width="20%">Pelanggan</th>
                        <th width="20%">Kontak</th>
                        <th width="20%">Layanan & Stylist</th>
                        <th width="15%" style="text-align:center;">Jadwal</th>
                        <th width="20%" style="text-align:center;">Status</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $no = 1; ?>
                    <?php if (!empty($bookings) && is_array($bookings)): ?>
                        <?php foreach ($bookings as $booking): ?>
                            <tr>
                                <td style="text-align:center; color:#aaa;"><?= $no++; ?></td>

                                <td>
                                    <span class="customer-name"><?= esc($booking['name']) ?></span>
                                    <span class="booking-id">ID: #<?= esc($booking['id']) ?></span>
                                </td>

                                <td>
                                    <div class="contact-info">
                                        <span><i class="fas fa-phone-alt"></i> <?= esc($booking['phone']) ?></span>
                                        <span><i class="far fa-envelope"></i> <?= esc($booking['email']) ?></span>
                                    </div>
                                </td>

                                <td>
                                    <div class="service-badge"><?= esc($booking['nama_layanan'] ?? '-') ?></div>
                                    <div class="stylist-name">
                                        <i class="fas fa-user-tie" style="font-size:0.7rem; margin-right:3px;"></i>
                                        <?= !empty($booking['nama_capster']) ? esc($booking['nama_capster']) : 'Random Stylist' ?>
                                    </div>
                                </td>

                                <td align="center">
                                    <div class="datetime-box">
                                        <span class="date-val"><?= esc($booking['tanggal']) ?></span>
                                        <span class="time-val"><?= esc($booking['jam']) ?> WIB</span>
                                    </div>
                                </td>

                                <td align="center">
                                    <form action="<?= base_url('admin/update_status/' . $booking['id']) ?>" method="post">
                                        <?= csrf_field() ?>

                                        <?php
                                        $status = $booking['status'] ?? 'pending';
                                        $statusClass = 'status-' . strtolower($status);
                                        ?>

                                        <select name="status" onchange="this.form.submit()" class="status-select <?= $statusClass ?>">
                                            <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Pending</option>
                                            <option value="confirmed" <?= $status === 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                            <option value="done" <?= $status === 'done' ? 'selected' : '' ?>>Done</option>
                                            <option value="canceled" <?= $status === 'canceled' ? 'selected' : '' ?>>Canceled</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="empty-state-row">
                                <div class="empty-content">
                                    <i class="far fa-calendar-times fa-3x"></i>
                                    <p>Belum ada data booking saat ini.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>