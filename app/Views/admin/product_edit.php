<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="admin-container">
    <div class="content-box">
        <h2 class="admin-title">Edit Produk</h2>
        <form action="<?= base_url('admin/products/update/' . $product['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div style="margin-bottom: 15px;">
                <label>Nama Produk:</label>
                <input type="text" name="nama_produk" value="<?= $product['nama_produk'] ?>" required style="width: 100%; padding: 8px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label>Harga:</label>
                <input type="number" name="harga" value="<?= $product['harga'] ?>" required style="width: 100%; padding: 8px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label>Deskripsi:</label>
                <textarea name="deskripsi" required style="width: 100%; padding: 8px;" rows="3"><?= $product['deskripsi'] ?></textarea>
            </div>
            <div style="margin-bottom: 15px;">
                <label>Gambar Saat Ini:</label><br>
                <img src="<?= base_url('img/products/' . $product['gambar']) ?>" width="150" style="border-radius: 8px; margin-bottom: 10px;">
                <br>
                <label>Ganti Gambar (Opsional):</label>
                <input type="file" name="gambar" accept="image/*">
            </div>
            <button type="submit" style="background-color: #8B4513; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">Update Produk</button>
            <a href="<?= base_url('admin/products') ?>" style="margin-left: 10px; color: #666; text-decoration: none;">Batal</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>