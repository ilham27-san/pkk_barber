<?= $this->extend('layout/template'); ?>

<?= $this->section('css'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/booking.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="booking-page">
    <h2>Step 1: Pilih Layanan</h2>
    <form action="/booking/step1Submit" method="post">
        <label>Layanan</label>
        <select name="id_layanan" required>
            <option value="">-- pilih layanan --</option>
            <?php foreach ($layanan as $l): ?>
                <option value="<?= $l['id']; ?>"><?= $l['nama_layanan']; ?></option>
            <?php endforeach; ?>
        </select>

        <label>Stylist (opsional)</label>
        <select name="barber">
            <option value="">Any</option>
            <option value="Barber A">Barber A</option>
            <option value="Barber B">Barber B</option>
        </select>

        <button type="submit">Next</button>
    </form>
</div>
<?= $this->endSection(); ?>
