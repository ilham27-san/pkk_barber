<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
    .capster-wrapper-font { font-family: 'Poppins', sans-serif; color: #444; }

    /* --- CONTAINER UTAMA --- */
    .capster-white-box {
        background-color: #ffffff;
        border-radius: 40px;
        padding: 60px 40px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.05);
        max-width: 1200px; width: 100%; margin: 50px auto;
        position: relative; overflow: hidden;
        border: 1px solid rgba(255,255,255,0.8);
        min-height: 500px;
    }

    /* HEADER */
    .page-header { text-align: center; margin-bottom: 60px; position: relative; z-index: 2; }
    .page-title {
        font-family: 'Playfair Display', serif; font-size: 3.5rem; color: #2c2c2c;
        font-weight: 800; margin: 0 0 15px 0; letter-spacing: -1px;
    }
    .page-subtitle { color: #888; font-size: 1.1rem; max-width: 600px; margin: 0 auto; line-height: 1.8; font-weight: 300; }

    /* LIST CONTAINER */
    .experts-list-container { display: flex; flex-direction: column; gap: 40px; position: relative; z-index: 2; }

    /* --- KARTU STYLIST --- */
    .stylist-card-modern {
        background: #fff; border-radius: 30px; overflow: hidden;
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        display: flex; flex-direction: row;
        box-shadow: 0 15px 35px rgba(0,0,0,0.06);
        border: 1px solid #f9f9f9; min-height: 280px;
        position: relative; z-index: 1;
    }

    .stylist-card-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 60px rgba(0,0,0,0.12);
    }

    /* --- ANIMASI KEYFRAMES (MENYEBAR) --- */
    @keyframes burstOut {
        0% { opacity: 0.1; transform: translate(-50%, -50%) scale(0.6) rotate(0deg); }
        50% { opacity: 0.3; }
        100% { opacity: 0; transform: translate(-50%, -50%) scale(2.2) rotate(45deg); }
    }

    /* --- AREA KIRI: GAMBAR & ANIMASI --- */
    .stylist-img-section {
        width: 35%; 
        background: #fdfaf7; 
        position: relative; 
        display: flex; align-items: center; justify-content: center;
        padding: 20px; 
        border-right: 1px solid rgba(0,0,0,0.03);
        overflow: hidden; 
        z-index: 1; 
    }

    /* ELEMEN IKON DI BELAKANG GAMBAR */
    .stylist-img-section::before,
    .stylist-img-section::after {
        font-family: "Font Awesome 5 Free"; font-weight: 900; 
        position: absolute; top: 50%; left: 50%;
        transform: translate(-50%, -50%) scale(0.6); 
        white-space: nowrap; opacity: 0.15; 
        z-index: 0; pointer-events: none;
        animation-name: burstOut; animation-duration: 4s;
        animation-timing-function: linear; animation-iteration-count: infinite;
        animation-play-state: paused; transition: opacity 0.3s;
    }

    .stylist-img-section::before {
        content: '\f0c4 \00a0 \f0c4 \00a0 \f0c4 \00a0 \f0c4'; 
        font-size: 5rem; color: #cba155;
    }
    
    .stylist-img-section::after {
        content: '\f0c4 \00a0 \f0c4 \00a0 \f0c4 \00a0 \f0c4';
        font-size: 7rem; color: #3e2b26; animation-delay: 2s;
    }

    .stylist-card-modern:hover .stylist-img-section::before,
    .stylist-card-modern:hover .stylist-img-section::after {
        animation-play-state: running; opacity: 0.4; 
    }

    /* GAMBAR ORANG */
    .stylist-img {
        width: 100%; height: 100%; max-height: 250px; object-fit: contain;
        filter: drop-shadow(0 10px 20px rgba(0,0,0,0.1));
        transition: transform 0.5s ease;
        position: relative; z-index: 10; 
    }
    
    .stylist-card-modern:hover .stylist-img { transform: scale(1.08) rotate(-2deg); }


    /* --- KANAN: KONTEN --- */
    .stylist-content-section { 
        width: 65%; padding: 40px; 
        display: flex; flex-direction: column; justify-content: center; 
    }
    
    .modern-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px; }
    
    .stylist-name-large { 
        font-family: 'Playfair Display', serif; font-size: 2.2rem; 
        color: #222; margin: 0; font-weight: 700; line-height: 1.1; 
        display: flex; align-items: center; gap: 10px; 
    }
    
    .verified-icon { 
        color: #1da1f2; font-size: 1.2rem; 
        background: rgba(29, 161, 242, 0.1); padding: 4px; border-radius: 50%; 
    }
    
    .role-label { 
        font-size: 0.8rem; font-weight: 600; letter-spacing: 2px; 
        color: #bfa070; text-transform: uppercase; margin-bottom: 20px; display: block; 
    }
    
    .modern-bio { 
        color: #666; font-size: 0.95rem; line-height: 1.7; margin-bottom: 30px; 
    }
    
    /* Footer sekarang hanya tombol */
    .modern-footer { margin-top: auto; }
    
    .btn-modern-book { 
        display: block; width: 100%;
        background: linear-gradient(135deg, #3e2b26 0%, #5d4037 100%); 
        color: #fff; text-decoration: none; padding: 16px 0; text-align: center; 
        border-radius: 14px; font-weight: 600; font-size: 1rem; letter-spacing: 0.5px; 
        box-shadow: 0 10px 20px rgba(62, 43, 38, 0.2); transition: all 0.3s; border: none; 
    }
    .btn-modern-book:hover { 
        box-shadow: 0 15px 30px rgba(62, 43, 38, 0.3); transform: translateY(-2px); 
        background: linear-gradient(135deg, #5d4037 0%, #3e2b26 100%); color: #fff; 
    }

    @media (max-width: 992px) {
        .capster-white-box { padding: 40px 20px; }
        .stylist-card-modern { flex-direction: column; min-height: auto; }
        .stylist-img-section { width: 100%; height: 300px; border-right: none; border-bottom: 1px solid #f0f0f0; }
        .stylist-content-section { width: 100%; padding: 30px 25px; }
        .modern-header { flex-direction: column; align-items: flex-start; gap: 10px; }
    }
</style>

<div class="capster-wrapper-font">
    <div class="container">
        
        <div class="capster-white-box">
            
            <div class="page-header">
                <h1 class="page-title">Meet Our Experts</h1>
                <p class="page-subtitle">Stylist berpengalaman kami siap memberikan potongan terbaik<br>yang sesuai dengan karakter Anda.</p>
            </div>

            <div class="experts-list-container">
                
                <?php if (isset($daftar_capster) && !empty($daftar_capster)) : ?>
                    <?php foreach ($daftar_capster as $capster) : ?>
                        
                        <div class="stylist-card-modern">
                            
                            <div class="stylist-img-section">
                                <img src="<?= base_url('assets/img/capster/' . $capster['foto']); ?>" 
                                     alt="<?= esc($capster['nama']); ?>" 
                                     class="stylist-img"
                                     onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name=<?= urlencode($capster['nama']) ?>&background=transparent&color=333&size=512';">
                            </div>

                            <div class="stylist-content-section">
                                <div class="modern-header">
                                    <h3 class="stylist-name-large">
                                        <?= esc($capster['nama']); ?>
                                        <i class="fas fa-check verified-icon" title="Verified Expert"></i>
                                    </h3>
                                </div>
                                
                                <span class="role-label"><?= esc($capster['spesialisasi']); ?> EXPERT</span>
                                
                                <p class="modern-bio">
                                    <?= !empty($capster['deskripsi']) ? nl2br(esc($capster['deskripsi'])) : 'Stylist profesional dengan dedikasi tinggi, menguasai teknik potongan modern dan klasik untuk menunjang penampilan terbaik Anda.' ?>
                                </p>

                                <div class="modern-footer">
                                    <a href="<?= base_url('booking'); ?>?id_capster=<?= $capster['id_capster']; ?>" class="btn-modern-book">
                                        Booking <i class="fas fa-arrow-right" style="margin-left:8px; font-size:0.8rem;"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php else : ?>
                    <div style="text-align: center; padding: 60px; color: #999;">
                        <i class="far fa-sad-tear" style="font-size: 4rem; margin-bottom: 20px; opacity: 0.3;"></i>
                        <p>Belum ada stylist yang tersedia.</p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>