<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    .gallery-wrapper-font { font-family: 'Montserrat', sans-serif; }

    /* CONTAINER UTAMA */
    .gallery-white-box {
        background-color: #ffffff;
        border-radius: 30px;
        padding: 50px 40px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
        max-width: 1200px;
        width: 100%;
        margin: 40px auto;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.02);
        min-height: 600px;
    }

    h1.page-title {
        text-align: center; margin: 0 0 15px 0;
        font-family: 'Playfair Display', serif;
        font-size: 3rem; color: var(--dark-brown, #5C2C27);
        font-weight: 700; letter-spacing: 1px;
    }

    .gallery-subtitle {
        text-align: center; color: #888; font-size: 1.1rem;
        max-width: 600px; margin: 0 auto 50px; line-height: 1.6;
    }

    /* DEKORASI BACKGROUND */
    .bg-decor { position: absolute; opacity: 0.03; pointer-events: none; z-index: 0; color: var(--dark-brown, #5C2C27); }
    .decor-camera { top: -30px; right: -20px; font-size: 15rem; transform: rotate(15deg); }
    .decor-frame { bottom: -40px; left: -40px; font-size: 12rem; transform: rotate(-10deg); }

    /* --- LAYOUT GRID STABIL (3 KOLOM) --- */
    .gallery-grid {
        display: grid;
        /* Membuat kolom otomatis dengan lebar minimal 300px per item */
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
        position: relative;
        z-index: 1;
        width: 100%;
        /* Menengahkan item jika jumlahnya sedikit */
        justify-content: center; 
    }

    /* ITEM KARTU */
    .gallery-item {
        position: relative; 
        border-radius: 15px;
        overflow: hidden; 
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        background-color: #f9f9f9;
        
        /* Animasi */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        animation: fadeUp 0.8s ease forwards;
        opacity: 0; transform: translateY(20px);
    }

    .gallery-item:nth-child(1) { animation-delay: 0.1s; }
    .gallery-item:nth-child(2) { animation-delay: 0.2s; }
    .gallery-item:nth-child(3) { animation-delay: 0.3s; }
    .gallery-item:nth-child(n+4) { animation-delay: 0.4s; }

    @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }

    .gallery-item:hover {
        transform: translateY(-5px); 
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    /* GAMBAR */
    .gallery-item img {
        width: 100%; 
        height: auto; /* Tinggi menyesuaikan gambar asli (Memanjang ke bawah jika portrait) */
        display: block; 
        transition: transform 0.5s ease;
    }
    
    .gallery-item:hover img { transform: scale(1.05); }

    /* OVERLAY TEXT (UKURAN DIPERBESAR) */
    .gallery-overlay {
        position: absolute; bottom: 0; left: 0; width: 100%;
        background: linear-gradient(to top, rgba(0,0,0,0.85), transparent); /* Gradien lebih gelap sedikit */
        padding: 25px; /* Padding lebih besar */
        color: white;
        opacity: 0; transform: translateY(10px);
        transition: all 0.3s ease;
        pointer-events: none; /* Agar klik tembus ke gambar jika perlu */
    }
    .gallery-item:hover .gallery-overlay { opacity: 1; transform: translateY(0); }

    /* JUDUL DIPERBESAR */
    .gallery-overlay h3 { 
        margin: 0 0 5px 0; 
        font-family: 'Montserrat', sans-serif; 
        font-size: 1.5rem; /* Ukuran font judul lebih besar */
        font-weight: 700; 
        color: #eecfa1; /* Warna emas muda */
        text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    }

    /* DESKRIPSI DIPERBESAR */
    .gallery-overlay p { 
        margin: 0; 
        font-size: 1.1rem; /* Ukuran font deskripsi lebih besar */
        color: #f0f0f0; 
        font-weight: 500;
        text-shadow: 0 1px 2px rgba(0,0,0,0.5);
    }

    /* EMPTY STATE */
    .empty-gallery-state {
        grid-column: 1 / -1; /* Memenuhi lebar penuh grid */
        text-align: center; padding: 100px 20px; color: #999;
    }

    /* RESPONSIVE */
    @media (max-width: 576px) {
        .gallery-white-box { padding: 40px 20px; }
        .gallery-overlay h3 { font-size: 1.3rem; }
        .gallery-overlay p { font-size: 1rem; }
    }
</style>

<div class="gallery-wrapper-font">
    <div class="container">
        
        <div class="gallery-white-box">
            
            <div class="bg-decor decor-camera"><i class="fas fa-camera"></i></div>
            <div class="bg-decor decor-frame"><i class="far fa-image"></i></div>

            <h1 class="page-title">OUR GALLERY</h1>
            <p class="gallery-subtitle">
                Intip hasil karya terbaik stylist kami.
            </p>

            <div class="gallery-grid">
                <?php if (!empty($gallery)) : ?>
                    <?php foreach ($gallery as $g) : ?>
                        <div class="gallery-item">
                            <img src="<?= base_url('img/gallery/' . $g['gambar']) ?>" alt="<?= $g['judul'] ?>">
                            
                            <div class="gallery-overlay">
                                <h3><?= $g['judul'] ?></h3>
                                <?php if(!empty($g['deskripsi'])): ?>
                                    <p><?= $g['deskripsi'] ?></p> 
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                     <div class="empty-gallery-state">
                        <i class="far fa-images" style="font-size: 4rem; margin-bottom: 20px; opacity: 0.3;"></i>
                        <p>Belum ada foto di gallery.</p>
                     </div>
                <?php endif; ?>
            </div>  

        </div>
    </div>
</div>

<?= $this->endSection(); ?>