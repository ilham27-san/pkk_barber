<h2>Booking: <?= esc($layanan['nama_layanan']) ?></h2>
<form method="post" action="/booking/submit">
  <input type="hidden" name="id_layanan" value="<?= $layanan['id'] ?>">
  <label>Tanggal</label><br>
  <input type="date" name="tanggal" required><br>
  <label>Jam</label><br>
  <input type="time" name="jam" required><br><br>
  <button type="submit">Kirim Booking</button>
</form>
