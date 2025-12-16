<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="admin-wrapper">
    <div class="admin-container">

        <div class="page-header">
            <div>
                <h2 class="page-title">Kelola Data Capster</h2>
                <p class="page-subtitle">Manajemen daftar stylist dan spesialisasi</p>
            </div>
            <a href="<?= base_url('admin/capster/create'); ?>" class="btn-add">
                <i class="fas fa-plus"></i> Tambah Capster
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
                        <th width="10%">Foto</th>
                        <th width="25%">Nama Capster</th>
                        <th width="15%">Gender</th>
                        <th width="25%">Spesialisasi</th>
                        <th width="20%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php if (!empty($capster)) : ?>
                        <?php foreach ($capster as $c) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>
                                    <div class="avatar-wrapper">
                                        <img src="<?= base_url('assets/img/capster/' . $c['foto']); ?>" alt="<?= $c['nama']; ?>">
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-bold"><?= esc($c['nama']); ?></span>
                                </td>
                                <td>
                                    <?php if ($c['jenis_kelamin'] == 'Pria'): ?>
                                        <span class="badge badge-male"><i class="fas fa-mars"></i> Pria</span>
                                    <?php else: ?>
                                        <span class="badge badge-female"><i class="fas fa-venus"></i> Wanita</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-muted"><?= esc($c['spesialisasi']); ?></td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        <a href="<?= base_url('admin/capster/edit/' . $c['id_capster']); ?>" class="btn-icon btn-edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="<?= base_url('admin/capster/delete/' . $c['id_capster']); ?>" method="post" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="POST">
                                            <button type="submit" class="btn-icon btn-delete" onclick="return confirm('Yakin ingin menghapus Capster <?= $c['nama']; ?>?')" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fas fa-user-slash"></i>
                                    <p>Belum ada data Capster saat ini.</p>
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
    /* --- VARIABLES (Sama dengan Edit Page) --- */
    :root {
        --primary-dark: #3E2723;
        --primary-gold: #D4AF37;
        --bg-color: #F8F9FA;
        --card-bg: #FFFFFF;
        --border-color: #E0E0E0;
        --text-main: #2d3436;
        --text-muted: #636e72;
    }

    /* --- LAYOUT UTAMA --- */
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
        /* Lebih lebar untuk tabel */
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
        transition: all 0.3s ease;
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
        font-size: 0.95rem;
    }

    /* --- TABEL STYLING --- */
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
        letter-spacing: 1px;
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

    .custom-table tr:last-child td {
        border-bottom: none;
    }

    /* --- AVATAR FOTO --- */
    .avatar-wrapper {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .avatar-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* --- BADGES GENDER --- */
    .badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .badge-male {
        background-color: #E3F2FD;
        color: #1976D2;
    }

    .badge-female {
        background-color: #FCE4EC;
        color: #C2185B;
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

    /* --- UTILS & EMPTY STATE --- */
    .text-center {
        text-align: center;
    }

    .text-muted {
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .fw-bold {
        font-weight: 600;
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

    /* --- RESPONSIVE --- */
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
    }
</style>

<?= $this->endSection() ?>