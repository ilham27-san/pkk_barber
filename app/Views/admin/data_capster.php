<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="admin-container">
    <h2>Kelola Data Capster</h2>
    <a href="<?= base_url('admin/capster/create'); ?>" class="btn btn-primary">+ Tambah Capster Baru</a>

    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success mt-3"><?= session()->getFlashdata('pesan'); ?></div>
    <?php endif; ?>

    <table class="table mt-4" border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Spesialisasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php if (!empty($capster)) : ?>
                <?php foreach ($capster as $c) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <img src="<?= base_url('assets/img/capster/' . $c['foto']); ?>" width="80" height="80" style="object-fit: cover;">
                        </td>
                        <td><?= $c['nama']; ?></td>
                        <td><?= $c['jenis_kelamin']; ?></td>
                        <td><?= $c['spesialisasi']; ?></td>
                        <td>
                            <a href="<?= base_url('admin/capster/edit/' . $c['id_capster']); ?>" class="btn btn-warning btn-sm">Edit</a>

                            <form action="<?= base_url('admin/capster/delete/' . $c['id_capster']); ?>" method="post" style="display: inline-block;">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="POST">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus Capster <?= $c['nama']; ?>?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Belum ada data Capster.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>