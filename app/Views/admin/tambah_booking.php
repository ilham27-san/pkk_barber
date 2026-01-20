<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    /* VARIABLES (Sama dengan tema Admin lainnya) */
    :root {
        --primary-brown: #3e2b26;
        --secondary-brown: #5d4037;
        --accent-gold: #cba155;
        --bg-light: #fdfaf7;
        --card-bg: #ffffff;
        --text-dark: #333;
        --border-color: #eee;
    }

    body {
        background-color: var(--bg-light);
        font-family: 'Montserrat', sans-serif;
    }

    /* CONTAINER */
    .booking-page-wrapper {
        padding: 50px 20px;
        min-height: 90vh;
        max-width: 700px;
        margin: 0 auto;
    }

    /* HEADER */
    .page-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .page-title {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        color: var(--primary-brown);
        font-weight: 700;
        margin-bottom: 10px;
    }

    .page-subtitle {
        color: #777;
        font-size: 0.95rem;
    }

    /* CARD FORM */
    .form-card {
        background: var(--card-bg);
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 0, 0, 0.02);
    }

    /* FORM GROUPS */
    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--primary-brown);
        font-size: 0.9rem;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 10px;
        font-family: 'Montserrat', sans-serif;
        font-size: 0.95rem;
        transition: all 0.3s;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--accent-gold);
        box-shadow: 0 0 0 3px rgba(203, 161, 85, 0.1);
    }

    /* BUTTONS */
    .btn-submit {
        width: 100%;
        padding: 15px;
        background-color: var(--primary-brown);
        color: white;
        font-weight: 700;
        font-size: 1rem;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .btn-submit:hover {
        background-color: var(--secondary-brown);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(62, 43, 38, 0.2);
    }

    .btn-back {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #999;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .btn-back:hover {
        color: var(--primary-brown);
    }

    /* ALERT */
    .alert-error {
        background: #ffebee;
        color: #c62828;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 25px;
        border-left: 5px solid #c62828;
        font-size: 0.9rem;
    }
</style>

<div class="booking-page-wrapper">

    <div class="page-header">
        <h2 class="page-title">Tambah Booking Manual</h2>
        <p class="page-subtitle">Form untuk admin memasukkan data pelanggan walk-in atau reservasi telepon.</p>
    </div>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert-error">
            <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert-error">
            <ul style="margin: 0; padding-left: 20px;">
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="form-card">
        <form action="<?= base_url('admin/booking/simpan') ?>" method="post">
            <?= csrf_field(); ?>

            <h4 style="margin-bottom:15px; color:#cba155; border-bottom:1px solid #eee; padding-bottom:10px;">Data Pelanggan</h4>

            <div class="form-group">
                <label class="form-label">Nama Pelanggan</label>
                <input type="text" name="name" class="form-control" placeholder="Masukkan nama pelanggan" value="<?= old('name') ?>" required>
            </div>

            <div class="row" style="display:flex; gap:15px; flex-wrap:wrap;">
                <div class="form-group" style="flex:1; min-width: 200px;">
                    <label class="form-label">Nomor HP</label>
                    <input type="text" name="phone" class="form-control" placeholder="08..." value="<?= old('phone') ?>" required>
                </div>
                <div class="form-group" style="flex:1; min-width: 200px;">
                    <label class="form-label">Email (Opsional)</label>
                    <input type="email" name="email" class="form-control" placeholder="email@contoh.com" value="<?= old('email') ?>">
                </div>
            </div>

            <h4 style="margin:25px 0 15px; color:#cba155; border-bottom:1px solid #eee; padding-bottom:10px;">Detail Layanan</h4>

            <div class="form-group">
                <label class="form-label">Pilih Layanan</label>
                <select name="id_layanan" class="form-control" required>
                    <option value="">-- Pilih Layanan --</option>
                    <?php if (!empty($layanans)): ?>
                        <?php foreach ($layanans as $layanan): ?>
                            <option value="<?= $layanan['id'] ?>" <?= old('id_layanan') == $layanan['id'] ? 'selected' : '' ?>>
                                <?= esc($layanan['nama_layanan']) ?> - Rp <?= number_format($layanan['harga'], 0, ',', '.') ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Pilih Stylist / Capster</label>

                <select name="id_capster" class="form-control">
                    <option value="">-- Bebas / Siapa Saja (Auto Assign) --</option>
                    <?php if (!empty($stylists)): ?>
                        <?php foreach ($stylists as $s): ?>
                            <option value="<?= $s['id_capster'] ?>" <?= old('id_capster') == $s['id_capster'] ? 'selected' : '' ?>>
                                <?= esc($s['nama']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <small style="color: #999; font-size: 0.8rem; margin-top: 5px; display: block;">
                    *Biarkan opsi "Bebas" jika pelanggan tidak memilih. Sistem akan mencarikan stylist yang kosong.
                </small>
            </div>

            <div class="row" style="display:flex; gap:15px; flex-wrap:wrap;">
                <div class="form-group" style="flex:1; min-width: 200px;">
                    <label class="form-label">Tanggal Booking</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= old('tanggal', date('Y-m-d')) ?>" required>
                </div>
                <div class="form-group" style="flex:1; min-width: 200px;">
                    <label class="form-label">Jam Booking</label>
                    <input type="time" name="jam" class="form-control" value="<?= old('jam', date('H:i')) ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Catatan Tambahan</label>
                <textarea name="note" class="form-control" rows="3" placeholder="Contoh: Model rambut pendek samping..."><?= old('note') ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Status Awal</label>
                <select name="status" class="form-control">
                    <option value="pending">Pending (Menunggu)</option>
                    <option value="confirmed" selected>Confirmed (Disetujui)</option>
                    <option value="process">In Process (Langsung Dikerjakan)</option>
                    <option value="done">Done (Selesai)</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Simpan Data Booking
            </button>

            <a href="<?= base_url('admin/booking') ?>" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
            </a>

        </form>
    </div>
</div>

<?= $this->endSection(); ?>