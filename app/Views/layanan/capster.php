<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container my-5">
    
    <h1 class="text-center mb-4">Tim Capster Profesional Kami</h1>
    <p class="text-center text-muted">Temukan capster terbaik yang sesuai dengan gaya Anda. Semua capster ini dikelola melalui dashboard admin.</p>
    
    <hr class="mb-5">

    <div class="row">
        <?php if (isset($daftar_capster) && !empty($daftar_capster)) : ?>
            <?php foreach ($daftar_capster as $capster) : ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-0 text-center">
                        <div class="card-body">
                            <img src="<?= base_url('assets/img/capster/' . $capster['foto']); ?>" 
                                 alt="<?= esc($capster['nama']); ?>" 
                                 class="img-fluid rounded-circle mb-3 border border-3" 
                                 style="width: 150px; height: 150px; object-fit: cover;">
                            
                            <h4 class="card-title"><?= esc($capster['nama']); ?></h4>
                            <p class="card-subtitle text-brown mb-2">
                                Spesialisasi: <strong><?= esc($capster['spesialisasi']); ?></strong>
                            </p>
                            
                            <p class="card-text text-secondary small">
                                <?= nl2br(esc($capster['deskripsi'])); ?>
                            </p>
                            
                            <a href="<?= base_url('booking'); ?>?capster=<?= urlencode($capster['nama']); ?>" class="btn btn-dark-brown mt-3">
                                Booking Capster Ini
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="col-12">
                <div class="alert alert-info text-center" role="alert">
                    Mohon maaf, data Capster saat ini belum tersedia.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection(); ?>