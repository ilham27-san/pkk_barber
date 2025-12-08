<?= $this->extend('layout/template'); ?>

<?= $this->section('css'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/booking.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="booking-page">
    <h2>Step 2: Pilih Tanggal & Jam</h2>
    <form action="/booking/step2Submit" method="post">
        <label for="tanggal">Tanggal</label>
        <input type="date" name="tanggal" required>

        <label for="jam">Jam</label>
        <input type="time" name="jam" required>

        <button type="submit">Next</button>
    </form>
</div>
<?= $this->endSection(); ?>
