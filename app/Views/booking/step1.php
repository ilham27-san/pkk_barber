<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="booking-layout-wrapper">
    
    <div class="booking-header">
        <h2 class="title">Step 1: Pilih Layanan</h2>
        <p class="subtitle">Silakan pilih service yang kamu inginkan</p>
    </div>

    <div class="booking-scroll-area">
        <div class="layanan-grid">
            <?php foreach ($layanan as $l): ?>
            <div class="layanan-card" id="card-<?= $l['id'] ?>" onclick="selectCard(this, '<?= $l['id'] ?>', '<?= $l['harga'] ?>')">
                <div class="check-icon"><i class="fas fa-check"></i></div>
                
                <div class="card-content">
                    <h3 class="layanan-name"><?= esc($l['nama_layanan']) ?></h3>
                    <p class="layanan-desc">Perawatan terbaik untukmu</p> </div>
                
                <div class="card-action">
                    <span class="layanan-price">Rp <?= number_format($l['harga'], 0, ",", ".") ?></span>
                    <button type="button" class="select-btn">Pilih</button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div style="height: 100px;"></div>
    </div>

    <div class="floating-action-bar">
        <form action="/booking/step1Submit" method="post" class="booking-form">
            <input type="hidden" name="id_layanan" id="id_layanan">
            
            <div class="action-item">
                <label>Total</label>
                <div id="harga-display" class="price-display">Rp 0</div>
            </div>

            <div class="action-item center-item">
                <select name="barber" class="custom-select">
                    <option value="">-- Pilih Stylist --</option>
                    <option value="Barber A">Barber A</option>
                    <option value="Barber B">Barber B</option>
                </select>
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
    /* --- VARIABLES --- */
    :root {
        --bg-cream: #F5F0E6;
        --card-white: #FFFFFF;
        --text-dark: #3E2723;
        --text-accent: #6D4C41;
        --gold-highlight: #D4AF37; /* Emas yang lebih elegan */
        --dark-brown: #2D1B18;
    }

    /* --- LAYOUT UTAMA --- */
    .booking-layout-wrapper {
        background-color: var(--bg-cream);
        height: calc(100vh - 80px); /* Sesuaikan dengan tinggi navbar kamu */
        display: flex;
        flex-direction: column;
        overflow: hidden;
        font-family: 'Poppins', sans-serif;
        position: relative;
    }

    /* --- HEADER --- */
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
        color: var(--text-dark);
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
        scrollbar-width: none; /* Sembunyikan scrollbar di Firefox */
    }
    
    /* Sembunyikan scrollbar di Chrome/Safari tapi tetap bisa scroll */
    .booking-scroll-area::-webkit-scrollbar {
        display: none; 
    }

    /* --- GRID SYSTEM --- */
    .layanan-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        max-width: 1100px;
        margin: 0 auto;
    }

    /* --- CARD STYLE (DIPERBAIKI) --- */
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
        overflow: hidden;
    }

    .layanan-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(62, 39, 35, 0.1);
        border-color: var(--text-accent);
    }

    /* Typography di dalam card */
    .layanan-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 5px;
    }

    .layanan-desc {
        font-size: 0.8rem;
        color: #9E9E9E;
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
    }

    /* --- ACTIVE STATE (Saat Dipilih) --- */
    .layanan-card.active {
        background: var(--text-dark); /* Jadi Gelap */
        border-color: var(--text-dark);
        box-shadow: 0 15px 30px rgba(62, 39, 35, 0.3);
    }

    .layanan-card.active .layanan-name,
    .layanan-card.active .layanan-desc,
    .layanan-card.active .layanan-price {
        color: #fff; /* Teks jadi putih */
    }

    .layanan-card.active .select-btn {
        background: var(--gold-highlight);
        border-color: var(--gold-highlight);
        color: var(--text-dark);
        font-weight: bold;
        content: "Terpilih"; /* Bisa diubah via JS */
    }

    /* Ikon Ceklis Pojok Kanan Atas */
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

    /* --- LOGIC KARTU TERAKHIR (PANJANG) --- */
    /* Target elemen terakhir dalam grid */
    .layanan-card:last-child {
        grid-column: 1 / -1; /* Membentang dari kolom 1 sampai akhir */
        display: flex;
        flex-direction: row; /* Ubah jadi horizontal */
        align-items: center;
        justify-content: space-between;
        min-height: 100px; /* Lebih pendek karena memanjang */
    }

    /* Penyesuaian isi kartu panjang */
    .layanan-card:last-child .card-action {
        text-align: right;
        min-width: 150px;
    }
    
    .layanan-card:last-child .select-btn {
        width: auto; /* Tombol tidak full width */
        display: inline-block;
    }

    /* --- FLOATING ACTION BAR (FOOTER BARU) --- */
    .floating-action-bar {
        position: absolute;
        bottom: 25px; /* Jarak dari bawah layar */
        left: 50%;
        transform: translateX(-50%); /* Tengah horizontal */
        width: 95%;
        max-width: 1000px;
        background: var(--dark-brown);
        padding: 15px 25px;
        border-radius: 50px; /* Bentuk Pill/Kapsul */
        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        z-index: 100;
        display: flex;
        justify-content: center;
    }

    .booking-form {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        gap: 15px;
    }

    .action-item label {
        display: block;
        font-size: 0.7rem;
        color: rgba(255,255,255,0.6);
        text-transform: uppercase;
        margin-bottom: 2px;
    }

    .price-display {
        color: var(--gold-highlight);
        font-size: 1.4rem;
        font-weight: 700;
        line-height: 1;
    }

    .custom-select {
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        color: #fff;
        padding: 10px 20px;
        border-radius: 30px;
        outline: none;
        width: 100%;
        min-width: 200px;
        cursor: pointer;
    }
    
    .custom-select option { color: #333; }

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
    }

    .btn-next:disabled {
        background: #4A3B39;
        color: #6D5E5C;
        cursor: not-allowed;
    }
    
    .btn-next:not(:disabled):hover {
        transform: scale(1.05);
        box-shadow: 0 0 20px rgba(212, 175, 55, 0.5);
    }

    /* --- RESPONSIVE MOBILE --- */
    @media (max-width: 768px) {
        .floating-action-bar {
            width: 90%;
            bottom: 20px;
            padding: 15px;
            border-radius: 20px; /* Di HP agak kotak dikit biar muat */
            flex-direction: column;
        }

        .booking-form {
            flex-direction: row; /* Tetap baris tapi wrap */
            flex-wrap: wrap;
            justify-content: space-between;
        }
        
        .center-item {
            order: 3; /* Stylist pindah ke bawah di HP */
            width: 100%;
            margin-top: 10px;
            border-top: 1px dashed rgba(255,255,255,0.2);
            padding-top: 10px;
        }
        
        .custom-select { width: 100%; }

        /* Matikan fitur 'memanjang' di HP, balik jadi kotak biasa */
        .layanan-card:last-child {
            grid-column: auto; 
            flex-direction: column;
            align-items: flex-start;
            text-align: left;
        }
        .layanan-card:last-child .card-action {
            text-align: left;
            margin-top: auto;
        }
    }
</style>

<script>
    const inputLayanan = document.getElementById('id_layanan');
    const hargaDisplay = document.getElementById('harga-display');
    const btnSubmit = document.getElementById('btn-submit');
    const allCards = document.querySelectorAll('.layanan-card');

    function selectCard(element, id, harga) {
        // 1. Update Hidden Input & Harga
        inputLayanan.value = id;
        hargaDisplay.textContent = "Rp " + parseInt(harga).toLocaleString('id-ID');
        
        // 2. Enable tombol lanjut
        btnSubmit.disabled = false;

        // 3. Update Tampilan Kartu
        allCards.forEach(card => {
            card.classList.remove('active');
            // Reset text tombol
            const btn = card.querySelector('.select-btn');
            if(btn) btn.textContent = "Pilih";
        });

        element.classList.add('active');
        // Ubah text tombol jadi terpilih
        const activeBtn = element.querySelector('.select-btn');
        if(activeBtn) activeBtn.textContent = "Terpilih";
    }
</script>

<?= $this->endSection(); ?>