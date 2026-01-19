<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    /* VARIABLES (Consistent with Frontend & Service Page) */
    :root {
        --primary-brown: #3e2b26;
        --secondary-brown: #5d4037;
        --accent-gold: #cba155;
        --bg-light: #fdfaf7;
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
    .btn-add-capster {
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

    .btn-add-capster:hover {
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

    /* CAPSTER LIST (CARD BASED LAYOUT) */
    .capster-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .capster-card {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 20px;
        display: flex;
        align-items: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
        border: 1px solid rgba(0, 0, 0, 0.02);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .capster-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        border-color: rgba(203, 161, 85, 0.3);
    }

    /* Dekorasi Garis Kiri */
    .capster-card::before {
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

    /* AVATAR */
    .capster-avatar {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        margin-left: 15px;
        margin-right: 20px;
        border: 3px solid #fdf5e6;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* INFO SECTION */
    .capster-info {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .capster-name {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary-brown);
        margin: 0 0 5px 0;
        font-family: 'Playfair Display', serif;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .capster-details {
        display: flex;
        gap: 15px;
        align-items: center;
        font-size: 0.9rem;
        color: var(--text-muted);
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* BADGE GENDER */
    .badge-gender {
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin-left: 10px;
    }

    .gender-male {
        background: #e3f2fd;
        color: #1976d2;
    }

    .gender-female {
        background: #fce4ec;
        color: #c2185b;
    }

    /* ACTIONS BUTTONS */
    .capster-actions {
        display: flex;
        gap: 10px;
        margin-left: 20px;
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

        .btn-add-capster {
            width: 100%;
            justify-content: center;
        }

        .capster-card {
            flex-direction: column;
            text-align: center;
            padding: 30px 20px;
        }

        .capster-avatar {
            margin: 0 0 15px 0;
            width: 90px;
            height: 90px;
        }

        .capster-info {
            width: 100%;
            align-items: center;
        }

        .capster-name {
            justify-content: center;
            flex-wrap: wrap;
        }

        .capster-details {
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .capster-actions {
            margin: 20px 0 0 0;
            width: 100%;
            justify-content: center;
            border-top: 1px dashed #eee;
            padding-top: 15px;
        }
    }
</style>

<div class="admin-wrapper">

    <div class="page-header">
        <div>
            <h2 class="page-title">Kelola Data Capster</h2>
            <p class="page-subtitle">Manajemen daftar stylist, keahlian, dan profil.</p>
        </div>
        <a href="<?= base_url('admin/capster/create'); ?>" class="btn-add-capster">
            <i class="fas fa-user-plus"></i> Tambah Capster Baru
        </a>
    </div>

    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert-modern">
            <i class="fas fa-check-circle fa-lg"></i>
            <span><?= session()->getFlashdata('pesan'); ?></span>
        </div>
    <?php endif; ?>

    <div class="capster-list">

        <?php if (!empty($capster)): ?>
            <?php foreach ($capster as $c): ?>
                <div class="capster-card">

                    <img src="<?= base_url('assets/img/capster/' . $c['foto']); ?>"
                        alt="<?= esc($c['nama']); ?>"
                        class="capster-avatar"
                        onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode($c['nama']) ?>&background=random';">

                    <div class="capster-info">
                        <div class="capster-name">
                            <?= esc($c['nama']); ?>

                            <?php if ($c['jenis_kelamin'] == 'Pria'): ?>
                                <span class="badge-gender gender-male"><i class="fas fa-mars"></i> Pria</span>
                            <?php else: ?>
                                <span class="badge-gender gender-female"><i class="fas fa-venus"></i> Wanita</span>
                            <?php endif; ?>
                        </div>

                        <div class="capster-details">
                            <span class="detail-item">
                                <i class="fas fa-cut" style="color:var(--accent-gold);"></i>
                                <?= esc($c['spesialisasi']); ?>
                            </span>
                        </div>
                    </div>

                    <div class="capster-actions">
                        <a href="<?= base_url('admin/capster/edit/' . $c['id_capster']); ?>" class="btn-action btn-edit" title="Edit Profil">
                            <i class="fas fa-pencil-alt"></i>
                        </a>

                        <form action="<?= base_url('admin/capster/delete/' . $c['id_capster']); ?>" method="post" class="d-inline">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="POST"> <button type="submit" class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus Capster <?= esc($c['nama']); ?>?')" title="Hapus Permanen">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>

                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-users-slash fa-4x" style="opacity:0.2; margin-bottom:20px;"></i>
                <h3>Belum ada data Capster</h3>
                <p>Silakan tambahkan stylist pertama Anda.</p>
            </div>
        <?php endif; ?>

    </div>

</div>

<?= $this->endSection(); ?>