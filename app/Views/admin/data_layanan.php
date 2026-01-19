<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    /* VARIABLES (Consistent with Frontend) */
    :root {
        --primary-brown: #3e2b26;
        --secondary-brown: #5d4037;
        --accent-gold: #cba155;
        --bg-light: #fdfaf7;
        /* Cream background like frontend */
        --card-bg: #ffffff;
        --text-dark: #333;
        --text-muted: #777;
    }

    body {
        background-color: var(--bg-light);
        font-family: 'Montserrat', sans-serif;
    }

    /* CONTAINER UTAMA */
    .admin-wrapper {
        padding: 50px 20px;
        min-height: 90vh;
        max-width: 1000px;
        margin: 0 auto;
    }

    /* HEADER */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 2px dashed #e0d0c0;
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

    /* TOMBOL TAMBAH (Modern Pill) */
    .btn-add-service {
        background-color: var(--primary-brown);
        color: #fff;
        padding: 12px 25px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(62, 43, 38, 0.2);
    }

    .btn-add-service:hover {
        background-color: var(--secondary-brown);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(62, 43, 38, 0.3);
        color: #fff;
    }

    /* ALERT BOX */
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

    /* SERVICE LIST (CARD BASED LAYOUT) */
    .service-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .service-card {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
        border: 1px solid rgba(0, 0, 0, 0.02);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        border-color: rgba(203, 161, 85, 0.3);
    }

    /* Dekorasi Garis Kiri */
    .service-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 6px;
        background-color: var(--accent-gold);
        border-radius: 4px 0 0 4px;
        opacity: 0.7;
    }

    /* INFO SECTION */
    .service-info {
        flex-grow: 1;
        margin-left: 15px;
        margin-right: 20px;
    }

    .service-name {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--primary-brown);
        margin: 0 0 5px 0;
        font-family: 'Playfair Display', serif;
    }

    .service-desc {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin: 0;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* PRICE TAG */
    .service-price {
        background: #fdf5e6;
        color: #d35400;
        padding: 8px 16px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1rem;
        white-space: nowrap;
        margin-right: 20px;
        border: 1px solid rgba(211, 84, 0, 0.1);
    }

    /* ACTIONS BUTTONS */
    .service-actions {
        display: flex;
        gap: 10px;
    }

    .btn-action {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        font-size: 1rem;
    }

    .btn-edit {
        background: #e3f2fd;
        color: #1976d2;
    }

    .btn-edit:hover {
        background: #bbdefb;
        color: #0d47a1;
    }

    .btn-delete {
        background: #ffebee;
        color: #c62828;
    }

    .btn-delete:hover {
        background: #ffcdd2;
        color: #b71c1c;
    }

    /* EMPTY STATE */
    .empty-state {
        text-align: center;
        padding: 60px;
        color: #aaa;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .btn-add-service {
            width: 100%;
            justify-content: center;
        }

        .service-card {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .service-info {
            margin: 0;
            width: 100%;
        }

        .service-footer-mobile {
            display: flex;
            width: 100%;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            border-top: 1px dashed #eee;
            padding-top: 15px;
        }

        /* Menyembunyikan elemen desktop di mobile */
        .desktop-actions {
            display: none;
        }
    }

    @media (min-width: 769px) {
        .service-footer-mobile {
            display: none;
        }

        /* Sembunyikan footer mobile di desktop */
    }
</style>

<div class="admin-wrapper">

    <div class="page-header">
        <div>
            <h2 class="page-title">Kelola Layanan</h2>
            <p class="page-subtitle">Atur daftar menu perawatan dan harga untuk pelanggan.</p>
        </div>
        <a href="<?= base_url('admin/layanan/create') ?>" class="btn-add-service">
            <i class="fas fa-plus-circle"></i> Tambah Layanan Baru
        </a>
    </div>

    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert-modern">
            <i class="fas fa-check-circle fa-lg"></i>
            <span><?= session()->getFlashdata('pesan'); ?></span>
        </div>
    <?php endif; ?>

    <div class="service-list">

        <?php if (!empty($layanan)): ?>
            <?php foreach ($layanan as $row): ?>
                <div class="service-card">

                    <div class="service-info">
                        <h3 class="service-name"><?= esc($row['nama_layanan']) ?></h3>
                        <p class="service-desc"><?= esc($row['deskripsi']) ?></p>
                    </div>

                    <div class="desktop-actions" style="display:flex; align-items:center;">
                        <div class="service-price">Rp <?= number_format($row['harga'], 0, ',', '.') ?></div>

                        <div class="service-actions">
                            <a href="<?= base_url('admin/layanan/edit/' . $row['id']) ?>" class="btn-action btn-edit" title="Edit Layanan">
                                <i class="fas fa-pencil-alt"></i>
                            </a>

                            <form action="<?= base_url('admin/layanan/delete/' . $row['id']) ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus layanan ini?')" title="Hapus Permanen">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="service-footer-mobile">
                        <div class="service-price">Rp <?= number_format($row['harga'], 0, ',', '.') ?></div>

                        <div class="service-actions">
                            <a href="<?= base_url('admin/layanan/edit/' . $row['id']) ?>" class="btn-action btn-edit">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="<?= base_url('admin/layanan/delete/' . $row['id']) ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn-action btn-delete" onclick="return confirm('Hapus?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-clipboard-list fa-4x" style="opacity:0.2; margin-bottom:20px;"></i>
                <h3>Belum ada layanan tersedia</h3>
                <p>Silakan tambahkan layanan perawatan pertama Anda.</p>
            </div>
        <?php endif; ?>

    </div>

</div>

<?= $this->endSection(); ?>