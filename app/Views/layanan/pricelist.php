<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<section class="pricelist-section">
    <div class="container">
        <div class="section-header">
            <h2 class="title">Daftar Layanan & Pricelist</h2>
            <p class="subtitle">Pilih perawatan terbaik untuk gaya rambutmu</p>
        </div>

        <?php if (!empty($layanan) && is_array($layanan)): ?>
            <div class="card-grid">
                <?php foreach ($layanan as $row): ?>
                    <div class="card-service">
                        <div class="card-header-group">
                            <h3 class="service-name"><?= esc($row['nama_layanan']) ?></h3>
                            <p class="service-desc"><?= esc($row['deskripsi']) ?></p>
                        </div>

                        <div class="service-footer">
                            <span class="price-tag">Rp <?= number_format($row['harga'], 0, ',', '.') ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <p>Belum ada layanan yang tersedia saat ini.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
    /* 1. SETUP WARNA & FONT */
    :root {
        --bg-cream: #F5F0E6;
        /* Background Halaman */
        --card-white: #FFFFFF;
        /* Warna Kartu */
        --text-dark: #3E2723;
        /* Cokelat Tua (Teks Utama) */
        --text-accent: #6D4C41;
        /* Cokelat Sedang (Subjudul) */
        --gold-accent: #a87531;
        /* Garis dekorasi */
    }

    .pricelist-section {
        background-color: var(--bg-cream);
        padding: 60px 20px;
        min-height: 80vh;
        font-family: 'Poppins', sans-serif;
        /* Font default body */
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* 2. HEADER SECTION (YANG DIUBAH FONTSNYA) */
    .section-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .title {
        /* INI PERUBAHANNYA: Menggunakan font Serif seperti 'GET IN TOUCH' */
        font-family: 'Playfair Display', 'Times New Roman', serif;
        font-size: 3rem;
        color: var(--dark-brown);
        text-transform: uppercase;
        /* Membuat huruf besar semua */
        letter-spacing: 2px;
        /* Memberi jarak antar huruf agar elegan */
        font-weight: 700;
        margin-bottom: 15px;
    }

    .subtitle {
        color: var(--text-accent);
        font-size: 1.1rem;
        font-weight: 400;
    }

    /* 3. GRID LAYOUT */
    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
    }

    /* 4. CARD STYLING */
    .card-service {
        background: var(--card-white);
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        /* Memastikan harga selalu di bawah */
        border: 1px solid rgba(0, 0, 0, 0.02);
    }

    .card-service:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(62, 39, 35, 0.15);
    }

    .service-name {
        font-family: 'Playfair Display', serif;
        /* Nama layanan juga pakai serif biar serasi */
        font-size: 1.5rem;
        color: var(--text-dark);
        margin-bottom: 10px;
        font-weight: 700;
    }

    .service-desc {
        font-size: 0.95rem;
        color: #795548;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    /* 5. HARGA & FOOTER */
    .service-footer {
        margin-top: auto;
        /* Dorong ke paling bawah */
        text-align: right;
        border-top: 1px dashed var(--gold-accent);
        padding-top: 15px;
    }

    .price-tag {
        display: inline-block;
        font-size: 1.2rem;
        font-weight: bold;
        color: var(--text-dark);
        background: #EFEBE9;
        padding: 8px 16px;
        border-radius: 6px;
    }

    /* Mobile Responsive */
    @media screen and (max-width: 768px) {
        .title {
            font-size: 2.2rem;
        }

        .card-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<?= $this->endSection(); ?>