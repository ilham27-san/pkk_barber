<?= $this->extend('layout/template'); ?>

<?= $this->section('css'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/booking.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="booking-page">
    <h2>Step 4: Review & Konfirmasi</h2>
    <form action="/booking/submit" method="post">
        <ul>
            <li>Layanan: <?= $booking['id_layanan'] ?? '-' ?></li>
            <li>Stylist: <?= $booking['barber'] ?? '-' ?></li>
            <li>Tanggal: <?= $booking['tanggal'] ?? '-' ?></li>
            <li>Jam: <?= $booking['jam'] ?? '-' ?></li>
            <li>Nama: <?= $booking['name'] ?? '-' ?></li>
            <li>Nomor HP: <?= $booking['phone'] ?? '-' ?></li>
            <li>Email: <?= $booking['email'] ?? '-' ?></li>
            <li>Catatan: <?= $booking['note'] ?? '-' ?></li>
        </ul>

        <button type="submit">Submit Booking</button>
    </form>
</div>
<?= $this->endSection(); ?>
