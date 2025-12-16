<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="admin-container">
    <div class="content-box">
        <div class="admin-header">
            <h2 class="admin-title">Kelola Produk</h2>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div style="color: green; margin-bottom: 15px; font-weight: bold;"><?= session()->getFlashdata('success'); ?></div>
        <?php endif; ?>

        <div style="margin-bottom: 30px; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #fffaf5;">
            <h4 style="margin-top: 0; color: #8B4513;">Tambah Produk Baru</h4>
            <form action="<?= base_url('admin/products/simpan') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div style="margin-bottom: 10px;">
                    <label>Nama Produk:</label>
                    <input type="text" name="nama_produk" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 10px;">
                    <label>Harga (Rupiah):</label>
                    <input type="number" name="harga" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 10px;">
                    <label>Deskripsi:</label>
                    <textarea name="deskripsi" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" rows="3"></textarea>
                </div>
                <div style="margin-bottom: 15px;">
                    <label>Gambar Produk:</label><br>
                    <input type="file" name="gambar" accept="image/*" required>
                </div>
                <button type="submit" style="background-color: #8B4513; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">Simpan Produk</button>
            </form>
        </div>

        <table width="100%" style="border-collapse: collapse;">
            <thead>
                <tr style="background-color: #8B4513; color: white; text-align: left;">
                    <th style="padding: 12px; border: 1px solid #ddd;">No</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">Gambar</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">Nama Produk</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">Harga</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($products as $p) : ?>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?= $no++; ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                            <img src="<?= base_url('img/products/' . $p['gambar']) ?>" width="80" style="border-radius: 4px;">
                        </td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><strong><?= $p['nama_produk']; ?></strong></td>
                        <td style="padding: 10px; border: 1px solid #ddd;">Rp <?= number_format($p['harga'], 0, ',', '.'); ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                            <a href="<?= base_url('admin/products/edit/' . $p['id']) ?>" style="color: orange; text-decoration: none; font-weight: bold; margin-right: 10px;">Edit</a>
                            <form action="<?= base_url('admin/products/delete/' . $p['id']) ?>" method="post" style="display:inline;">
                                <?= csrf_field(); ?>
                                <button type="submit" onclick="return confirm('Hapus produk?')" style="background: none; border: none; color: red; cursor: pointer; font-weight: bold;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>