<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    .locations-wrapper-font {
        font-family: 'Montserrat', sans-serif;
    }

    /* KOTAK PUTIH LEBAR (CANVAS UTAMA) */
    .location-white-box {
        background-color: #ffffff;
        border-radius: 25px;
        padding: 60px 40px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
        max-width: 1300px; /* Lebar maksimal diperbesar */
        width: 100%;
        margin: 40px auto;
        position: relative;
        border: 1px solid rgba(0,0,0,0.02);
    }

    /* JUDUL HALAMAN */
    h1.page-title {
        text-align: center;
        margin-top: 0; 
        margin-bottom: 60px;
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        color: var(--dark-brown, #5C2C27);
        font-weight: 700;
        letter-spacing: 2px;
    }

    /* LAYOUT 3 KOLOM (KIRI - TENGAH - KANAN) */
    .location-layout {
        display: flex;
        justify-content: space-between;
        align-items: center; /* Vertikal rata tengah */
        gap: 20px;
        position: relative;
    }

    /* === BAGIAN SAMPING (DEKORASI) === */
    .side-content {
        flex: 1; /* Mengambil sisa ruang kiri/kanan */
        text-align: center;
        padding: 20px;
        color: var(--dark-brown);
    }

    .decor-icon {
        font-size: 4rem;
        color: var(--gold-accent, #B89B66);
        margin-bottom: 15px;
        opacity: 0.8;
    }

    .decor-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: var(--dark-brown);
    }

    .decor-text {
        font-size: 0.95rem;
        line-height: 1.8;
        color: #666;
    }

    .decor-list {
        list-style: none;
        padding: 0;
        margin: 0;
        text-align: left;
        display: inline-block;
    }
    .decor-list li {
        margin-bottom: 8px;
        font-size: 0.95rem;
        color: #555;
        border-bottom: 1px dashed #ddd;
        padding-bottom: 5px;
        display: flex;
        justify-content: space-between;
        width: 250px; /* Lebar list jam buka */
    }

    /* === BAGIAN TENGAH (KARTU LOKASI ASLI) === */
    .center-card-wrapper {
        flex: 0 0 380px; /* Lebar tetap untuk kartu agar tidak gepeng */
        display: flex;
        justify-content: center;
        position: relative;
        z-index: 10;
    }

    /* Style Kartu Lokasi (Tidak Diubah, Sesuai Permintaan) */
    .location-card {
        background-color: #1a1a1a;
        color: #ffffff;
        border-radius: 12px;
        width: 100%; 
        min-height: 500px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
        display: flex;
        flex-direction: column;
        position: relative;
        padding-top: 60px; 
        font-family: 'Montserrat', sans-serif;
        transition: transform 0.3s ease;
    }
    .location-card:hover { transform: translateY(-10px); }

    .card-header {
        background-color: #ffc72c;
        color: #1e1e1e;
        padding: 25px 30px;
        text-align: left;
        position: absolute;
        top: -30px; left: 50%; transform: translateX(-50%);
        width: 85%; border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25); z-index: 10;
    }
    .card-header h2 { margin: 0 0 5px 0; font-size: 1.6em; font-weight: 700; font-family: 'Playfair Display', serif; }
    .card-header p { margin: 0; font-size: 0.95em; opacity: 0.9; font-weight: 600; text-transform: uppercase; }

    .card-body { padding: 50px 30px 20px 30px; flex-grow: 1; }
    .card-body p { margin-top: 0; margin-bottom: 25px; font-size: 1em; line-height: 1.6; display: flex; align-items: flex-start; color: #e0e0e0; }
    .card-body p::before { content: '📍'; margin-right: 15px; font-size: 1.4em; }
    
    .map-preview { margin-top: 15px; border-radius: 8px; overflow: hidden; border: 2px solid #333; }
    .map-preview iframe { width: 100%; height: 220px; border: none; display: block; }

    .card-footer { padding: 25px 30px; margin-top: auto; }
    .get-direction-btn {
        background-color: #333; color: #fff; border: 1px solid #444; padding: 14px 20px;
        cursor: pointer; text-align: center; width: 100%; font-size: 1.05em; border-radius: 50px;
        transition: all 0.3s ease; display: flex; align-items: center; justify-content: center;
        text-decoration: none; font-weight: 600;
    }
    .get-direction-btn:hover { background-color: #ffc72c; color: #1e1e1e; border-color: #ffc72c; }
    .get-direction-btn::after { content: '→'; margin-left: 10px; font-size: 1.2em; }

    /* RESPONSIVE (HP) */
    @media (max-width: 992px) {
        .location-layout {
            flex-direction: column; /* Tumpuk ke bawah */
            gap: 60px;
        }
        .center-card-wrapper {
            order: -1; /* Kartu peta tetap paling atas di HP */
            width: 100%;
            max-width: 380px;
        }
        .side-content {
            padding: 0;
        }
    }
</style>

<div class="locations-wrapper-font">
    <div class="container">
        
        <div class="location-white-box">
            
            <h1 class="page-title">STORE LOCATION</h1>

            <div class="location-layout">

                <div class="side-content">
                    <div class="decor-icon"><i class="far fa-clock"></i></div>
                    <h3 class="decor-title">Jam Operasional</h3>
                    <ul class="decor-list">
                        <li><span>Senin - Jumat</span> <strong>10:00 - 21:00</strong></li>
                        <li><span>Sabtu</span> <strong>09:00 - 22:00</strong></li>
                        <li><span>Minggu</span> <strong>10:00 - 20:00</strong></li>
                    </ul>
                    <p class="decor-text" style="margin-top:20px; font-style:italic;">
                        "Datang kapan saja, kami siap membuat Anda tampil beda."
                    </p>
                </div>

                <div class="center-card-wrapper" id="locationsContainer">
                    </div>

                <div class="side-content">
                    <div class="decor-icon"><i class="fas fa-coffee"></i></div>
                    <h3 class="decor-title">Fasilitas & Kontak</h3>
                    <p class="decor-text">
                        Nikmati ruang tunggu ber-AC, Free WiFi, dan kopi gratis sambil menunggu giliran Anda.
                    </p>
                    <div style="margin-top: 20px;">
                        <p class="decor-text" style="font-weight:bold; margin-bottom:5px;">
                            <i class="fab fa-whatsapp" style="color:#25D366;"></i> WhatsApp
                        </p>
                        <p class="decor-text" style="font-size:1.2rem; color:var(--dark-brown);">
                            0859-1065-85275
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
const locationsData = [
        {
            id: 'head-office',
            title: 'Head Office',
            subtitle: 'SANBARBERS',
            address: 'Jl. Widuri 1, Bangetayu Kulon, Kec. Genuk, Kota Semarang, Jawa Tengah',
            
            // 1. URL Embed Map (Untuk tampilan peta kecil di website)
            // (Anda bisa update ini juga dengan cara: Klik Share -> Embed a map -> Copy HTML -> Ambil link src-nya saja)
            mapEmbedUrl: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.203067727394!2d110.46789661477334!3d-6.969655094964999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70f300c0b15dcd%3A0x9e6bb3d59c13e648!2sSAN%20BARBERS!5e0!3m2!1sid!2sid!4v1678901234567!5m2!1sid!2sid', 
            
            // 2. Link "Get Direction" (Untuk tombol agar lari ke Google Maps)
            // [INI YANG SUDAH DIPERBAIKI]
            directionLink: 'https://www.google.com/maps/place/SAN+BARBERS/@-6.9696551,110.4700853,17z/data=!3m1!4b1!4m6!3m5!1s0x2e70f300c0b15dcd:0x9e6bb3d59c13e648!8m2!3d-6.9696551!4d110.4700853!16s%2Fg%2F11h6_6_6_6?entry=ttu' 
        },
    ];

    function createLocationCard(location) {
        const card = document.createElement('div');
        card.className = 'location-card';

        const header = document.createElement('div');
        header.className = 'card-header';
        header.innerHTML = `<h2>${location.title}</h2><p>${location.subtitle}</p>`;
        card.appendChild(header);

        const body = document.createElement('div');
        body.className = 'card-body';
        body.innerHTML = `
            <p>${location.address}</p>
            <div class="map-preview">
                <iframe src="${location.mapEmbedUrl}" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        `;
        card.appendChild(body);

        const footer = document.createElement('div');
        footer.className = 'card-footer';
        footer.innerHTML = `<a href="${location.directionLink}" target="_blank" class="get-direction-btn">Get Direction</a>`;
        card.appendChild(footer);

        return card;
    }

    function renderLocations() {
        const container = document.getElementById('locationsContainer');
        if (container) {
            locationsData.forEach(location => {
                container.appendChild(createLocationCard(location));
            });
        }
    }

    document.addEventListener('DOMContentLoaded', renderLocations);
</script>

<?= $this->endSection(); ?>