<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

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
