<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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

    .decor-cal {
        top: -20px;
        right: -20px;
        font-size: 12rem;
        transform: rotate(15deg);
    }

    .decor-clock {
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

    /* FORM & ALERTS */
    .booking-form {
        position: relative;
        z-index: 2;
        max-width: 500px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        margin-bottom: 10px;
        font-weight: 600;
        color: #3e2b26;
        font-size: 1rem;
    }

    .form-control {
        width: 100%;
        padding: 15px;
        border: 2px solid #eee;
        border-radius: 12px;
        font-family: 'Montserrat', sans-serif;
        font-size: 1rem;
        background-color: #fafafa;
        color: #333;
        cursor: pointer;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: #cba155;
        background-color: #fff;
        outline: none;
        box-shadow: 0 0 0 3px rgba(203, 161, 85, 0.1);
    }

    /* CUSTOM ALERT BOX (Agar senada dengan tema) */
    .custom-alert {
        background-color: #ffebee;
        border-left: 5px solid #ef5350;
        color: #c62828;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 25px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 10px;
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
        margin-top: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .btn-next:hover {
        background-color: #a52b2b;
        transform: translateY(-2px);
    }

    /* FLATPICKR CUSTOMIZATION */
    .flatpickr-calendar {
        border: none !important;
        border-radius: 15px !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
        padding: 10px;
    }

    .flatpickr-day.selected,
    .flatpickr-day.startRange,
    .flatpickr-day.endRange {
        background: #cba155 !important;
        border-color: #cba155 !important;
    }

    .flatpickr-day.today {
        border-color: #cba155 !important;
        color: #cba155 !important;
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

            <div class="bg-decor decor-cal"><i class="far fa-calendar-alt"></i></div>
            <div class="bg-decor decor-clock"><i class="far fa-clock"></i></div>

            <div class="step-indicator">
                <div class="step-item completed">
                    <div class="step-circle"><i class="fas fa-check"></i></div><span class="step-text">Layanan</span>
                </div>
                <div class="step-line completed"></div>
                <div class="step-item active">
                    <div class="step-circle">2</div><span class="step-text">Waktu</span>
                </div>
                <div class="step-line"></div>
                <div class="step-item">
                    <div class="step-circle">3</div><span class="step-text">Data Diri</span>
                </div>
                <div class="step-line"></div>
                <div class="step-item">
                    <div class="step-circle">4</div><span class="step-text">Review</span>
                </div>
            </div>

            <h2 class="page-title">Pilih Waktu Kedatangan</h2>
            <p class="page-subtitle">Tentukan tanggal dan jam yang pas.</p>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="custom-alert">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?= session()->getFlashdata('error'); ?></span>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('booking/step2Submit') ?>" method="post" class="booking-form">
                <?= csrf_field(); ?>

                <div class="form-group">
                    <label for="tanggal" class="form-label">
                        <i class="far fa-calendar-check" style="margin-right:8px;"></i> Tanggal Booking
                    </label>
                    <input type="text" name="tanggal" id="tanggal"
                        class="form-control datepicker"
                        placeholder="Pilih Tanggal..."
                        value="<?= old('tanggal') ?>"
                        required>
                </div>

                <div class="form-group">
                    <label for="jam" class="form-label">
                        <i class="far fa-clock" style="margin-right:8px;"></i> Jam Kedatangan
                    </label>
                    <input type="text" name="jam" id="jam"
                        class="form-control timepicker"
                        placeholder="Pilih Jam..."
                        value="<?= old('jam') ?>"
                        required>
                </div>

                <button type="submit" class="btn-next">
                    Lanjut ke Langkah Berikutnya <i class="fas fa-arrow-right"></i>
                </button>
            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Konfigurasi Tanggal
        flatpickr("#tanggal", {
            locale: "id",
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "l, j F Y",
            minDate: "today",
            disableMobile: "true",
            animate: true,
            defaultDate: "<?= old('tanggal') ?>" // Mengisi ulang jika ada old data
        });

        // Konfigurasi Jam
        flatpickr("#jam", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            minTime: "10:00",
            maxTime: "21:00",
            disableMobile: "true",
            defaultDate: "<?= old('jam') ?>" // Mengisi ulang jika ada old data
        });
    });
</script>

<?= $this->endSection(); ?>