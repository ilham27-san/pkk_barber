<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="admin-container">
    <div class="content-box">
        <h2 class="admin-title">Edit Gallery</h2>
        <form action="<?= base_url('admin/gallery/update/' . $item['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div style="margin-bottom: 15px;">
                <label>Judul Foto:</label>
                <input type="text" name="judul" value="<?= $item['judul'] ?>" required style="width: 100%; padding: 8px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label>Deskripsi:</label>
                <textarea name="deskripsi" required style="width: 100%; padding: 8px;" rows="3"><?= $item['deskripsi'] ?></textarea>
            </div>
            <div style="margin-bottom: 15px;">
                <label>Gambar Saat Ini:</label><br>
                <img src="<?= base_url('img/gallery/' . $item['gambar']) ?>" width="150" style="margin-bottom: 10px; border-radius: 8px;">
                <br>
                <label>Ganti Gambar (Biarkan kosong jika tidak ingin mengubah):</label>
                <input type="file" name="gambar" accept="image/*">
            </div>
            <button type="submit" style="background-color: #8B4513; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">Simpan Perubahan</button>
            <a href="<?= base_url('admin/gallery') ?>" style="margin-left: 10px; text-decoration: none; color: #666;">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>