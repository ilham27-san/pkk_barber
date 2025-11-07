<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1>Welcome to BarberNow</h1>
            <p>Potong rambut modern, cepat, dan stylish untuk pria masa kini!</p>
            
            <a href="#" class="btn-primary">Book Now</a>
        </div>
    </div>
</section>

<section class="features-section">
    <div class="container">
        <div class="feature-box">
            <i class="fas fa-cut"></i> <h3>Laset Pistetion</h3>
            <p>Potong rambut modern dan pria masa kini.</p>
        </div>
        <div class="feature-box">
            <i class="fas fa-store"></i>
            <h3>Services Services</h3>
            <p>Layanan premium di barbershop kami.</p>
        </div>
        <div class="feature-box">
            <i class="fas fa-envelope"></i>
            <h3>Decum End</h3>
            <p>Mode baru, apa pun bisnis Anda.</p>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>