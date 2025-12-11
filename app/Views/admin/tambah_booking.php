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
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
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
        padding: 12px 10px;
        border-bottom: 1px solid #444;
    }

    .booking-table td:first-child {
        font-weight: bold;
        width: 40%;
    }

    .booking-table input,
    .booking-table select,
    .booking-table textarea {
        width: 95%;
        padding: 8px;
        border-radius: 5px;
        border: none;
        background: #333;
        color: #fff;
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
    <h2>Tambah Booking Baru</h2>

    <form action="<?= base_url('admin/booking/simpan') ?>" method="post">
        <table class="booking-table">

            <tr>
                <td>Nama</td>
                <td><input type="text" name="name" required></td>
            </tr>

            <tr>
                <td>Nomor HP</td>
                <td><input type="text" name="phone" required></td>
            </tr>

            <tr>
                <td>Email</td>
                <td><input type="email" name="email"></td>
            </tr>

            <tr>
                <td>Layanan</td>
                <td>
                    <select name="id_layanan" required>
                        <option value="">-- Pilih Layanan --</option>
                        <?php foreach ($layanans as $layanan): ?>
                            <option value="<?= $layanan['id'] ?>">
                                <?= $layanan['nama_layanan'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Stylist / Barber</td>
                <td><input type="text" name="barber" required></td>
            </tr>

            <tr>
                <td>Tanggal</td>
                <td><input type="date" name="tanggal" required></td>
            </tr>

            <tr>
                <td>Jam</td>
                <td><input type="time" name="jam" required></td>
            </tr>

            <tr>
                <td>Catatan</td>
                <td><textarea name="note"></textarea></td>
            </tr>

            <tr>
                <td>Status</td>
                <td>
                    <select name="status">
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="done">Done</option>
                        <option value="canceled">Canceled</option>
                    </select>
                </td>
            </tr>

        </table>

        <button type="submit">Simpan Booking</button>
    </form>
</div>

<?= $this->endSection(); ?>