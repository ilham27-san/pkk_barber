<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<section class="contact-page">
    <div class="container">
        <h2>Kontak Kami</h2>
        <p>Hubungi SANBARBERS untuk pertanyaan, kerja sama, atau reservasi. Kami siap bantu kamu tampil makin keren 💈</p>

        <div class="contact-grid">
            <!-- Kolom kiri: Info kontak -->
            <div class="contact-info">
                <img src="<?= base_url('assets/images/logo-barber.png'); ?>" alt="SANBARBERS Logo" width="180">
                <h4>SANBARBERS</h4>
                <p>Jl. Widuri 1, Bangetayu Kulon, Kec. Genuk, Kota Semarang, Jawa Tengah</p>
                <ul>
                    <li>📞 <a href="tel:+6281513728023">+62 815-1372-8023</a></li>
                    <li>💬 <a href="https://wa.me/6281513728023" target="_blank">Chat WhatsApp</a></li>
                    <li>✉️ <a href="mailto:bagasilham@gmail.com">bagasilham@gmail.com</a></li>
                </ul>
                <div class="social-icons">
                    <a href="https://www.instagram.com/sanbarbers" target="_blank">Instagram</a> |
                    <a href="https://www.facebook.com/" target="_blank">Facebook</a> |
                    <a href="https://www.youtube.com/" target="_blank">YouTube</a>
                </div>
            </div>

            <!-- Kolom tengah: Google Maps -->
            <div class="contact-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2892.4799371266295!2d110.46949489648352!3d-6.969851963119725!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70f300c0b15dcd%3A0x9e6bb3d59c13e648!2sSAN%20BARBERS!5e0!3m2!1sid!2sid!4v1762517582889!5m2!1sid!2sid"
                    width="100%" height="280" style="border:0;" allowfullscreen loading="lazy"></iframe>
            </div>

            <!-- Kolom kanan: Form kirim pesan -->
            <div class="contact-form">
                <h4>Tinggalkan Pesan di Sini</h4>

                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert success"><?= session()->getFlashdata('success'); ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert error"><?= session()->getFlashdata('error'); ?></div>
                <?php endif; ?>

                <form action="<?= base_url('contact/send'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="text" name="name" placeholder="Nama Anda" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="tel" name="phone" placeholder="No. HP / WhatsApp" required>
                    <textarea name="message" rows="5" placeholder="Pesan..." required></textarea>
                    <button type="submit">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
    .contact-page {
        padding: 30px 20px;
    }

    .contact-page h2 {
        text-align: center;
        margin-bottom: 15px;
    }

    .container {
        max-width: 1100px;
        margin: 0 auto;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 30px;
        margin-top: 25px;
    }

    .contact-info img {
        margin-bottom: 10px;
    }

    .contact-info ul {
        list-style: none;
        padding: 0;
    }

    .contact-info li {
        margin: 5px 0;
    }

    .contact-info a {
        color: #000;
        text-decoration: none;
    }

    .contact-info a:hover {
        color: #ffcc00;
    }

    .social-icons {
        margin-top: 10px;
    }

    .contact-form form {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .contact-form input,
    .contact-form textarea {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .contact-form button {
        padding: 10px;
        background-color: #ffcc00;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
    }

    .contact-form button:hover {
        background-color: #e6b800;
    }

    .alert.success {
        background: #d1ffd1;
        padding: 8px;
        border-radius: 5px;
    }

    .alert.error {
        background: #ffd1d1;
        padding: 8px;
        border-radius: 5px;
    }

    @media (max-width: 900px) {
        .contact-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<?= $this->endSection(); ?>