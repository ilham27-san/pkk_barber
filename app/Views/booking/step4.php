<?= $this->extend('layout/template'); ?>

<?= $this->section('css'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/booking.css') ?>">
<style>
.booking-page {
    max-width: 600px;
    margin: 50px auto;
    background-color: #1e1e1e;
    color: #f5f5f5;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
}

.booking-page h2 {
    text-align: center;
    margin-bottom: 25px;
}

.booking-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.booking-table td {
    padding: 10px;
    border-bottom: 1px solid #444;
}

.booking-table td:first-child {
    font-weight: bold;
    width: 35%;
}

.booking-table td:last-child {
    text-align: right;
}

button {
    width: 100%;
    padding: 12px;
    background-color: #4CAF50;
    color: white;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="booking-page">
    <h2>Step 4: Review & Konfirmasi</h2>
    <form action="/booking/submit" method="post">
        <table class="booking-table">
            <tr><td>Layanan</td><td><?= $booking['id_layanan'] ?? '-' ?></td></tr>
            <tr><td>Stylist</td><td><?= $booking['barber'] ?? '-' ?></td></tr>
            <tr><td>Tanggal</td><td><?= $booking['tanggal'] ?? '-' ?></td></tr>
            <tr><td>Jam</td><td><?= $booking['jam'] ?? '-' ?></td></tr>
            <tr><td>Nama</td><td><?= $booking['name'] ?? '-' ?></td></tr>
            <tr><td>Nomor HP</td><td><?= $booking['phone'] ?? '-' ?></td></tr>
            <tr><td>Email</td><td><?= $booking['email'] ?? '-' ?></td></tr>
            <tr><td>Catatan</td><td><?= $booking['note'] ?? '-' ?></td></tr>
        </table>

        <button type="submit">Submit Booking</button>
    </form>
</div>
<?= $this->endSection(); ?>
    