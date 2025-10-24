<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<section class="gallery">
    <h2>Gallery</h2>
    <div class="gallery-grid">
        <img src="<?= base_url('assets/images/gallery1.jpg'); ?>" alt="Barbershop Interior">
        <img src="<?= base_url('assets/images/gallery2.jpg'); ?>" alt="Haircut Style">
        <img src="<?= base_url('assets/images/gallery3.jpg'); ?>" alt="Barber Team">
    </div>
</section>

<?= $this->endSection(); ?>
