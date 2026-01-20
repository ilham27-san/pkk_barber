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
        --status-process-bg: #e0f7fa;
        --status-process-text: #006064;
        --status-done-bg: #e8f5e9;
        --status-done-text: #2e7d32;
        --status-canceled-bg: #ffebee;
        --status-canceled-text: #c62828;
        --status-noshow-bg: #212121;
        /* Hitam/Gelap */
        --status-noshow-text: #fff;
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
        color: var(--primary-brown);
        margin: 0;
        font-weight: 700;
    }

    .page-subtitle {
        color: var(--text-muted);
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
        color: #fff;
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

    /* UPDATE CSS INDIKATOR TELAT (SUPPORT DARK MODE) */
    .row-late td {
        background-color: rgba(220, 53, 69, 0.2) !important;
        box-shadow: inset 5px 0 0 #dc3545;
    }

    .badge-late {
        background: #ff4d4d;
        color: #fff;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.7rem;
        font-weight: 800;
        margin-top: 8px;
        display: inline-block;
        box-shadow: 0 0 8px rgba(255, 77, 77, 0.6);
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(1.05);
            opacity: 0.8;
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* --- CONTENT STYLING --- */

    /* Customer Info */
    .customer-name {
        font-weight: 700;
        color: var(--primary-brown);
        display: block;
        margin-bottom: 3px;
        font-size: 1rem;
    }

    /* GAYA BARU: BOOKING CODE BADGE */
    .booking-code-badge {
        font-family: 'Courier New', Courier, monospace;
        /* Monospace biar kesan teknikal */
        font-weight: 700;
        font-size: 0.75rem;
        color: #555;
        background: #f0f0f0;
        padding: 3px 8px;
        border-radius: 4px;
        border: 1px solid #ddd;
        letter-spacing: 1px;
    }

    /* Contact Info & WA Button */
    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 5px;
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    /* Tombol WA Mini */
    .btn-wa-mini {
        background-color: #25D366;
        color: white;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s;
        box-shadow: 0 2px 5px rgba(37, 211, 102, 0.3);
    }

    .btn-wa-mini:hover {
        background-color: #128C7E;
        transform: scale(1.15);
        color: white;
    }

    .contact-row {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .contact-row i {
        width: 15px;
        text-align: center;
        color: var(--accent-gold);
    }

    /* Service & Stylist */
    .service-badge {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 4px;
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
        color: var(--primary-brown);
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
        text-align: center;
        min-width: 120px;
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

    .status-process {
        background-color: var(--status-process-bg);
        color: var(--status-process-text);
    }

    .status-done {
        background-color: var(--status-done-bg);
        color: var(--status-done-text);
    }

    .status-canceled {
        background-color: var(--status-canceled-bg);
        color: var(--status-canceled-text);
    }

    .status-no_show {
        background-color: var(--status-noshow-bg);
        color: var(--status-noshow-text);
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
                        <th width="25%">Layanan & Stylist</th>
                        <th width="15%" style="text-align:center;">Jadwal</th>
                        <th width="15%" style="text-align:center;">Status</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $no = 1; ?>
                    <?php if (!empty($bookings) && is_array($bookings)): ?>
                        <?php foreach ($bookings as $booking): ?>

                            <?php
                            // Setup Class Status
                            $status = $booking['status'] ?? 'pending';
                            $statusClass = 'status-' . strtolower($status);

                            // Logic WhatsApp Link
                            $hp = $booking['phone'];
                            $hp = preg_replace('/[^0-9]/', '', $hp); // Bersihkan selain angka
                            if (substr($hp, 0, 2) == '08') {
                                $hp = '62' . substr($hp, 1);
                            }

                            // --- UPDATE: MENAMBAHKAN TANGGAL/HARI KE PESAN WA ---
                            // Gunakan display_date yang sudah berisi "Hari, Tanggal" dari Model
                            $textWA = "Halo Kak " . esc($booking['name']) . ", kami dari SANBARBERS mau konfirmasi booking untuk " . $booking['display_date'] . " pukul " . $booking['display_time'] . " WIB.";

                            $linkWA = "https://wa.me/" . $hp . "?text=" . urlencode($textWA);
                            ?>

                            <tr class="<?= $booking['is_late'] ? 'row-late' : '' ?>">
                                <td style="text-align:center; color:#aaa;"><?= $no++; ?></td>

                                <td>
                                    <span class="customer-name"><?= esc($booking['name']) ?></span>

                                    <span class="booking-code-badge"><?= $booking['booking_code'] ?></span>

                                    <div style="margin-top:5px; font-size:0.75rem;">
                                        <?php if ($booking['source'] == 'walk_in'): ?>
                                            <span class="badge bg-secondary text-white" style="padding:2px 6px; border-radius:4px;">Walk-In</span>
                                        <?php else: ?>
                                            <span class="badge bg-info text-dark" style="padding:2px 6px; border-radius:4px;">Online</span>
                                        <?php endif; ?>
                                    </div>

                                    <?php if ($booking['is_late']): ?>
                                        <br>
                                        <span class="badge-late">
                                            <i class="fas fa-exclamation-triangle"></i> TERLAMBAT > 15 MENIT
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <div class="contact-info">
                                        <div class="contact-row">
                                            <i class="fas fa-phone-alt"></i>
                                            <span><?= esc($booking['phone']) ?></span>

                                            <a href="<?= $linkWA ?>" target="_blank" class="btn-wa-mini" title="Chat via WhatsApp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        </div>

                                        <?php if (!empty($booking['email'])): ?>
                                            <div class="contact-row">
                                                <i class="far fa-envelope"></i>
                                                <span><?= esc($booking['email']) ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>

                                <td>
                                    <div class="service-badge"><?= esc($booking['nama_layanan'] ?? 'Layanan Dihapus') ?></div>
                                    <div class="stylist-name">
                                        <i class="fas fa-user-tie" style="font-size:0.7rem; margin-right:3px;"></i>
                                        <?php
                                        if (!empty($booking['nama_capster'])) {
                                            echo esc($booking['nama_capster']);
                                        } else {
                                            echo '<span style="color:#999;">Any / Random Stylist</span>';
                                        }
                                        ?>
                                    </div>
                                </td>

                                <td align="center">
                                    <div class="datetime-box">
                                        <span class="date-val"><?= $booking['display_date'] ?></span>
                                        <span class="time-val"><?= $booking['display_time'] ?> WIB</span>
                                    </div>
                                </td>

                                <td align="center">
                                    <form action="<?= base_url('admin/update_status/' . $booking['id']) ?>" method="post">
                                        <?= csrf_field() ?>

                                        <select name="status" onchange="this.form.submit()" class="status-select <?= $statusClass ?>">
                                            <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Pending</option>
                                            <option value="confirmed" <?= $status === 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                            <option value="process" <?= $status === 'process' ? 'selected' : '' ?>>In Process</option>
                                            <option value="done" <?= $status === 'done' ? 'selected' : '' ?>>Done</option>
                                            <option value="canceled" <?= $status === 'canceled' ? 'selected' : '' ?>>Canceled</option>
                                            <option value="no_show" <?= $status === 'no_show' ? 'selected' : '' ?>>No Show (Hangus)</option>
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