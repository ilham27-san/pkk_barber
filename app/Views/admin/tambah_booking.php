<!DOCTYPE html>
<html>
<head>
    <title>Tambah Booking</title>
</head>
<body>
    <h2>Tambah Booking Baru</h2>

    <form action="/admin/simpan_booking" method="post">
        <label>Pelanggan:</label><br>
        <select name="id_user" required>
            <option value="">-- Pilih Pelanggan --</option>
            <?php foreach($users as $user): ?>
                <option value="<?= $user['id'] ?>"><?= $user['username'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Layanan:</label><br>
        <select name="id_layanan" required>
            <option value="">-- Pilih Layanan --</option>
            <?php foreach($layanans as $layanan): ?>
                <option value="<?= $layanan['id'] ?>"><?= $layanan['nama_layanan'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Tanggal:</label><br>
        <input type="date" name="tanggal" required><br><br>

        <label>Jam:</label><br>
        <input type="time" name="jam" required><br><br>

        <label>Status:</label><br>
        <select name="status" required>
            <option value="pending">Pending</option>
            <option value="selesai">Selesai</option>
            <option value="batal">Batal</option>
        </select><br><br>

        <button type="submit">Simpan Booking</button>
    </form>

    <br>
    <a href="/admin/booking">Kembali ke Daftar Booking</a>
</body>
</html>
