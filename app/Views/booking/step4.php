<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    .booking-wrapper-font {
        font-family: 'Montserrat', sans-serif;
    }

    /* LAYOUT */
    .booking-white-box {
        background-color: #ffffff;
        border-radius: 25px;
        padding: 50px 40px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
        max-width: 800px;
        width: 100%;
        margin: 40px auto;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.02);
    }

    h2.page-title {
        text-align: center;
        margin: 20px 0 10px 0;
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        color: #5C2C27;
        font-weight: 700;
    }

    .page-subtitle {
        text-align: center;
        color: #777;
        margin-bottom: 40px;
        font-size: 1rem;
    }

    .bg-decor {
        position: absolute;
        opacity: 0.04;
        pointer-events: none;
        z-index: 0;
        color: #5C2C27;
    }

    .decor-list {
        top: -30px;
        right: -30px;
        font-size: 14rem;
        transform: rotate(10deg);
    }

    .decor-check {
        bottom: -20px;
        left: -20px;
        font-size: 10rem;
        transform: rotate(-15deg);
    }

    /* --- STEP INDICATOR --- */
    .step-indicator {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 40px;
        position: relative;
        z-index: 2;
    }

    .step-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 2;
        width: 80px;
    }

    .step-circle {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background-color: #eee;
        color: #999;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: 700;
        margin-bottom: 8px;
        border: 2px solid #eee;
        font-size: 0.9rem;
    }

    .step-text {
        font-size: 0.75rem;
        color: #999;
        font-weight: 600;
        text-align: center;
    }

    .step-line {
        height: 3px;
        background-color: #eee;
        flex-grow: 1;
        margin: 0 -15px 25px -15px;
        z-index: 1;
        max-width: 60px;
    }

    /* Completed */
    .step-item.completed .step-circle {
        background-color: #cba155;
        border-color: #cba155;
        color: white;
    }

    .step-item.completed .step-text {
        color: #cba155;
    }

    .step-line.completed {
        background-color: #cba155;
    }

    /* Active */
    .step-item.active .step-circle {
        background-color: #3e2b26;
        border-color: #3e2b26;
        color: white;
        transform: scale(1.1);
        box-shadow: 0 5px 15px rgba(62, 43, 38, 0.3);
    }

    .step-item.active .step-text {
        color: #3e2b26;
        font-weight: 700;
    }

    /* --- REVIEW DATA CARD --- */
    .review-container {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }

    .review-card {
        background: #fdfdfd;
        border: 1px solid #eee;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
    }

    .card-header {
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 15px;
        margin-bottom: 15px;
    }

    .card-header h3 {
        margin: 0;
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        color: #3e2b26;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .data-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
        font-size: 0.95rem;
    }

    .data-row:last-child {
        margin-bottom: 0;
    }

    .data-label {
        color: #888;
        font-weight: 500;
        min-width: 80px;
    }

    .data-value {
        color: #333;
        font-weight: 600;
        text-align: right;
        max-width: 60%;
    }

    .highlight-value {
        color: #a52b2b;
        background: #fff0f0;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 0.9rem;
    }

    .btn-submit {
        width: 100%;
        padding: 16px;
        background-color: #3e2b26;
        color: #fff;
        border: none;
        border-radius: 50px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        box-shadow: 0 5px 15px rgba(62, 43, 38, 0.2);
    }

    .btn-submit:hover {
        background-color: #a52b2b;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(165, 43, 43, 0.3);
    }

    .btn-back {
        display: block;
        text-align: center;
        margin-top: 15px;
        color: #888;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: color 0.3s;
    }

    .btn-back:hover {
        color: #3e2b26;
    }

    @media (max-width: 700px) {
        .review-container {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .booking-white-box {
            padding: 40px 20px;
        }
    }
</style>

<div class="booking-wrapper-font">
    <div class="container">

        <div class="booking-white-box">

            <div class="bg-decor decor-list"><i class="fas fa-clipboard-list"></i></div>
            <div class="bg-decor decor-check"><i class="far fa-check-circle"></i></div>

            <div class="step-indicator">
                <div class="step-item completed">
                    <div class="step-circle"><i class="fas fa-check"></i></div><span class="step-text">Layanan</span>
                </div>
                <div class="step-line completed"></div>
                <div class="step-item completed">
                    <div class="step-circle"><i class="fas fa-check"></i></div><span class="step-text">Waktu</span>
                </div>
                <div class="step-line completed"></div>
                <div class="step-item completed">
                    <div class="step-circle"><i class="fas fa-check"></i></div><span class="step-text">Data Diri</span>
                </div>
                <div class="step-line completed"></div>
                <div class="step-item active">
                    <div class="step-circle">4</div><span class="step-text">Review</span>
                </div>
            </div>

            <h2 class="page-title">Cek Kembali Pesanan Anda</h2>
            <p class="page-subtitle">Pastikan semua data sudah benar sebelum kami memproses booking Anda.</p>

            <form action="<?= base_url('booking/submit') ?>" method="post">
                <?= csrf_field(); ?>

                <div class="review-container">

                    <div class="review-card">
                        <div class="card-header">
                            <h3><i class="fas fa-cut"></i> Detail Booking</h3>
                        </div>

                        <div class="data-row">
                            <span class="data-label">Layanan</span>
                            <span class="data-value"><?= esc($booking['layanan_nama'] ?? '-') ?></span>
                        </div>

                        <div class="data-row">
                            <span class="data-label">Harga</span>
                            <span class="data-value">Rp <?= number_format($booking['layanan_harga'] ?? 0, 0, ',', '.') ?></span>
                        </div>

                        <div class="data-row">
                            <span class="data-label">Stylist</span>
                            <span class="data-value"><?= esc($booking['capster_nama'] ?? 'Any Stylist') ?></span>
                        </div>

                        <div class="data-row">
                            <span class="data-label">Tanggal</span>
                            <span class="data-value highlight-value">
                                <i class="far fa-calendar-alt"></i>
                                <?php
                                $date = date_create($booking['tanggal']);
                                echo date_format($date, "d F Y");
                                ?>
                            </span>
                        </div>

                        <div class="data-row">
                            <span class="data-label">Jam</span>
                            <span class="data-value highlight-value"><i class="far fa-clock"></i> <?= esc($booking['jam'] ?? '-') ?></span>
                        </div>
                    </div>

                    <div class="review-card">
                        <div class="card-header">
                            <h3><i class="far fa-user"></i> Data Pemesan</h3>
                        </div>

                        <div class="data-row">
                            <span class="data-label">Nama</span>
                            <span class="data-value"><?= esc($booking['nama_cust'] ?? '-') ?></span>
                        </div>
                        <div class="data-row">
                            <span class="data-label">No. HP</span>
                            <span class="data-value"><?= esc($booking['phone_cust'] ?? '-') ?></span>
                        </div>
                        <div class="data-row">
                            <span class="data-label">Email</span>
                            <span class="data-value" style="font-size:0.85rem;"><?= esc($booking['email'] ?? '-') ?></span>
                        </div>
                        <div class="data-row">
                            <span class="data-label">Catatan</span>
                            <span class="data-value" style="font-style:italic;">
                                <?= !empty($booking['note_cust']) ? esc($booking['note_cust']) : 'Tidak ada catatan' ?>
                            </span>
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn-submit">
                    Konfirmasi Booking <i class="fas fa-check-double"></i>
                </button>

                <a href="<?= base_url('booking/step3') ?>" class="btn-back"><i class="fas fa-arrow-left"></i> Edit Data</a>

            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>