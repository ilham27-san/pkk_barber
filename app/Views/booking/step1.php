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
                    <span class="layanan-price">Rp <?= number_format($l['harga'], 0, ",", ".") ?></span>
                </div>
                <button type="button" class="select-layanan-btn"
                    data-id="<?= $l['id'] ?>"
                    data-price="<?= $l['harga'] ?>">
                    Pilih
                </button>
            </div>
        <?php endforeach; ?>
    </div>

    <form action="/booking/step1Submit" method="post">
        <input type="hidden" name="id_layanan" id="id_layanan" required>

        <p>Harga Terpilih: <span id="harga-layanan">-</span></p>

        <label for="id_capster">Pilih Capster / Stylist (Opsional)</label>

        <select name="id_capster" id="id_capster" class="form-control">
            <option value="">-- Pilih Stylist (Bebas) --</option>

            <?php if (!empty($stylists) && is_array($stylists)) : ?>
                <?php foreach ($stylists as $s): ?>
                    <option value="<?= $s['id_capster'] ?>">
                        <?= esc($s['nama']) ?> - <?= esc($s['spesialisasi']) ?>
                    </option>
                <?php endforeach; ?>
            <?php else : ?>
                <option value="" disabled>Tidak ada stylist tersedia saat ini</option>
            <?php endif; ?>
        </select>

        <br><br>
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

            // Format angka ke Rupiah
            hargaSpan.textContent = "Rp " + parseInt(harga).toLocaleString('id-ID');

            btnSubmit.disabled = false;

            // Visual feedback (Highlight tombol)
            btns.forEach(b => {
                b.classList.remove('selected');
                b.style.backgroundColor = ''; // Reset warna
                b.innerText = 'Pilih';
            });

            this.classList.add('selected');
            this.style.backgroundColor = '#4CAF50'; // Contoh warna hijau saat dipilih
            this.innerText = 'Terpilih';
        });
    });
</script>
<?= $this->endSection(); ?>