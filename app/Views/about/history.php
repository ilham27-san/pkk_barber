<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <section class="history-section">
        
        <h2 class="history-title-main">Perjalanan BarberNow</h2>
        <p class="history-subtitle">
            Sebuah dedikasi untuk mendefinisikan ulang gaya rambut pria. Inilah tonggak sejarah singkat kami sejak berdiri.
        </p>

        <div class="history-grid">

            <div class="history-card">
                <div class="history-year-badge">2024</div>
                <div class="history-content">
                    <div class="history-icon-wrapper">
                        <i class="fas fa-lightbulb history-icon"></i>
                    </div>
                    <h3>Lahirnya Konsep</h3>
                    <p>
                        Berawal dari visi untuk menciptakan barbershop yang menggabungkan kenyamanan modern dengan kualitas potongan klasik yang tak lekang oleh waktu di kota ini.
                    </p>
                </div>
            </div>

            <div class="history-card">
                <div class="history-year-badge">2024</div>
                <div class="history-content">
                    <div class="history-icon-wrapper">
                        <i class="fas fa-door-open history-icon"></i>
                    </div>
                    <h3>Grand Opening</h3>
                    <p>
                        Pintu BarberNow resmi dibuka. Kami menyambut pelanggan dengan layanan "Premium Cut" dan tim kapster handal yang siap memberikan pengalaman terbaik.
                    </p>
                </div>
            </div>

            <div class="history-card">
                <div class="history-year-badge">2024</div>
                <div class="history-content">
                    <div class="history-icon-wrapper">
                        <i class="fas fa-laptop history-icon"></i>
                    </div>
                    <h3>Inovasi Digital</h3>
                    <p>
                        Peluncuran website dan sistem booking online untuk memudahkan pelanggan mengatur jadwal. Kami bertransformasi menjadi barbershop yang lebih mudah diakses.
                    </p>
                </div>
            </div>

            <div class="history-card">
                <div class="history-year-badge">2025</div>
                <div class="history-content">
                    <div class="history-icon-wrapper">
                        <i class="fas fa-rocket history-icon"></i>
                    </div>
                    <h3>Menatap Masa Depan</h3>
                    <p>
                        Fokus kami adalah terus meningkatkan kualitas, menambah lini produk perawatan, dan menjadi destinasi grooming pria utama pilihan Anda.
                    </p>
                </div>
            </div>

        </div>
    </section>
</div>

<?= $this->endSection(); ?>