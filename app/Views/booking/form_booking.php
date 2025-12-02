<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        padding: 20px;
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    form {
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        max-width: 500px;
        margin: 0 auto;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    select, input[type="date"], input[type="time"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    button {
        width: 100%;
        padding: 12px;
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    button:hover {
        background-color: #218838;
    }
</style>

<h2>Form Booking</h2>

<form action="/booking/submit" method="post">
    <label for="id_layanan">Pilih Layanan</label>
    <select name="id_layanan" required>
        <option value="">-- pilih layanan --</option>
        <?php foreach ($layanan as $l): ?>
            <option value="<?= $l['id']; ?>"><?= $l['nama_layanan']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="tanggal">Tanggal</label>
    <input type="date" name="tanggal" required>

    <label for="jam">Jam</label>
    <input type="time" name="jam" required>

    <button type="submit">Booking Sekarang</button>
</form>

<?= $this->endSection(); ?>
