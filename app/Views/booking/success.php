<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    /* --- CSS Kartu Resi --- */
    .receipt-container {
        max-width: 500px;
        margin: 50px auto;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        position: relative;
    }

    .receipt-header {
        background: #3e2b26;
        color: #fff;
        padding: 30px 20px;
        text-align: center;
    }

    .receipt-body {
        padding: 30px;
    }

    /* Garis Putus-putus ala Tiket */
    .dashed-line {
        border-bottom: 2px dashed #eee;
        margin: 20px 0;
    }

    /* Tombol WA */
    .btn-wa-confirm {
        display: block;
        width: 100%;
        text-align: center;
        background: #25D366;
        color: white;
        padding: 15px;
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 5px 15px rgba(37, 211, 102, 0.3);
        transition: transform 0.2s;
        border: none;
    }

    .btn-wa-confirm:hover {
        background: #1ebc57;
        transform: translateY(-3px);
        color: white;
    }

    .booking-id-big {
        font-size: 2.5rem;
        font-weight: 800;
        letter-spacing: 3px;
        margin: 10px 0;
        color: #3e2b26;
    }
</style>

<div class="container">
    <div class="receipt-container">

        <div class="receipt-header">
            <div style="font-size: 3rem; margin-bottom: 10px;"><i class="far fa-check-circle"></i></div>
            <h2 style="margin: 0; font-family: 'Playfair Display';">Booking Berhasil!</h2>
            <p style="opacity: 0.8; margin-top: 5px;">Data Anda sudah tersimpan aman.</p>
        </div>

        <div class="receipt-body">
            <div class="text-center">
                <span style="color: #999; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">Kode Booking</span>
                <div class="booking-id-big">#<?= str_pad($booking['id'], 6, '0', STR_PAD_LEFT) ?></div>
            </div>

            <div class="dashed-line"></div>

            <div class="row mb-2">
                <div class="col-4 text-muted">Layanan</div>
                <div class="col-8 text-end fw-bold text-dark"><?= esc($booking['nama_layanan']) ?></div>
            </div>
            <div class="row mb-2">
                <div class="col-4 text-muted">Stylist</div>
                <div class="col-8 text-end fw-bold text-dark"><?= esc($stylist_name) ?></div>
            </div>
            <div class="row mb-2">
                <div class="col-4 text-muted">Jadwal</div>
                <div class="col-8 text-end fw-bold text-danger">
                    <?= date('d M Y', strtotime($booking['tanggal'])) ?> • <?= esc($booking['jam']) ?>
                </div>
            </div>

            <?php if (!empty($booking['note'])) : ?>
                <div class="row mb-2">
                    <div class="col-4 text-muted">Catatan</div>
                    <div class="col-8 text-end fst-italic text-dark">"<?= esc($booking['note']) ?>"</div>
                </div>
            <?php endif; ?>

            <div class="dashed-line"></div>

            <?php
            // 1. Nomor Admin
            $noHpAdmin = '6281513728023';

            // 2. Format Tanggal Cantik (Contoh: 25 Dec 2025)
            $tanggalCantik = date('d M Y', strtotime($booking['tanggal']));

            // 3. Susun Pesan LENGKAP (Gunakan \n untuk baris baru)
            $pesan  = "Halo Admin, saya mau konfirmasi booking baru.\n\n";
            $pesan .= "*KODE BOOKING: #" . str_pad($booking['id'], 6, '0', STR_PAD_LEFT) . "*\n";
            $pesan .= "----------------------------------\n";
            $pesan .= "👤 Nama: " . $booking['name'] . "\n";
            $pesan .= "✂️ Layanan: " . $booking['nama_layanan'] . "\n";
            $pesan .= "💈 Stylist: " . $stylist_name . "\n";  // <-- Stylist Masuk
            $pesan .= "📅 Tanggal: " . $tanggalCantik . "\n"; // <-- Tanggal Masuk
            $pesan .= "⏰ Jam: " . $booking['jam'] . "\n";

            // Cek: Kalau ada catatan, baru ditampilkan di WA
            if (!empty($booking['note'])) {
                $pesan .= "📝 Catatan: " . $booking['note'] . "\n";
            }

            $pesan .= "----------------------------------\n";
            $pesan .= "Mohon slot ini diamankan ya. Terima kasih!";

            // 4. ENCODE PESAN (PENTING AGAR TIDAK TERPOTONG)
            // urlencode akan mengubah spasi jadi +, # jadi %23, \n jadi %0A
            $pesanEncoded = urlencode($pesan);

            // 5. Link Final
            $linkWA = "https://wa.me/$noHpAdmin?text=$pesanEncoded";
            ?>

            <p class="text-center small text-muted mb-3">
                Langkah Terakhir: Silahkan kirim pesan konfirmasi ke admin agar jadwal Anda dikunci.
            </p>

            <a href="<?= $linkWA ?>" target="_blank" class="btn-wa-confirm">
                <i class="fab fa-whatsapp"></i> Konfirmasi Sekarang
            </a>

            <div class="text-center mt-4">
                <a href="/booking" class="text-muted small" style="text-decoration: none;">Kembali ke Halaman Utama</a>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>