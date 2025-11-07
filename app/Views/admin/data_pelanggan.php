<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="admin-container">
    <div class="content-box">

        <div class="admin-header">
            <h2 class="admin-title">Daftar Pelanggan</h2>
            </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pelanggan)): ?>
                    <?php foreach ($pelanggan as $p): ?>
                        <tr>
                            <td><?= $p['id'] ?></td>
                            <td><?= $p['username'] ?></td>
                            <td><?= $p['email'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="text-align: center;">Belum ada pelanggan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
    </div> </div> <?= $this->endSection(); ?>