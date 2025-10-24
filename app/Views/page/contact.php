<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<section class="contact">
    <h2>Contact Us</h2>
    <?php if (session()->getFlashdata('success')) : ?>
        <p class="alert alert-success"><?= session()->getFlashdata('success'); ?></p>
    <?php endif; ?>

    <form action="<?= base_url('contact/send'); ?>" method="post">
        <label>Nama:</label>
        <input type="text" name="nama" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Pesan:</label>
        <textarea name="pesan" required></textarea>

        <button type="submit">Kirim Pesan</button>
    </form>
</section>

<?= $this->endSection(); ?>
