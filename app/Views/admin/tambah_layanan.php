<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="admin-container">
    <div class="content-box">
        <h2 class="admin-title">Tambah Layanan</h2>

        <form action="<?= base_url('admin/layanan/store') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="nama_layanan">Nama Layanan</label>
                <input type="text" id="nama_layanan" name="nama_layanan"
                    value="<?= old('nama_layanan') ?>" required>
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" id="harga" name="harga"
                    value="<?= old('harga') ?>" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" required><?= old('deskripsi') ?></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Simpan</button>
                <a href="<?= base_url('admin/layanan') ?>" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<style>
    /* Container utama */
    .admin-container {
        max-width: 600px;
        margin: 40px auto;
        padding: 0 20px;
        font-family: Arial, sans-serif;
    }

    /* Kotak konten */
    .content-box {
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Judul */
    .admin-title {
        margin-bottom: 25px;
        font-size: 24px;
        font-weight: 600;
        color: #333;
        text-align: center;
    }

    /* Form group */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #555;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        box-sizing: border-box;
        transition: border-color 0.3s;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #007BFF;
        outline: none;
    }

    /* Tombol */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
    }

    .btn-primary {
        background-color: #007BFF;
        color: #fff;
        padding: 10px 18px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        text-decoration: none;
        font-size: 14px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: #fff;
        padding: 10px 18px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        text-align: center;
        font-size: 14px;
        cursor: pointer;
    }

    .btn-secondary:hover {
        background-color: #565e64;
    }
</style>

<?= $this->endSection(); ?>