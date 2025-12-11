<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="admin-container">
    <div class="content-box">
        <div class="admin-header">
            <h2 class="admin-title">Kelola Layanan</h2>
            <a href="<?= base_url('admin/layanan/create') ?>" class="btn-primary">Tambah Layanan</a>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Layanan</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($layanan)): ?>
                    <?php foreach ($layanan as $row): ?>
                        <tr>
                            <td><?= esc($row['id']) ?></td>
                            <td><?= esc($row['nama_layanan']) ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                            <td><?= esc($row['deskripsi']) ?></td>
                            <td class="action-links">
                                <a href="<?= base_url('admin/layanan/edit/' . $row['id']) ?>" class="btn-edit">Edit</a>

                                <form action="<?= base_url('admin/layanan/delete/' . $row['id']) ?>" method="post" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">Belum ada layanan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>