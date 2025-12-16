<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="admin-container">
    <div class="content-box">
        
        <div class="admin-header">
            <h2 class="admin-title">Kelola Gallery</h2>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div style="color: green; margin-bottom: 15px; font-weight: bold;">
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>

        <div style="margin-bottom: 30px; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #fffaf5;">
            <h4 style="margin-top: 0; color: #8B4513;">Tambah Foto Baru</h4>
            <form action="<?= base_url('admin/gallery/simpan') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                
                <div style="margin-bottom: 15px;">
                    <label style="font-weight: bold;">Judul Foto:</label><br>
                    <input type="text" name="judul" placeholder="Contoh: Burst Fade" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; margin-top: 5px;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="font-weight: bold;">Deskripsi (Akan muncul di bawah judul):</label><br>
                    <textarea name="deskripsi" placeholder="Contoh: Potongan rambut detail & rapi" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; margin-top: 5px; font-family: inherit;" rows="3"></textarea>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="font-weight: bold;">Pilih File Gambar:</label><br>
                    <input type="file" name="gambar" accept="image/*" required style="margin-top: 5px;">
                    <small style="display: block; color: #666; margin-top: 5px;">Format: JPG, PNG, JPEG. Maks 2MB.</small>
                </div>

                <button type="submit" style="background-color: #8B4513; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-weight: bold;">
                    Upload ke Gallery
                </button>
            </form>
        </div>

        <hr>

        <div style="overflow-x: auto;">
           <table width="100%" style="border-collapse: collapse; margin-top: 10px;">
    <thead>
        <tr style="background-color: #8B4513; color: white; text-align: left;">
            <th style="padding: 12px; border: 1px solid #ddd;">No</th>
            <th style="padding: 12px; border: 1px solid #ddd;">Pratinjau</th>
            <th style="padding: 12px; border: 1px solid #ddd;">Judul</th>
            <th style="padding: 12px; border: 1px solid #ddd;">Deskripsi</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: center;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($gallery)) : ?>
            <?php $no = 1; foreach ($gallery as $g) : ?>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px; border: 1px solid #ddd;"><?= $no++; ?></td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                        <img src="<?= base_url('img/gallery/' . $g['gambar']) ?>" style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px;">
                    </td>
                    <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold;"><?= $g['judul']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ddd;"><?= $g['deskripsi']; ?></td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                        <a href="<?= base_url('admin/gallery/edit/' . $g['id']) ?>" 
                           style="background-color: #f0ad4e; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 14px; margin-right: 5px;">
                           Edit
                        </a>

                        <form action="<?= base_url('admin/gallery/delete/' . $g['id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Hapus foto?')">
                            <?= csrf_field(); ?>
                            <button type="submit" style="background-color: #d9534f; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
        </div>

        <div style="margin-top: 20px;">
            <a href="<?= base_url('admin/dashboard'); ?>" style="color: #8B4513; text-decoration: none; font-weight: bold;">
                &larr; Kembali ke Dashboard
            </a>
        </div>

    </div>
</div>
<?= $this->endSection() ?>