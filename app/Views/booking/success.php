<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php
// --- FUNGSI GENERATOR KODE ACAK (Helper Sederhana di View) ---
// Taruh logika ini di paling atas file view
function generateBookingCode($id)
{
    // 1. KITA KALI ID DENGAN ANGKA TERTENTU AGAR TIDAK URUT (Misal: 47)
    // ID 1 -> 47, ID 2 -> 94 (Jaraknya jauh, jadi gak ketebak urutannya)
    $acak = $id * 47;

    // 2. UBAH KE HEXADESIMAL (Biar ada huruf A-F)
    $hex = dechex($acak);

    // 3. UBAH JADI HURUF BESAR & PAD SUPAYA PANJANGNYA KONSISTEN (MIN 5 KARAKTER)
    $code = strtoupper(str_pad($hex, 5, '0', STR_PAD_LEFT));

    // 4. TAMBAH PREFIX (Misal: BN untuk BarberNow)
    return "BN-" . $code;
}

// SIMPAN KODE KE VARIABEL
$kodeUnik = generateBookingCode($booking['id']);
?>

<style>
    .booking-wrapper-font {
        font-family: 'Montserrat', sans-serif;
    }

    /* --- CSS Kartu Resi --- */
    .receipt-container {
        max-width: 500px;
        margin: 50px auto;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        position: relative;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .receipt-header {
        background: #3e2b26;
        color: #fff;
        padding: 40px 20px 30px;
        text-align: center;
        position: relative;
    }

    .receipt-header::after {
        content: '';
        position: absolute;
        bottom: -20px;
        left: 0;
        width: 100%;
        height: 40px;
        background: #fff;
        border-radius: 50% 50% 0 0;
    }

    .receipt-body {
        padding: 20px 30px 40px;
    }

    .dashed-line {
        border-bottom: 2px dashed #eee;
        margin: 25px 0;
        position: relative;
    }

    .dashed-line::before,
    .dashed-line::after {
        content: '';
        position: absolute;
        top: -10px;
        width: 20px;
        height: 20px;
        background: #f4f6f9;
        /* Sesuaikan background body luar */
        border-radius: 50%;
    }

    .dashed-line::before {
        left: -40px;
    }

    .dashed-line::after {
        right: -40px;
    }

    .btn-wa-confirm {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        width: 100%;
        background: #25D366;
        color: white;
        padding: 16px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        text-decoration: none;
        box-shadow: 0 8px 20px rgba(37, 211, 102, 0.25);
        transition: all 0.3s;
        border: none;
    }

    .btn-wa-confirm:hover {
        background: #1ebc57;
        transform: translateY(-3px);
        color: white;
        box-shadow: 0 12px 25px rgba(37, 211, 102, 0.35);
    }

    /* GAYA KODE BOOKING BARU */
    .booking-id-big {
        font-size: 2.5rem;
        /* Lebih besar dikit */
        font-weight: 800;
        letter-spacing: 4px;
        /* Biar hurufnya berjarak kayak tiket pesawat */
        margin: 10px 0 20px;
        color: #3e2b26;
        font-family: 'Courier New', Courier, monospace;
        /* Font monospace biar keren */
        text-transform: uppercase;
    }

    .status-badge {
        background: #e8f5e9;
        color: #2e7d32;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        display: inline-block;
        margin-bottom: 10px;
    }
</style>

<div class="booking-wrapper-font">
    <div class="container">
        <div class="receipt-container">

            <div class="receipt-header">
                <div style="font-size: 3.5rem; margin-bottom: 10px; color: #4caf50;">
                    <i class="far fa-check-circle"></i>
                </div>
                <h2 style="margin: 0; font-family: 'Playfair Display'; font-weight: 700;">Booking Berhasil!</h2>
                <p style="opacity: 0.8; margin-top: 5px; font-size: 0.95rem;">Jadwal Anda telah diamankan sistem.</p>
            </div>

            <div class="receipt-body">
                <div class="text-center">
                    <span class="status-badge">TERKONFIRMASI</span><br>
                    <span style="color: #999; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;">Kode Booking</span>

                    <div class="booking-id-big"><?= $kodeUnik ?></div>
                </div>

                <div class="dashed-line"></div>

                <?php
                // --- LOGIC PHP DATA BOOKING ---
                $waktuBooking = strtotime($booking['start_time']);
                $tanggalFix   = date('d F Y', $waktuBooking);
                $jamFix       = date('H:i', $waktuBooking);
                $stylistFix   = !empty($booking['nama_capster']) ? $booking['nama_capster'] : 'Any Stylist';
                ?>

                <div class="row mb-3">
                    <div class="col-4 text-muted small text-uppercase fw-bold pt-1">Layanan</div>
                    <div class="col-8 text-end fw-bold text-dark fs-5"><?= esc($booking['nama_layanan']) ?></div>
                </div>

                <div class="row mb-3">
                    <div class="col-4 text-muted small text-uppercase fw-bold pt-1">Stylist</div>
                    <div class="col-8 text-end fw-bold text-dark"><?= esc($stylistFix) ?></div>
                </div>

                <div class="row mb-3">
                    <div class="col-4 text-muted small text-uppercase fw-bold pt-1">Jadwal</div>
                    <div class="col-8 text-end fw-bold" style="color: #d32f2f;">
                        <?= $tanggalFix ?> • <?= $jamFix ?> WIB
                    </div>
                </div>

                <?php if (!empty($booking['note'])) : ?>
                    <div class="row mb-3">
                        <div class="col-4 text-muted small text-uppercase fw-bold pt-1">Catatan</div>
                        <div class="col-8 text-end fst-italic text-dark small">"<?= esc($booking['note']) ?>"</div>
                    </div>
                <?php endif; ?>

                <div class="dashed-line"></div>

                <?php
                // --- LOGIC WA LINK (Updated dengan Kode Unik) ---
                $noHpAdmin = '6281513728023';

                $pesan  = "Halo Admin, saya mau konfirmasi booking BarberNow.\n\n";
                // Gunakan variable $kodeUnik di sini
                $pesan .= "*KODE: " . $kodeUnik . "*\n";
                $pesan .= "--------------------------------\n";
                $pesan .= "👤 Nama: " . $booking['name'] . "\n";
                $pesan .= "✂️ Layanan: " . $booking['nama_layanan'] . "\n";
                $pesan .= "💈 Stylist: " . $stylistFix . "\n";
                $pesan .= "📅 Tgl: " . $tanggalFix . "\n";
                $pesan .= "⏰ Jam: " . $jamFix . "\n";

                if (!empty($booking['note'])) {
                    $pesan .= "📝 Note: " . $booking['note'] . "\n";
                }

                $pesan .= "--------------------------------\n";
                $pesan .= "Mohon diproses ya. Terima kasih!";

                $pesanEncoded = urlencode($pesan);
                $linkWA = "https://wa.me/$noHpAdmin?text=$pesanEncoded";
                ?>

                <p class="text-center small text-muted mb-3">
                    Wajib konfirmasi via WhatsApp agar jadwal tidak dibatalkan otomatis oleh sistem.
                </p>

                <a href="<?= $linkWA ?>" target="_blank" class="btn-wa-confirm">
                    <i class="fab fa-whatsapp" style="font-size: 1.5rem;"></i> Kirim Konfirmasi
                </a>

                <div class="text-center mt-4">
                    <a href="<?= base_url('booking/step1') ?>" class="text-muted small fw-bold" style="text-decoration: none;">
                        <i class="fas fa-home"></i> Kembali ke Menu Utama
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>