<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<section class="products">
    <h2>Our Products</h2>

    <div class="product-list">
        <?php foreach ($products as $p): ?>
            <div class="product-item">
                <img src="<?= base_url('assets/images/products/' . $p['gambar']); ?>" alt="<?= esc($p['nama_produk']); ?>">
                <h3><?= esc($p['nama_produk']); ?></h3>
                <p><?= esc($p['deskripsi']); ?></p>
                <strong>Rp<?= number_format($p['harga'], 0, ',', '.'); ?></strong>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?= $this->endSection(); ?>
