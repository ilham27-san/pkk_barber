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
        width: 35%;
        /* Sedikit disesuaikan biar rapi */
        color: #bbb;
    }

    .booking-table input,
    .booking-table select,
    .booking-table textarea {
        width: 100%;
        /* Full width */
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #555;
        background: #2a2a2a;
        color: #fff;
        box-sizing: border-box;
        /* Agar padding tidak merusak lebar */
    }

    .booking-table input:focus,
    .booking-table select:focus,
    .booking-table textarea:focus {
        outline: none;
        border-color: #4CAF50;
        background: #333;
    }

    button {
        width: 100%;
        padding: 14px;
        background-color: #4CAF50;
        color: white;
        font-weight: bold;
        font-size: 1rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s;
        margin-top: 10px;
    }

    button:hover {
        background-color: #45a049;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="booking-page">
    <h2>Tambah Booking Manual</h2>

    <form action="<?= base_url('admin/booking/simpan') ?>" method="post">
        <table class="booking-table">

            <tr>
                <td>Nama Pelanggan</td>
                <td><input type="text" name="name" placeholder="Masukkan nama pelanggan" required></td>
            </tr>

            <tr>
                <td>Nomor HP</td>
                <td><input type="text" name="phone" placeholder="Contoh: 0812..." required></td>
            </tr>

            <tr>
                <td>Email (Opsional)</td>
                <td><input type="email" name="email" placeholder="email@contoh.com"></td>
            </tr>

            <tr>
                <td>Pilih Layanan</td>
                <td>
                    <select name="id_layanan" required>
                        <option value="">-- Pilih Layanan --</option>
                        <?php if (!empty($layanans)): ?>
                            <?php foreach ($layanans as $layanan): ?>
                                <option value="<?= $layanan['id'] ?>">
                                    <?= esc($layanan['nama_layanan']) ?> - Rp <?= number_format($layanan['harga'], 0, ',', '.') ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Pilih Stylist / Barber</td>
                <td>
                    <select name="barber">
                        <option value="">-- Bebas / Siapa Saja (Opsional) --</option>

                        <?php if (!empty($stylists)): ?>
                            <?php foreach ($stylists as $s): ?>
                                <option value="<?= $s['id_capster'] ?>">
                                    <?= esc($s['nama']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Tanggal Booking</td>
                <td><input type="date" name="tanggal" required></td>
            </tr>

            <tr>
                <td>Jam Booking</td>
                <td><input type="time" name="jam" required></td>
            </tr>

            <tr>
                <td>Catatan Tambahan</td>
                <td><textarea name="note" rows="3" placeholder="Contoh: Model rambut pendek samping..."></textarea></td>
            </tr>

            <tr>
                <td>Status Awal</td>
                <td>
                    <select name="status">
                        <option value="pending">Pending (Menunggu)</option>
                        <option value="confirmed" selected>Confirmed (Disetujui)</option>
                        <option value="done">Done (Selesai)</option>
                        <option value="canceled">Canceled (Batal)</option>
                    </select>
                </td>
            </tr>

        </table>

        <button type="submit">Simpan Data Booking</button>
    </form>
</div>

<?= $this->endSection(); ?>