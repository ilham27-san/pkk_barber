<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php
$oldSession = session()->get('booking_step1') ?? [];
$oldLayanan = old('id_layanan') ?? $oldSession['id_layanan'] ?? null;
$oldCapster = old('id_capster') ?? $oldSession['id_capster'] ?? $selected_capster ?? null;
?>

<div class="booking-layout-wrapper">

    <div class="booking-header">
        <h2 class="title">Pilih Layanan</h2>
        <p class="subtitle">Tentukan perawatan terbaik untuk penampilanmu</p>
    </div>

    <div class="booking-scroll-area">
        <div class="layanan-grid">
            <?php if (!empty($layanan)): ?>
                <?php foreach ($layanan as $l): ?>
                    <div class="layanan-card <?= ($oldLayanan == $l['id']) ? 'active' : '' ?>"
                        id="card-<?= $l['id'] ?>"
                        data-id="<?= $l['id'] ?>"
                        data-price="<?= $l['harga'] ?>"
                        onclick="selectCard(this)">

                        <div class="check-icon"><i class="fas fa-check"></i></div>

                        <div class="card-content">
                            <div class="header-row">
                                <h3 class="layanan-name"><?= esc($l['nama_layanan']) ?></h3>
                                <span class="badge-durasi">
                                    <i class="far fa-clock"></i> <?= esc($l['durasi'] ?? 30) ?> Menit
                                </span>
                            </div>

                            <p class="layanan-desc">
                                <?= !empty($l['deskripsi']) ? esc(substr($l['deskripsi'], 0, 60)) . '...' : 'Perawatan standar kualitas tinggi.' ?>
                            </p>
                        </div>

                        <div class="card-action">
                            <span class="layanan-price">Rp <?= number_format($l['harga'], 0, ",", ".") ?></span>
                            <button type="button" class="select-btn">
                                <?= ($oldLayanan == $l['id']) ? 'Terpilih' : 'Pilih' ?>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="grid-column: 1/-1; text-align: center; color: #999; padding: 50px;">
                    <i class="fas fa-exclamation-circle fa-2x"></i>
                    <p>Belum ada layanan yang tersedia.</p>
                </div>
            <?php endif; ?>
        </div>
        <div style="height: 120px;"></div>
    </div>

    <div class="floating-action-bar">
        <form action="<?= base_url('booking/step1Submit') ?>" method="post" class="booking-form">
            <?= csrf_field(); ?>

            <input type="hidden" name="id_layanan" id="id_layanan" value="<?= esc($oldLayanan) ?>" required>

            <div class="action-item">
                <label>Total Estimasi</label>
                <div id="harga-display" class="price-display">Rp 0</div>
            </div>

            <div class="action-item center-item">
                <select name="id_capster" id="id_capster" class="custom-select">
                    <option value="">-- Bebas / Any Stylist --</option>

                    <?php if (!empty($stylists) && is_array($stylists)) : ?>
                        <?php foreach ($stylists as $s): ?>
                            <?php
                            $isSelected = ($oldCapster == $s['id_capster']) ? 'selected' : '';
                            ?>
                            <option value="<?= $s['id_capster'] ?>" <?= $isSelected ?>>
                                <?= esc($s['nama']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <small style="color: rgba(255,255,255,0.5); font-size: 0.6rem; display: block; margin-top: 5px;">
                    *Pilih "Bebas" untuk waktu tunggu lebih cepat
                </small>
            </div>

            <div class="action-item">
                <button type="submit" id="btn-submit" class="btn-next" disabled>
                    Lanjut <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </form>
    </div>

</div>

<style>
    /* Menggunakan variabel CSS yang sudah Anda buat sebelumnya */
    :root {
        --bg-cream: #F5F0E6;
        --card-white: #FFFFFF;
        --text-dark: #3E2723;
        --text-accent: #6D4C41;
        --gold-highlight: #D4AF37;
        --dark-brown: #2D1B18;
    }

    /* --- UPDATE LAYOUT --- */
    .booking-layout-wrapper {
        background-color: var(--bg-cream);
        height: calc(100vh - 60px);
        /* Sesuaikan tinggi navbar */
        display: flex;
        flex-direction: column;
        overflow: hidden;
        position: relative;
    }

    .booking-scroll-area {
        flex-grow: 1;
        overflow-y: auto;
        padding: 10px 20px;
        -webkit-overflow-scrolling: touch;
        /* Smooth scroll iOS */
    }

    .layanan-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        max-width: 1100px;
        margin: 0 auto;
        padding-bottom: 20px;
    }

    /* --- CARD STYLING --- */
    .layanan-card {
        background: var(--card-white);
        border: 1px solid rgba(62, 39, 35, 0.1);
        border-radius: 16px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        cursor: pointer;
        transition: all 0.3s ease;
        min-height: 160px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
    }

    .layanan-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(62, 39, 35, 0.1);
        border-color: var(--gold-highlight);
    }

    /* Badge Durasi (NEW) */
    .header-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 8px;
    }

    .badge-durasi {
        background: #eee;
        color: #666;
        font-size: 0.7rem;
        padding: 4px 8px;
        border-radius: 8px;
        font-weight: 600;
        white-space: nowrap;
    }

    .layanan-card.active .badge-durasi {
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
    }

    .layanan-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
        padding-right: 10px;
        line-height: 1.2;
    }

    .layanan-desc {
        font-size: 0.85rem;
        color: #888;
        line-height: 1.4;
        margin-bottom: 15px;
    }

    .card-action {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
    }

    .layanan-price {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-accent);
    }

    .select-btn {
        background: transparent;
        border: 1px solid var(--text-dark);
        color: var(--text-dark);
        padding: 6px 18px;
        border-radius: 50px;
        font-size: 0.8rem;
        cursor: pointer;
        transition: 0.2s;
    }

    /* --- ACTIVE STATE --- */
    .layanan-card.active {
        background: var(--text-dark);
        border-color: var(--text-dark);
        box-shadow: 0 15px 30px rgba(62, 39, 35, 0.25);
    }

    .layanan-card.active .layanan-name,
    .layanan-card.active .layanan-desc,
    .layanan-card.active .layanan-price {
        color: #fff;
    }

    .layanan-card.active .select-btn {
        background: var(--gold-highlight);
        border-color: var(--gold-highlight);
        color: var(--text-dark);
        font-weight: bold;
    }

    .check-icon {
        position: absolute;
        top: -10px;
        right: -10px;
        background: var(--gold-highlight);
        color: var(--text-dark);
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transform: scale(0);
        transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        z-index: 2;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .layanan-card.active .check-icon {
        opacity: 1;
        transform: scale(1);
    }

    /* --- FLOATING BAR --- */
    .floating-action-bar {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: 95%;
        max-width: 900px;
        background: var(--dark-brown);
        padding: 15px 25px;
        border-radius: 100px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
        z-index: 100;
        backdrop-filter: blur(10px);
        /* Efek kaca dikit */
    }

    .booking-form {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        gap: 20px;
    }

    .price-display {
        color: var(--gold-highlight);
        font-size: 1.5rem;
        font-weight: 700;
        font-family: 'Playfair Display', serif;
    }

    .custom-select {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #fff;
        padding: 12px 20px;
        border-radius: 30px;
        outline: none;
        width: 100%;
        min-width: 220px;
        cursor: pointer;
        font-size: 0.9rem;
    }

    .custom-select option {
        color: #333;
    }

    .btn-next {
        background: var(--gold-highlight);
        color: var(--text-dark);
        border: none;
        padding: 12px 35px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: 0.3s;
        white-space: nowrap;
    }

    .btn-next:disabled {
        background: #4A3B39;
        color: #6D5E5C;
        cursor: not-allowed;
        box-shadow: none;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .booking-header {
            padding: 15px;
        }

        .title {
            font-size: 1.8rem;
        }

        .floating-action-bar {
            width: 92%;
            bottom: 15px;
            padding: 15px;
            border-radius: 20px;
        }

        .booking-form {
            flex-direction: column;
            /* Stack vertikal di HP */
            gap: 15px;
        }

        .action-item {
            width: 100%;
        }

        .price-display {
            text-align: center;
            font-size: 1.8rem;
            margin-bottom: 5px;
        }

        .center-item {
            order: -1;
        }

        /* Stylist di atas, atau bisa diatur */

        .btn-next {
            width: 100%;
            justify-content: center;
        }

        /* Kartu di mobile */
        .layanan-grid {
            grid-template-columns: 1fr;
            /* Satu kolom */
            gap: 15px;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const inputLayanan = document.getElementById('id_layanan');
        const hargaDisplay = document.getElementById('harga-display');
        const btnSubmit = document.getElementById('btn-submit');
        const allCards = document.querySelectorAll('.layanan-card');

        // Fungsi seleksi kartu
        window.selectCard = function(element) {
            // 1. Ambil data dari attribute
            const id = element.getAttribute('data-id');
            const harga = element.getAttribute('data-price');

            // 2. Update Hidden Input & Harga
            inputLayanan.value = id;
            hargaDisplay.textContent = "Rp " + parseInt(harga).toLocaleString('id-ID');

            // 3. Enable tombol lanjut
            btnSubmit.disabled = false;

            // 4. Update UI Kartu
            allCards.forEach(card => {
                card.classList.remove('active');
                card.querySelector('.select-btn').textContent = "Pilih";
            });

            element.classList.add('active');
            element.querySelector('.select-btn').textContent = "Terpilih";
        }

        // --- OLD INPUT HANDLING (Re-Activate Card) ---
        // Jika ada old input (misal user balik dari Step 2), aktifkan kartunya lagi
        const oldId = inputLayanan.value;
        if (oldId) {
            const cardToActivate = document.getElementById('card-' + oldId);
            if (cardToActivate) {
                // Trigger manual
                selectCard(cardToActivate);
            }
        }
    });
</script>

<?= $this->endSection(); ?>