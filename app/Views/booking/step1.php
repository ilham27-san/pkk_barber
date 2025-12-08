<?= $this->extend('layout/template'); ?>

<?= $this->section('css'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/booking.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="booking-page">
    <h2>Step 1: Pilih Layanan</h2>

    <div class="layanan-container">
        <?php foreach ($layanan as $l): ?>
        <div class="layanan-card">
            <div class="layanan-info">
                <span class="layanan-name"><?= $l['nama_layanan'] ?></span>
                <span class="layanan-price">Rp <?= number_format($l['harga'],0,",",".") ?></span>
            </div>
            <button type="button" class="select-layanan-btn" data-id="<?= $l['id'] ?>" data-price="<?= $l['harga'] ?>">Pilih</button>
        </div>
        <?php endforeach; ?>
    </div>

    <form action="/booking/step1Submit" method="post">
        <input type="hidden" name="id_layanan" id="id_layanan">

        <p>Harga Terpilih: <span id="harga-layanan">-</span></p>

        <label>Stylist (opsional)</label>
        <select name="barber">
            <option value="">Any</option>
            <option value="Barber A">Barber A</option>
            <option value="Barber B">Barber B</option>
        </select>

        <button type="submit" id="btn-submit" disabled>Next</button>
    </form>
</div>

<script>
const btns = document.querySelectorAll('.select-layanan-btn');
const inputLayanan = document.getElementById('id_layanan');
const hargaSpan = document.getElementById('harga-layanan');
const btnSubmit = document.getElementById('btn-submit');

btns.forEach(btn => {
    btn.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const harga = this.getAttribute('data-price');

        inputLayanan.value = id;
        hargaSpan.textContent = "Rp " + parseInt(harga).toLocaleString();
        btnSubmit.disabled = false;

        // Highlight tombol yang terpilih
        btns.forEach(b => b.classList.remove('selected'));
        this.classList.add('selected');
    });
});
</script>
<?= $this->endSection(); ?>
