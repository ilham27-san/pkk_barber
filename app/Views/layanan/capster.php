<?= $this->extend('layout/template'); ?>

<?= $this->section('css'); ?>
<style>
    /* --- CSS KHUSUS HALAMAN CAPSTER (Embedded) --- */
    :root {
        --primary-gold: #c59d5f;
        --dark-bg: #222;
        --card-bg: #fff;
        --text-grey: #666;
    }

    .capster-section {
        padding: 3rem 0;
        background-color: #f8f9fa;
        /* Background halaman */
    }

    .section-title {
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .section-subtitle {
        color: var(--text-grey);
        margin-bottom: 3rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Card Styling */
    .capster-card {
        background: var(--card-bg);
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        height: 100%;
        /* Agar tinggi kartu sama rata */
        display: flex;
        flex-direction: column;
    }

    .capster-card:hover {
        transform: translateY(-10px);
        /* Efek melayang saat hover */
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    /* Image Wrapper */
    .capster-img-wrapper {
        padding: 30px 20px 10px;
        text-align: center;
        background: linear-gradient(to bottom, #f1f1f1 50%, #fff 50%);
    }

    .capster-img {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid var(--primary-gold);
        padding: 3px;
        background: #fff;
        transition: transform 0.3s ease;
    }

    .capster-card:hover .capster-img {
        transform: scale(1.05);
    }

    /* Card Body */
    .capster-body {
        padding: 20px;
        text-align: center;
        flex-grow: 1;
        /* Mendorong tombol ke bawah */
        display: flex;
        flex-direction: column;
    }

    .capster-name {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 5px;
        color: #333;
    }

    .capster-role {
        color: var(--primary-gold);
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        margin-bottom: 15px;
        display: block;
    }

    .capster-desc {
        color: var(--text-grey);
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 20px;
        flex-grow: 1;
    }

    /* Button Styling */
    .btn-booking {
        background-color: #333;
        color: var(--primary-gold);
        border: 1px solid #333;
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
        width: 100%;
    }

    .btn-booking:hover {
        background-color: var(--primary-gold);
        color: #fff;
        border-color: var(--primary-gold);
    }

    /* Responsive adjustment */
    @media (max-width: 768px) {
        .capster-img {
            width: 120px;
            height: 120px;
        }
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="capster-section">
    <div class="container">
        <div class="text-center">
            <h1 class="section-title">Meet Our Experts</h1>
            <p class="section-subtitle">
                Tim profesional yang siap mengubah penampilan Anda. Pilih stylist favorit Anda dan booking sekarang juga.
            </p>
        </div>

        <div class="row">
            <?php if (isset($daftar_capster) && !empty($daftar_capster)) : ?>
                <?php foreach ($daftar_capster as $capster) : ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="capster-card">
                            <div class="capster-img-wrapper">
                                <img src="<?= base_url('assets/img/capster/' . $capster['foto']); ?>"
                                    alt="<?= esc($capster['nama']); ?>"
                                    class="capster-img"
                                    onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name=<?= urlencode($capster['nama']) ?>&background=333&color=c59d5f&size=150';">
                            </div>

                            <div class="capster-body">
                                <h3 class="capster-name"><?= esc($capster['nama']); ?></h3>
                                <span class="capster-role"><?= esc($capster['spesialisasi']); ?></span>

                                <p class="capster-desc">
                                    <?= nl2br(esc($capster['deskripsi'])); ?>
                                </p>

                                <a href="<?= base_url('booking'); ?>?id_capster=<?= $capster['id_capster']; ?>" class="btn-booking">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        <i class="fas fa-exclamation-circle"></i>
                        Belum ada data stylist yang tersedia saat ini.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>