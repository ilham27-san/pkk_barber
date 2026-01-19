<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php
// Ambil data dari session (jika user kembali dari step 4)
$sessionData = session()->get('booking_step3') ?? [];

// Helper kecil untuk prioritas data: 
// 1. Old Input (Baru saja gagal validasi)
// 2. Session Data (User menekan tombol back)
// 3. Kosong
function getVal($field, $sessionData)
{
    return old($field) ?? $sessionData[$field] ?? '';
}

// Cek error validation per field (bawaan CI4)
$errors = session()->getFlashdata('errors') ?? [];
?>

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
        font-size: 2.5rem;
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

    .decor-user {
        top: -20px;
        right: -20px;
        font-size: 12rem;
        transform: rotate(15deg);
    }

    .decor-pen {
        bottom: -30px;
        left: -30px;
        font-size: 10rem;
        transform: rotate(-10deg);
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

    /* FORM */
    .booking-form {
        position: relative;
        z-index: 2;
        max-width: 600px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #3e2b26;
        font-size: 0.95rem;
    }

    .form-control {
        width: 100%;
        padding: 14px;
        border: 2px solid #eee;
        border-radius: 10px;
        font-family: 'Montserrat', sans-serif;
        font-size: 1rem;
        background-color: #fafafa;
        color: #333;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: #cba155;
        background-color: #fff;
        outline: none;
        box-shadow: 0 0 0 3px rgba(203, 161, 85, 0.1);
    }

    /* Style untuk error validation */
    .form-control.is-invalid {
        border-color: #dc3545;
        background-color: #fff8f8;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.8rem;
        margin-top: 5px;
        display: block;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    .btn-next {
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
        margin-top: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .btn-next:hover {
        background-color: #a52b2b;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(165, 43, 43, 0.2);
    }

    @media (max-width: 600px) {
        .booking-white-box {
            padding: 40px 20px;
        }

        .step-text {
            display: none;
        }
    }
</style>

<div class="booking-wrapper-font">
    <div class="container">
        <div class="booking-white-box">

            <div class="bg-decor decor-user"><i class="far fa-user"></i></div>
            <div class="bg-decor decor-pen"><i class="fas fa-pen-nib"></i></div>

            <div class="step-indicator">
                <div class="step-item completed">
                    <div class="step-circle"><i class="fas fa-check"></i></div><span class="step-text">Layanan</span>
                </div>
                <div class="step-line completed"></div>

                <div class="step-item completed">
                    <div class="step-circle"><i class="fas fa-check"></i></div><span class="step-text">Waktu</span>
                </div>
                <div class="step-line completed"></div>

                <div class="step-item active">
                    <div class="step-circle">3</div><span class="step-text">Data Diri</span>
                </div>
                <div class="step-line"></div>

                <div class="step-item">
                    <div class="step-circle">4</div><span class="step-text">Review</span>
                </div>
            </div>

            <h2 class="page-title">Lengkapi Data Diri</h2>
            <p class="page-subtitle">Sedikit lagi! Isi data pemesan agar kami bisa menghubungi Anda.</p>

            <form action="<?= base_url('booking/step3Submit') ?>" method="post" class="booking-form">
                <?= csrf_field(); ?>

                <div class="form-group">
                    <label for="name" class="form-label"><i class="far fa-user" style="margin-right:8px;"></i> Nama Lengkap</label>
                    <input type="text" name="name" id="name"
                        class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                        placeholder="Masukkan nama Anda"
                        value="<?= esc(getVal('name', $sessionData)) ?>"
                        required>
                    <?php if (isset($errors['name'])): ?>
                        <div class="invalid-feedback"><?= $errors['name'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label"><i class="fab fa-whatsapp" style="margin-right:8px;"></i> Nomor HP / WhatsApp</label>
                    <input type="tel" name="phone" id="phone"
                        class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>"
                        placeholder="Contoh: 081234567890"
                        value="<?= esc(getVal('phone', $sessionData)) ?>"
                        required>
                    <?php if (isset($errors['phone'])): ?>
                        <div class="invalid-feedback"><?= $errors['phone'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label"><i class="far fa-envelope" style="margin-right:8px;"></i> Email (Opsional)</label>
                    <input type="email" name="email" id="email"
                        class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                        placeholder="email@contoh.com"
                        value="<?= esc(getVal('email', $sessionData)) ?>">
                    <?php if (isset($errors['email'])): ?>
                        <div class="invalid-feedback"><?= $errors['email'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="note" class="form-label"><i class="far fa-sticky-note" style="margin-right:8px;"></i> Catatan Tambahan</label>
                    <textarea name="note" id="note" class="form-control"
                        placeholder="Misal: Tolong jangan terlalu pendek bagian samping..."><?= esc(getVal('note', $sessionData)) ?></textarea>
                </div>

                <button type="submit" class="btn-next">
                    Review Pesanan <i class="fas fa-check-circle"></i>
                </button>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>