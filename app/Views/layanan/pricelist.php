<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="pricelist-container">
    <h2 class="title">Daftar Layanan & Pricelist</h2>

    <?php if (!empty($layanan) && is_array($layanan)): ?>
        <div class="card-grid">
            <?php foreach ($layanan as $row): ?>
                <div class="card">
                    <h3 class="card-title"><?= esc($row['nama_layanan']) ?></h3>
                    <p class="card-price">Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
                    <p class="card-desc"><?= esc($row['deskripsi']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p style="text-align: center;">Belum ada layanan.</p>
    <?php endif; ?>
</div>

<style>
    .pricelist-container {
        padding: 20px;
    }

    .title {
        text-align: center;
        margin-bottom: 25px;
        font-size: 28px;
    }

    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
    }

    .card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 15px;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    .card-title {
        font-size: 20px;
        margin-bottom: 10px;
    }

    .card-price {
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .card-desc {
        color: #555;
        font-size: 14px;
    }

    @media screen and (max-width: 600px) {
        .card-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<?= $this->endSection(); ?>