<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="admin-wrapper">
    <div class="admin-container">
        <div class="form-header">
            <h2 class="form-title">Edit Layanan</h2>
            <p class="form-subtitle">Perbarui informasi paket perawatan: <strong><?= esc($layanan['nama_layanan']) ?></strong></p>
        </div>

        <?php $validation = \Config\Services::validation(); ?>
        <?php if ($validation->getErrors()) : ?>
            <div class="alert alert-danger">
                <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                <div class="alert-content">
                    <?= $validation->listErrors() ?>
                </div>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('admin/layanan/update/' . $layanan['id']) ?>" method="post" class="admin-form">
            <?= csrf_field() ?>

            <div class="form-grid-single">
                <div class="form-group">
                    <label for="nama_layanan">Nama Layanan</label>
                    <input type="text" id="nama_layanan" name="nama_layanan"
                        class="form-control"
                        value="<?= old('nama_layanan') ?? esc($layanan['nama_layanan']) ?>"
                        placeholder="Contoh: Gentlemen Cut" required>
                </div>

                <div class="form-group">
                    <label for="harga">Harga (Rp)</label>
                    <div class="input-icon-wrapper">
                        <span class="currency-symbol">Rp</span>
                        <input type="number" id="harga" name="harga"
                            class="form-control pl-custom"
                            value="<?= old('harga') ?? esc($layanan['harga']) ?>"
                            placeholder="0" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Layanan</label>
                    <textarea id="deskripsi" name="deskripsi" rows="5"
                        class="form-control"
                        placeholder="Jelaskan detail layanan..."><?= old('deskripsi') ?? esc($layanan['deskripsi']) ?></textarea>
                </div>
            </div>

            <div class="form-actions">
                <a href="<?= base_url('admin/layanan') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* --- VARIABLES (Konsisten dengan seluruh admin panel) --- */
    :root {
        --primary-dark: #3E2723;
        --primary-gold: #D4AF37;
        --bg-color: #F8F9FA;
        --card-bg: #FFFFFF;
        --border-color: #E0E0E0;
        --text-color: #4A4A4A;
        --danger-color: #e74c3c;
        --input-bg: #FCFCFC;
    }

    /* --- LAYOUT UTAMA --- */
    .admin-wrapper {
        font-family: 'Poppins', sans-serif;
        background-color: var(--bg-color);
        padding: 40px 20px;
        min-height: 85vh;
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }

    .admin-container {
        background: var(--card-bg);
        width: 100%;
        max-width: 700px;
        /* Lebih ramping untuk form layanan */
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
        padding: 40px;
        border: 1px solid rgba(0, 0, 0, 0.02);
    }

    /* --- HEADER --- */
    .form-header {
        margin-bottom: 30px;
        border-bottom: 2px solid var(--bg-color);
        padding-bottom: 20px;
        text-align: center;
    }

    .form-title {
        color: var(--primary-dark);
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0 0 5px 0;
    }

    .form-subtitle {
        color: #888;
        font-size: 0.9rem;
        margin: 0;
    }

    /* --- ALERT ERROR --- */
    .alert {
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 25px;
        display: flex;
        align-items: flex-start;
        gap: 15px;
        font-size: 0.9rem;
    }

    .alert-danger {
        background-color: #FDEDEC;
        color: var(--danger-color);
        border: 1px solid #FADBD8;
    }

    .alert-content ul {
        margin: 0;
        padding-left: 20px;
    }

    /* --- FORM ELEMENTS --- */
    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        color: var(--primary-dark);
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid var(--border-color);
        background-color: var(--input-bg);
        border-radius: 10px;
        font-size: 0.95rem;
        color: var(--text-color);
        transition: all 0.3s ease;
        box-sizing: border-box;
    }

    .form-control:focus {
        border-color: var(--primary-gold);
        outline: none;
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.15);
        background-color: #fff;
    }

    /* Currency Input Style */
    .input-icon-wrapper {
        position: relative;
    }

    .currency-symbol {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .pl-custom {
        padding-left: 45px;
        /* Memberi ruang untuk 'Rp' */
    }

    /* --- BUTTONS --- */
    .form-actions {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: flex-end;
        gap: 15px;
    }

    .btn {
        padding: 12px 25px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.95rem;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .btn-secondary {
        background-color: #EFEFEF;
        color: #666;
    }

    .btn-secondary:hover {
        background-color: #E0E0E0;
        color: #333;
    }

    .btn-success {
        background-color: var(--primary-dark);
        color: var(--primary-gold);
        box-shadow: 0 4px 15px rgba(62, 39, 35, 0.2);
    }

    .btn-success:hover {
        background-color: #2D1B18;
        transform: translateY(-2px);
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .admin-container {
            padding: 25px;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<?= $this->endSection(); ?>