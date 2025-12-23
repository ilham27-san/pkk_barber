<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<section class="hero-section">
    <div class="hero-content">
        <h1>Welcome to SANBARBERS</h1>
        <p>Potong rambut modern, cepat, dan stylish untuk pria masa kini!</p>
        <a href="booking" class="btn-primary">Book Now</a>
    </div>

    <div class="hero-logo-wrapper">
        <img src="<?= base_url('assets/images/Logo.png'); ?>" alt="Logo BarberNow">
    </div>
</section>

<section class="features-section">
    <div class="container">
        <div class="feature-box">
            <i class="fas fa-cut"></i>
            <h3>Latest Hairstyle</h3>
            <p>Potongan rambut pria modern, rapi, dan sesuai tren masa kini.
            </p>
        </div>
        <div class="feature-box">
            <i class="fas fa-store"></i>
            <h3>Our Services</h3>
            <p>Layanan barbershop lengkap: haircut, hair wash, styling, hingga perawatan rambut & janggut.
            </p>
        </div>
        <div class="feature-box">
            <i class="fas fa-envelope"></i>
            <h3>Easy Booking</h3>
            <p>Booking online cepat dan mudah, pilih barber & jadwal sesuai keinginan Anda.</p>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>