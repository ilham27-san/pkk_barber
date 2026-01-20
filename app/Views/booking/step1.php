<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php
// Mencegah error jika variabel sesi belum ada
$oldSession = session()->get('booking_step1') ?? [];
$oldLayanan = old('id_layanan') ?? $oldSession['id_layanan'] ?? null;
$oldCapster = old('id_capster') ?? $oldSession['id_capster'] ?? $selected_capster ?? null;
?>

<div class="booking-layout-wrapper">

    <div class="booking-header">
        <h2 class="title">Pilih Layanan</h2>
        <p class="subtitle">Silakan pilih service yang kamu inginkan</p>
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
                            <h3 class="layanan-name"><?= esc($l['nama_layanan']) ?></h3>
                            <p class="layanan-desc">
                                <?= !empty($l['deskripsi']) ? esc(substr($l['deskripsi'], 0, 80)) : 'Perawatan terbaik untukmu' ?>
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
            <?php endif; ?>
        </div>
        <div class="safe-area-spacer"></div>
    </div>

    <div class="floating-action-bar">
        <form action="<?= base_url('booking/step1Submit') ?>" method="post" class="booking-form">
            <?= csrf_field(); ?>
            <input type="hidden" name="id_layanan" id="id_layanan" value="<?= esc($oldLayanan) ?>">

            <div class="action-section left">
                <label>Total Estimasi</label>
                <div id="harga-display" class="price-display">Rp 0</div>
            </div>

            <div class="action-section center">
                <select name="id_capster" id="id_capster" class="custom-select">
                    <option value="">-- Stylist Bebas --</option>
                    <?php if (!empty($stylists) && is_array($stylists)) : ?>
                        <?php foreach ($stylists as $s): ?>
                            <?php $isSelected = ($oldCapster == $s['id_capster']) ? 'selected' : ''; ?>
                            <option value="<?= $s['id_capster'] ?>" <?= $isSelected ?>>
                                <?= esc($s['nama']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="action-section right">
                <button type="submit" id="btn-submit" class="btn-next" disabled>
                    Lanjut <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </form>
    </div>

</div>

<style>
    /* --- VARIABLES --- */
    :root {
        --bg-cream: #F5F0E6;
        --card-white: #FFFFFF;
        --text-dark: #3E2723;
        --text-accent: #6D4C41;
        --gold-highlight: #D4AF37;
        --dark-brown: #2D1B18;
    }

    /* --- LAYOUT UTAMA --- */
    .booking-layout-wrapper {
        background-color: var(--bg-cream);
        height: 100vh;
        /* Full viewport height */
        display: flex;
        flex-direction: column;
        overflow: hidden;
        font-family: 'Poppins', sans-serif;
        position: relative;
    }

    .booking-header {
        flex-shrink: 0;
        text-align: center;
        padding: 25px 20px 10px 20px;
        background: var(--bg-cream);
        z-index: 5;
    }

    .title {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        color: #5C2C27;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .subtitle {
        color: var(--text-accent);
        font-size: 0.9rem;
        letter-spacing: 0.5px;
    }

    /* --- SCROLL AREA --- */
    .booking-scroll-area {
        flex-grow: 1;
        overflow-y: auto;
        padding: 10px 20px;
        scrollbar-width: none;
        /* Padding bottom extra supaya scroll smooth sampai bawah */
        padding-bottom: 20px;
    }

    .booking-scroll-area::-webkit-scrollbar {
        display: none;
    }

    .safe-area-spacer {
        /* Default spacer desktop */
        height: 120px;
    }

    /* --- GRID SYSTEM --- */
    .layanan-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        max-width: 1100px;
        margin: 0 auto;
    }

    /* --- CARD STYLE --- */
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
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        min-height: 160px;
    }

    .layanan-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(62, 39, 35, 0.1);
        border-color: var(--text-accent);
    }

    .layanan-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 5px;
        line-height: 1.2;
    }

    .layanan-desc {
        font-size: 0.8rem;
        color: #9E9E9E;
        line-height: 1.4;
    }

    .card-action {
        margin-top: 15px;
    }

    .layanan-price {
        display: block;
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-accent);
        margin-bottom: 10px;
    }

    .select-btn {
        background: transparent;
        border: 1px solid var(--text-dark);
        color: var(--text-dark);
        padding: 6px 20px;
        border-radius: 50px;
        font-size: 0.85rem;
        cursor: pointer;
        transition: 0.2s;
        width: 100%;
        font-weight: 600;
    }

    /* --- LOGIC KARTU TERAKHIR (DESKTOP) --- */
    @media (min-width: 769px) {
        .layanan-card:last-child {
            grid-column: 1 / -1;
            display: flex;
            flex-direction: row;
            align-items: center;
            min-height: 100px;
        }

        .layanan-card:last-child .card-content {
            flex: 1;
            padding-right: 20px;
        }

        .layanan-card:last-child .card-action {
            text-align: right;
            min-width: 150px;
            margin-top: 0;
        }

        .layanan-card:last-child .select-btn {
            width: auto;
            display: inline-block;
        }
    }

    /* --- ACTIVE STATE --- */
    .layanan-card.active {
        background: var(--text-dark);
        border-color: var(--text-dark);
        box-shadow: 0 15px 30px rgba(62, 39, 35, 0.3);
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
        top: 15px;
        right: 15px;
        background: var(--gold-highlight);
        color: var(--text-dark);
        width: 25px;
        height: 25px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        opacity: 0;
        transform: scale(0);
        transition: 0.3s;
    }

    .layanan-card.active .check-icon {
        opacity: 1;
        transform: scale(1);
    }

    /* --- FLOATING ACTION BAR (FIXED) --- */
    .floating-action-bar {
        position: fixed;
        /* FIXED agar nempel di viewport */
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        width: 95%;
        max-width: 1000px;
        background: var(--dark-brown);
        padding: 15px 25px;
        border-radius: 50px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
        z-index: 1000;
        /* Z-Index tinggi */
    }

    .booking-form {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        gap: 15px;
    }

    .action-section label {
        display: block;
        font-size: 0.7rem;
        color: rgba(255, 255, 255, 0.6);
        text-transform: uppercase;
        margin-bottom: 2px;
    }

    .price-display {
        color: var(--gold-highlight);
        font-size: 1.4rem;
        font-weight: 700;
        line-height: 1;
        font-family: 'Playfair Display', serif;
    }

    .custom-select {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        padding: 10px 20px;
        border-radius: 30px;
        outline: none;
        width: 100%;
        min-width: 200px;
        cursor: pointer;
    }

    .custom-select option {
        color: #333;
    }

    .btn-next {
        background: var(--gold-highlight);
        color: var(--text-dark);
        border: none;
        padding: 12px 30px;
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
    }

    /* --- RESPONSIVE MOBILE (OPTIMIZED) --- */
    @media (max-width: 768px) {
        .floating-action-bar {
            width: 92%;

            /* Logic Safe Area + Jarak Aman */
            bottom: calc(20px + env(safe-area-inset-bottom));

            padding: 15px;
            border-radius: 20px;
        }

        .booking-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            align-items: end;
        }

        .action-section.left {
            grid-column: 1;
        }

        .action-section.right {
            grid-column: 2;
        }

        .action-section.center {
            grid-column: 1 / -1;
            grid-row: 2;
        }

        .btn-next {
            width: 100%;
            justify-content: center;
            padding: 10px 15px;
            font-size: 0.9rem;
        }

        .price-display {
            font-size: 1.2rem;
        }

        .custom-select {
            padding: 8px 15px;
            font-size: 0.85rem;
            background: rgba(255, 255, 255, 0.08);
        }

        /* Tambah tinggi spacer karena di HP floating bar jadi 2 baris (lebih tinggi) */
        .safe-area-spacer {
            height: 180px;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const inputLayanan = document.getElementById('id_layanan');
        const hargaDisplay = document.getElementById('harga-display');
        const btnSubmit = document.getElementById('btn-submit');
        const allCards = document.querySelectorAll('.layanan-card');

        window.selectCard = function(element) {
            const id = element.getAttribute('data-id');
            const harga = element.getAttribute('data-price');

            // 1. Update Hidden Input & Harga
            inputLayanan.value = id;
            hargaDisplay.textContent = "Rp " + parseInt(harga).toLocaleString('id-ID');

            // 2. Enable tombol lanjut
            btnSubmit.disabled = false;

            // 3. Update Tampilan Kartu
            allCards.forEach(card => {
                card.classList.remove('active');
                card.querySelector('.select-btn').textContent = "Pilih";
            });

            element.classList.add('active');
            element.querySelector('.select-btn').textContent = "Terpilih";
        }

        // Auto-select jika ada old data
        const oldId = inputLayanan.value;
        if (oldId) {
            const target = document.getElementById('card-' + oldId);
            if (target) selectCard(target);
        }
    });
</script>

<?= $this->endSection(); ?>