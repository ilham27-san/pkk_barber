<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="admin-wrapper">
    <div class="admin-container">

        <div class="page-header">
            <div>
                <h2 class="page-title">Kelola Layanan</h2>
                <p class="page-subtitle">Daftar paket perawatan dan harga</p>
            </div>
            <a href="<?= base_url('admin/layanan/create') ?>" class="btn-add">
                <i class="fas fa-plus"></i> Tambah Layanan
            </a>
        </div>

        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert-box">
                <i class="fas fa-check-circle"></i>
                <span><?= session()->getFlashdata('pesan'); ?></span>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="25%">Nama Layanan</th>
                        <th width="20%">Harga</th>
                        <th width="35%">Deskripsi</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php if (!empty($layanan)): ?>
                        <?php foreach ($layanan as $row): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>
                                    <span class="fw-bold text-dark"><?= esc($row['nama_layanan']) ?></span>
                                </td>
                                <td>
                                    <span class="price-tag">
                                        Rp <?= number_format($row['harga'], 0, ',', '.') ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="desc-truncate" title="<?= esc($row['deskripsi']) ?>">
                                        <?= esc($row['deskripsi']) ?>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        <a href="<?= base_url('admin/layanan/edit/' . $row['id']) ?>" class="btn-icon btn-edit" title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <form action="<?= base_url('admin/layanan/delete/' . $row['id']) ?>" method="post" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn-icon btn-delete" onclick="return confirm('Yakin ingin menghapus layanan ini?')" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="fas fa-box-open"></i>
                                    <p>Belum ada data layanan tersedia.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* --- VARIABLES & LAYOUT (Konsisten dengan halaman Capster) --- */
    :root {
        --primary-dark: #3E2723;
        --primary-gold: #D4AF37;
        --bg-color: #F8F9FA;
        --card-bg: #FFFFFF;
        --border-color: #E0E0E0;
        --text-main: #2d3436;
        --text-muted: #636e72;
    }

    .admin-wrapper {
        font-family: 'Poppins', sans-serif;
        background-color: var(--bg-color);
        padding: 40px 20px;
        min-height: 85vh;
        display: flex;
        justify-content: center;
    }

    .admin-container {
        background: var(--card-bg);
        width: 100%;
        max-width: 1100px;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
        padding: 40px;
        border: 1px solid rgba(0, 0, 0, 0.02);
    }

    /* --- HEADER --- */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 20px;
    }

    .page-title {
        color: var(--primary-dark);
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
    }

    .page-subtitle {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin: 5px 0 0 0;
    }

    /* --- TOMBOL ADD --- */
    .btn-add {
        background-color: var(--primary-dark);
        color: var(--primary-gold);
        padding: 10px 20px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: 0.3s;
        box-shadow: 0 4px 10px rgba(62, 39, 35, 0.2);
    }

    .btn-add:hover {
        background-color: #2D1B18;
        transform: translateY(-2px);
        color: #fff;
    }

    /* --- ALERT --- */
    .alert-box {
        background: #D1E7DD;
        color: #0F5132;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* --- TABEL --- */
    .table-responsive {
        overflow-x: auto;
    }

    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-top: 10px;
    }

    .custom-table th {
        background-color: #FAFAFA;
        color: var(--primary-dark);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        padding: 15px;
        border-bottom: 2px solid var(--border-color);
        text-align: left;
    }

    .custom-table td {
        padding: 15px;
        vertical-align: middle;
        border-bottom: 1px solid var(--border-color);
        color: var(--text-main);
        font-size: 0.95rem;
    }

    .custom-table tr:hover td {
        background-color: #FAFAFA;
    }

    /* --- SPESIFIK LAYANAN --- */
    .price-tag {
        font-weight: 700;
        color: var(--primary-dark);
        background: #F5F0E6;
        /* Cream muda */
        padding: 5px 10px;
        border-radius: 8px;
        font-size: 0.9rem;
    }

    /* Membatasi panjang deskripsi agar tabel tidak hancur */
    .desc-truncate {
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: var(--text-muted);
        font-size: 0.85rem;
    }

    /* --- ACTION BUTTONS --- */
    .action-buttons {
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    .btn-icon {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: 0.2s;
        text-decoration: none;
    }

    .btn-edit {
        background-color: #FFF3E0;
        color: #F57C00;
    }

    .btn-edit:hover {
        background-color: #FFE0B2;
    }

    .btn-delete {
        background-color: #FFEBEE;
        color: #D32F2F;
    }

    .btn-delete:hover {
        background-color: #FFCDD2;
    }

    /* --- UTILS --- */
    .text-center {
        text-align: center;
    }

    .fw-bold {
        font-weight: 600;
    }

    .text-dark {
        color: #2d3436;
    }

    .d-inline {
        display: inline-block;
    }

    .empty-state {
        text-align: center;
        padding: 40px;
        color: #aaa;
    }

    .empty-state i {
        font-size: 2rem;
        margin-bottom: 10px;
        display: block;
    }

    /* --- MOBILE --- */
    @media (max-width: 768px) {
        .admin-container {
            padding: 20px;
        }

        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .btn-add {
            width: 100%;
            justify-content: center;
        }

        .desc-truncate {
            max-width: 150px;
        }

        /* Deskripsi lebih pendek di HP */
    }
</style>

<?= $this->endSection(); ?>