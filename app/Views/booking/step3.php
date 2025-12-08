<?= $this->extend('layout/template'); ?>

<?= $this->section('css'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/booking.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="booking-page">
    <h2>Step 3: Data Diri</h2>
    <form action="/booking/step3Submit" method="post">
        <label for="name">Nama</label>
        <input type="text" name="name" required>

        <label for="phone">Nomor HP/WA</label>
        <input type="text" name="phone" required>

        <label for="email">Email (opsional)</label>
        <input type="email" name="email">

        <label for="note">Catatan</label>
        <textarea name="note"></textarea>

        <button type="submit">Next</button>
    </form>
</div>
<?= $this->endSection(); ?>
