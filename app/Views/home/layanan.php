<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<h2>Daftar Layanan Barbershop</h2>

<?php if (!empty($layanan)) : ?>
    <ul>
        <?php foreach ($layanan as $l) : ?>
            <li>
                <strong><?= esc($l['nama_layanan']); ?></strong> - Rp<?= number_format($l['harga'], 0, ',', '.'); ?><br>
                <a href="<?= base_url('booking/' . $l['id_layanan']); ?>">Pesan Sekarang</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>Tidak ada layanan tersedia.</p>
<?php endif; ?>

<?= $this->endSection(); ?>
