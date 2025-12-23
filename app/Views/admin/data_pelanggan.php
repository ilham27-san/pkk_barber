<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    /* --- VARIABLES & THEME --- */
    :root {
        --primary-brown: #4e342e;
        --secondary-brown: #795548;
        --accent-gold: #d4af37;
        --soft-gold: #f9f3e0;
        --bg-body: #fdfaf7;
        --card-surface: #ffffff;
        --text-main: #333;
        --text-muted: #888;
        --shadow-soft: 0 10px 40px -10px rgba(78, 52, 46, 0.1);
        --shadow-hover: 0 20px 50px -10px rgba(78, 52, 46, 0.2);
    }

    body {
        background-color: var(--bg-body);
        font-family: 'Montserrat', sans-serif;
    }

    /* LAYOUT WRAPPER */
    .admin-wrapper {
        padding: 60px 20px;
        min-height: 90vh;
        max-width: 1100px;
        margin: 0 auto;
    }

    /* HEADER SECTION */
    .page-header {
        text-align: center;
        margin-bottom: 50px;
        position: relative;
    }

    .page-title {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        font-weight: 800;
        margin: 0;
        /* Gradient Text Effect */
        background: #5C2C27;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }

    .page-subtitle {
        color: var(--secondary-brown);
        font-size: 1.05rem;
        margin-top: 10px;
        font-weight: 500;
        opacity: 0.8;
        letter-spacing: 0.5px;
    }

    /* --- TABLE CARD CONTAINER --- */
    .table-card {
        background: var(--card-surface);
        border-radius: 20px;
        box-shadow: var(--shadow-soft);
        overflow: hidden;
        /* Round corners clip */
        border: 1px solid rgba(255, 255, 255, 0.5);
        position: relative;
    }

    /* Dekorasi Top Bar pada Card */
    .table-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, var(--primary-brown), var(--accent-gold));
    }

    /* TABLE STYLES */
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    /* Table Head */
    .custom-table thead {
        background-color: var(--soft-gold);
        /* Latar Header Cream Gold */
        border-bottom: 2px solid #eee;
    }

    .custom-table th {
        padding: 25px 30px;
        text-align: left;
        font-size: 0.8rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--primary-brown);
    }

    /* Table Body */
    .custom-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #f5f5f5;
        cursor: default;
    }

    .custom-table tbody tr:last-child {
        border-bottom: none;
    }

    .custom-table tbody tr:hover {
        background-color: #fffbf5;
        /* Efek hover sangat halus */
        transform: scale(1.005);
        /* Sedikit membesar */
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
        z-index: 10;
        position: relative;
    }

    .custom-table td {
        padding: 20px 30px;
        vertical-align: middle;
        color: var(--text-main);
    }

    /* --- CONTENT STYLING --- */

    /* Profile Wrapper */
    .profile-wrapper {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .avatar-box {
        position: relative;
        padding: 3px;
        border: 2px solid #eee;
        border-radius: 50%;
        /* Ring luar */
        transition: border-color 0.3s;
    }

    .custom-table tbody tr:hover .avatar-box {
        border-color: var(--accent-gold);
    }

    .avatar-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        color: #fff;
        font-weight: 700;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .profile-text {
        display: flex;
        flex-direction: column;
    }

    .user-name {
        font-weight: 700;
        font-size: 1.05rem;
        color: var(--primary-brown);
        font-family: 'Playfair Display', serif;
    }

    .user-badge {
        font-size: 0.7rem;
        font-weight: 700;
        color: #fff;
        background: var(--accent-gold);
        padding: 2px 8px;
        border-radius: 10px;
        display: inline-block;
        width: fit-content;
        margin-top: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 5px rgba(212, 175, 55, 0.3);
    }

    /* Email Styling */
    .email-container {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: var(--text-muted);
        font-size: 0.95rem;
        font-weight: 500;
        padding: 8px 15px;
        border-radius: 50px;
        background: #fafafa;
        border: 1px solid #f0f0f0;
        transition: all 0.3s;
    }

    .custom-table tbody tr:hover .email-container {
        background: #fff;
        border-color: var(--accent-gold);
        color: var(--primary-brown);
    }

    .email-container i {
        color: #ccc;
        transition: color 0.3s;
    }

    .custom-table tbody tr:hover .email-container i {
        color: var(--accent-gold);
    }

    /* ID Badge Styling */
    .id-wrapper {
        text-align: right;
    }

    .id-ticket {
        font-family: 'Courier New', monospace;
        font-weight: 700;
        color: var(--secondary-brown);
        background: #efebe9;
        padding: 6px 12px;
        border-radius: 6px;
        border-left: 3px solid var(--primary-brown);
        font-size: 0.9rem;
        letter-spacing: 1px;
    }

    /* EMPTY STATE */
    .empty-row td {
        text-align: center;
        padding: 80px;
    }

    .empty-content {
        color: #ccc;
        opacity: 0.6;
    }

    /* RESPONSIVE MOBILE */
    @media (max-width: 768px) {
        .custom-table thead {
            display: none;
        }

        .custom-table tbody tr {
            display: flex;
            flex-direction: column;
            padding: 25px;
            gap: 15px;
            border-bottom: 8px solid var(--bg-body);
            /* Jarak antar kartu di HP */
        }

        .custom-table td {
            padding: 0;
            border: none;
        }

        .profile-wrapper {
            margin-bottom: 10px;
        }

        .id-wrapper {
            text-align: left;
            margin-top: 10px;
        }
    }
</style>

<div class="admin-wrapper">

    <div class="page-header">
        <h2 class="page-title">Daftar Pelanggan</h2>
        <p class="page-subtitle">Kelola data eksklusif pelanggan BarberNow.</p>
    </div>

    <div class="table-card">
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th width="40%">Profil Pelanggan</th>
                        <th width="40%">Kontak Email</th>
                        <th width="20%" style="text-align:right;">ID Member</th>
                    </tr>
                </thead>
                <tbody>

                    <?php if (!empty($pelanggan)): ?>
                        <?php foreach ($pelanggan as $p): ?>
                            <tr>
                                <td>
                                    <div class="profile-wrapper">
                                        <div class="avatar-box">
                                            <div class="avatar-circle" style="background: <?= getGradientColor($p['username']) ?>;">
                                                <?= strtoupper(substr($p['username'], 0, 1)) ?>
                                            </div>
                                        </div>

                                        <div class="profile-text">
                                            <span class="user-name"><?= esc($p['username']) ?></span>
                                            <span class="user-badge">Registered</span>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="email-container">
                                        <i class="fas fa-envelope"></i>
                                        <?= esc($p['email']) ?>
                                    </div>
                                </td>

                                <td>
                                    <div class="id-wrapper">
                                        <span class="id-ticket">#<?= str_pad($p['id'], 3, '0', STR_PAD_LEFT) ?></span>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <tr class="empty-row">
                            <td colspan="3">
                                <div class="empty-content">
                                    <i class="fas fa-user-clock fa-3x" style="margin-bottom:15px;"></i>
                                    <p>Belum ada data pelanggan yang tersedia.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>

</div>

<?php
function getGradientColor($string)
{
    $gradients = [
        'linear-gradient(135deg, #FF9A9E 0%, #FECFEF 100%)', // Pink
        'linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%)', // Purple
        'linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%)', // Green-Blue
        'linear-gradient(135deg, #ff9a9e 0%, #fecfef 99%, #fecfef 100%)', // Peach
        'linear-gradient(135deg, #fccb90 0%, #d57eeb 100%)', // Gold-Purple
        'linear-gradient(135deg, #e0c3fc 0%, #8ec5fc 100%)', // Soft Blue
    ];
    $index = strlen($string) % count($gradients);
    return $gradients[$index];
}
?>

<?= $this->endSection(); ?>