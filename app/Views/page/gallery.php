<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    .gallery-wrapper-font { font-family: 'Montserrat', sans-serif; }

    .gallery-white-box {
        background-color: #ffffff;
        border-radius: 25px;
        padding: 60px 40px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
        max-width: 1300px;
        width: 100%;
        margin: 40px auto;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.02);
    }

    h1.page-title {
        text-align: center; margin: 0 0 20px 0;
        font-family: 'Playfair Display', serif;
        font-size: 3rem; color: var(--dark-brown, #5C2C27);
        font-weight: 700; letter-spacing: 2px;
    }

    .gallery-subtitle {
        text-align: center; color: #666; font-size: 1.1rem;
        max-width: 600px; margin: 0 auto 50px; line-height: 1.6;
    }

    /* DEKORASI */
    .bg-decor { position: absolute; opacity: 0.03; pointer-events: none; z-index: 0; color: var(--dark-brown, #5C2C27); }
    .decor-camera { top: -30px; right: -20px; font-size: 15rem; transform: rotate(15deg); }
    .decor-frame { bottom: -40px; left: -40px; font-size: 12rem; transform: rotate(-10deg); }

    /* GRID LAYOUT */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); 
        gap: 30px;
        position: relative;
        z-index: 1;
    }

    /* ITEM GALERI */
    .gallery-item {
        position: relative; 
        overflow: hidden; 
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        background-color: #f0f0f0;
        aspect-ratio: 4/3; 
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        
        /* Animasi Muncul */
        animation: fadeUp 0.8s ease forwards;
        opacity: 0; 
        transform: translateY(20px);
    }

    /* Delay Animasi (Efek Domino) */
    .gallery-item:nth-child(1) { animation-delay: 0.1s; }
    .gallery-item:nth-child(2) { animation-delay: 0.2s; }
    .gallery-item:nth-child(3) { animation-delay: 0.3s; }
    .gallery-item:nth-child(4) { animation-delay: 0.4s; }
    .gallery-item:nth-child(5) { animation-delay: 0.5s; }
    .gallery-item:nth-child(6) { animation-delay: 0.6s; }

    @keyframes fadeUp {
        to { opacity: 1; transform: translateY(0); }
    }

    .gallery-item:hover {
        transform: translateY(-5px); 
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }

    .gallery-item img {
        width: 100%; height: 100%; object-fit: cover;
        transition: transform 0.5s ease; display: block;
    }
    .gallery-item:hover img { transform: scale(1.1); }

    /* OVERLAY */
    .gallery-overlay {
        position: absolute; bottom: 0; left: 0; width: 100%;
        background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
        padding: 20px; color: white;
        opacity: 0; transform: translateY(20px);
        transition: all 0.3s ease; pointer-events: none;
    }
    .gallery-item:hover .gallery-overlay { opacity: 1; transform: translateY(0); }

    .gallery-overlay h3 { margin: 0; font-family: 'Montserrat', sans-serif; font-size: 1.2rem; font-weight: 600; color: var(--gold-accent, #B89B66); }
    .gallery-overlay p { margin: 5px 0 0; font-size: 0.9rem; color: #ddd; }

    @media (max-width: 768px) {
        .gallery-white-box { padding: 40px 20px; }
        .gallery-item { aspect-ratio: 1/1; }
    }
</style>

<div class="gallery-wrapper-font">
    <div class="container">
        
        <div class="gallery-white-box">
            
            <div class="bg-decor decor-camera"><i class="fas fa-camera"></i></div>
            <div class="bg-decor decor-frame"><i class="far fa-image"></i></div>

            <h1 class="page-title">OUR GALLERY</h1>
            <p class="gallery-subtitle">
                Momen terbaik, gaya rambut terbaru, dan suasana nyaman di BarberNow. Intip keseruan kami di sini.
            </p>

          <div class="gallery-grid">
                <?php if (!empty($gallery)) : ?>
                    <?php foreach ($gallery as $g) : ?>
                        <div class="gallery-item">
                            <img src="<?= base_url('img/gallery/' . $g['gambar']) ?>" alt="<?= $g['judul'] ?>">
                            <div class="gallery-overlay">
                                <h3><?= $g['judul'] ?></h3>
                                <p><?= $g['deskripsi'] ?></p> 
                            </div>
                        </div>
                    <?php endforeach; ?>
                       <?php else : ?>
                     <div style="grid-column: 1 / -1; text-align: center; padding: 50px; color: #999;">
                      <i class="far fa-image" style="font-size: 3rem; margin-bottom: 10px;"></i>
                       <p>Belum ada foto yang diunggah ke gallery.</p>
                     </div>
                     <?php endif; ?>
                </div>  
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>