<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    .contact-wrapper-font { font-family: 'Montserrat', sans-serif; }

    /* Kotak Putih Utama */
    .contact-white-box {
        background-color: #ffffff;
        border-radius: 25px;
        padding: 60px 50px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
        max-width: 1200px;
        width: 100%;
        margin: 40px auto;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.02);
    }

    /* Judul Halaman */
    h1.page-title {
        text-align: center;
        margin: 0 0 15px 0;
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        color: var(--dark-brown, #5C2C27);
        font-weight: 700;
        letter-spacing: 1px;
    }

    .contact-subtitle {
        text-align: center;
        color: #666;
        font-size: 1rem;
        max-width: 700px;
        margin: 0 auto 50px;
        line-height: 1.6;
    }

    /* Dekorasi Background */
    .bg-decor { position: absolute; opacity: 0.03; pointer-events: none; z-index: 0; color: var(--dark-brown, #5C2C27); }
    .decor-phone { top: -20px; left: -20px; font-size: 15rem; transform: rotate(-15deg); }
    .decor-mail { bottom: -30px; right: -30px; font-size: 12rem; transform: rotate(10deg); }

    /* Grid Layout (2 Kolom) */
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.2fr; /* Kolom kanan (form) sedikit lebih lebar */
        gap: 50px;
        position: relative;
        z-index: 1;
    }

    /* === KOLOM KIRI: INFO & PETA === */
    .contact-info-col {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    .info-card {
        background: var(--light-cream-background, #FFFBF5);
        padding: 30px;
        border-radius: 15px;
        border-left: 5px solid var(--gold-accent, #B89B66);
    }

    .info-card h3 {
        font-family: 'Playfair Display', serif;
        margin: 0 0 20px 0;
        color: var(--dark-brown, #5C2C27);
        font-size: 1.5rem;
    }

    .info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .info-list li {
        margin-bottom: 15px;
        display: flex;
        align-items: flex-start;
        color: #555;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .info-list li i {
        margin-right: 15px;
        color: var(--primary-red, #A52B2B);
        font-size: 1.2rem;
        min-width: 25px; /* Agar ikon sejajar */
    }

    .info-list a {
        color: #555;
        text-decoration: none;
        transition: color 0.3s;
    }
    .info-list a:hover { color: var(--primary-red, #A52B2B); }

    /* Map Styling */
    .map-wrapper {
        border-radius: 15px;
        overflow: hidden;
        border: 2px solid #eee;
        height: 250px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .map-wrapper iframe { width: 100%; height: 100%; border: 0; }

    /* === KOLOM KANAN: FORM === */
    .contact-form-col {
        background: #fff;
        padding: 10px; /* Padding minimal karena sudah di dalam box putih */
    }

    .form-header { margin-bottom: 30px; }
    .form-header h3 { 
        font-family: 'Playfair Display', serif; 
        font-size: 1.8rem; 
        color: var(--dark-brown, #5C2C27); 
        margin-bottom: 10px;
    }
    .form-header p { color: #888; font-size: 0.9rem; }

    .form-group { margin-bottom: 20px; }
    
    .form-control {
        width: 100%;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-family: 'Montserrat', sans-serif;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: #fafafa;
    }

    .form-control:focus {
        border-color: var(--gold-accent, #B89B66);
        background-color: #fff;
        outline: none;
        box-shadow: 0 0 0 3px rgba(184, 155, 102, 0.1);
    }

    .btn-submit {
        background-color: var(--dark-brown, #5C2C27);
        color: #fff;
        border: none;
        padding: 15px 40px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .btn-submit:hover {
        background-color: var(--primary-red, #A52B2B);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(165, 43, 43, 0.3);
    }

    /* Alert Style */
    .alert { padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: 600; text-align: center; }
    .alert.success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    .alert.error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

    /* Responsif */
    @media (max-width: 900px) {
        .contact-grid { grid-template-columns: 1fr; gap: 40px; }
        .contact-white-box { padding: 40px 20px; }
    }
</style>

<div class="contact-wrapper-font">
    <div class="container">
        
        <div class="contact-white-box">
            
            <div class="bg-decor decor-phone"><i class="fas fa-phone-alt"></i></div>
            <div class="bg-decor decor-mail"><i class="fas fa-envelope-open-text"></i></div>

            <h1 class="page-title">GET IN TOUCH</h1>
            <p class="contact-subtitle">
                Hubungi SANBARBERS untuk pertanyaan, reservasi, atau sekadar menyapa. Kami selalu siap membantu Anda tampil lebih percaya diri.
            </p>

            <div class="contact-grid">
                
                <div class="contact-info-col">
                    
                    <div class="info-card">
                        <h3>Kontak & Lokasi</h3>
                        <ul class="info-list">
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Jl. Widuri 1, Bangetayu Kulon, Kec. Genuk, Kota Semarang, Jawa Tengah</span>
                            </li>
                            <li>
                                <i class="fab fa-whatsapp"></i>
                                <a href="https://wa.me/6281513728023" target="_blank">+62 815-1372-8023</a>
                            </li>
                            <li>
                                <i class="far fa-envelope"></i>
                                <a href="mailto:bagasilham@gmail.com">bagasilham@gmail.com</a>
                            </li>
                            <li>
                                <i class="far fa-clock"></i>
                                <span>Buka Setiap Hari: 10.00 - 21.00 WIB</span>
                            </li>
                        </ul>
                        
                        <div style="margin-top: 20px; display: flex; gap: 15px;">
                            <a href="https://instagram.com/sanbarbers" style="font-size: 1.5rem; color: #5C2C27;"><i class="fab fa-instagram"></i></a>
                            <a href="#" style="font-size: 1.5rem; color: #5C2C27;"><i class="fab fa-facebook"></i></a>
                            <a href="#" style="font-size: 1.5rem; color: #5C2C27;"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>

                    <div class="map-wrapper">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2892.4799371266295!2d110.46949489648352!3d-6.969851963119725!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70f300c0b15dcd%3A0x9e6bb3d59c13e648!2sSAN%20BARBERS!5e0!3m2!1sid!2sid!4v1762517582889!5m2!1sid!2sid" allowfullscreen loading="lazy"></iframe>
                    </div>

                </div>

                <div class="contact-form-col">
                    
                    <div class="form-header">
                        <h3>Kirim Pesan</h3>
                        <p>Isi formulir di bawah ini dan tim kami akan segera membalasnya.</p>
                    </div>

                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success'); ?></div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert error"><i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error'); ?></div>
                    <?php endif; ?>

                    <form action="<?= base_url('contact/send'); ?>" method="post">
                        <?= csrf_field(); ?>
                        
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required>
                        </div>
                        
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Alamat Email" required>
                        </div>
                        
                        <div class="form-group">
                            <input type="tel" name="phone" class="form-control" placeholder="Nomor WhatsApp" required>
                        </div>
                        
                        <div class="form-group">
                            <textarea name="message" rows="5" class="form-control" placeholder="Tulis pesan Anda di sini..." required></textarea>
                        </div>
                        
                        <button type="submit" class="btn-submit">
                            Kirim Pesan <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>

                </div>

            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>