<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    /* ****************************************************************** */
    /* CSS Styling untuk Tampilan Lebih Lebar */
    /* ****************************************************************** */

    h1 {
        text-align: center;
        margin-top: 20px; 
        margin-bottom: 20px;
    }

    .locations-container-wrapper {
        color: #333;
        padding: 40px 20px;
        display: flex;
        justify-content: center; 
        width: 100%;
    }

    .locations-container {
        display: flex;
        justify-content: center; 
        flex-wrap: wrap; 
        gap: 30px;
        /* Tingkatkan max-width untuk memberi ruang lebih pada kartu yang lebih lebar */
        max-width: 1300px; 
        width: 100%; 
        margin: 0 auto; 
    }

    .location-card {
        background-color: #1a1a1a;
        color: #ffffff;
        border-radius: 8px;
        overflow: visible;
        /* *** PERUBAHAN UTAMA DI SINI *** */
        width: 380px; /* Lebar kartu ditingkatkan dari 320px ke 380px */
        /* ******************************* */
        min-height: 500px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        display: flex;
        flex-direction: column;
        position: relative;
        padding-top: 50px; 
    }

    .card-header {
        background-color: #ffc72c;
        color: #1e1e1e;
        padding: 20px 25px;
        text-align: left;
        
        position: absolute;
        top: -25px;
        left: 50%;
        transform: translateX(-50%);
        width: 90%; 
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        z-index: 10;
    }

    .card-header h2 {
        margin: 0 0 2px 0;
        font-size: 1.7em;
        font-weight: bold;
    }

    .card-header p {
        margin: 0;
        font-size: 1em;
        opacity: 0.9;
    }

    .card-body {
        /* Padding atas disesuaikan agar teks alamat tidak tertutup */
        padding: 35px 25px 20px 25px; 
        flex-grow: 1; 
    }

    .card-body p {
        margin-top: 0; 
        margin-bottom: 20px;
        font-size: 1em; 
        line-height: 1.5;
        display: flex;
        align-items: flex-start;
        color: #ffffff;
    }
    
    .card-body p::before {
        content: '📍'; 
        margin-right: 12px;
        font-size: 1.5em;
        line-height: 1.2;
        color: #ffc72c;
    }

    .map-preview {
        margin-top: 15px;
        border-radius: 4px;
        overflow: hidden;
        border: 1px solid #444;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
    }
    
    .map-preview iframe {
        width: 100%;
        /* Tinggi peta tetap sama, lebarnya mengikuti lebar kartu */
        height: 200px; 
        border: none;
        display: block;
    }

    .card-footer {
        padding: 20px 25px;
        margin-top: auto;
    }

    .get-direction-btn {
        background-color: #333333; 
        color: #ffffff;
        border: 1px solid #444;
        padding: 12px 20px;
        cursor: pointer;
        text-align: center;
        width: 100%;
        font-size: 1.1em;
        border-radius: 6px;
        transition: background-color 0.3s, color 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }
    
    .get-direction-btn:hover {
        background-color: #ffc72c;
        color: #1e1e1e;
        border-color: #ffc72c;
    }
    
    .get-direction-btn::after {
        content: '→'; 
        margin-left: 8px;
        font-size: 1.3em;
    }
    
    @media (max-width: 650px) {
        .location-card {
            width: 90%; /* Tetap responsif di layar kecil */
            padding-top: 60px;
        }
        .card-body {
            padding-top: 40px; 
        }
    }
</style>


<h1>STORE LOCATION</h1>

<div class="locations-container-wrapper">
    <div class="locations-container" id="locationsContainer">
        </div>
</div>

<script>
    // Data Lokasi (tetap sama)
    const locationsData = [
        {
            id: 'head-office',
            title: 'Head Office',
            subtitle: 'SANBARBERS',
            address: 'Jl. Widuri 1, Bangetayu Kulon, Kec. Genuk, Kota Semarang, Jawa Tengah',
            mapEmbedUrl: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2892.4799371266295!2d110.46949489648352!3d-6.969851963119725!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70f300c0b15dcd%3A0x9e6bb3d59c13e648!2sSAN%20BARBERS!5e0!3m2!1sid!2sid!4v1762517582889!5m2!1sid!2sid',
            directionLink: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2892.4799371266295!2d110.46949489648352!3d-6.969851963119725!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70f300c0b15dcd%3A0x9e6bb3d59c13e648!2sSAN%20BARBERS!5e0!3m2!1sid!2sid!4v1762517582889!5m2!1sid!2sid' 
        },
        
    ];

    // Fungsi createLocationCard dan renderLocations (tetap sama)
    function createLocationCard(location) {
        const card = document.createElement('div');
        card.className = 'location-card';

        // Header
        const header = document.createElement('div');
        header.className = 'card-header';
        header.innerHTML = `
            <h2>${location.title}</h2>
            <p>${location.subtitle}</p>
        `;
        card.appendChild(header);

        // Body
        const body = document.createElement('div');
        body.className = 'card-body';
        body.innerHTML = `
            <p>
                ${location.address}
            </p>
            <div class="map-preview">
                <iframe 
                    src="${location.mapEmbedUrl}" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
            </div>
            <a href="${location.directionLink}" target="_blank" class="view-larger-map" style="display: none;">View larger map</a> 
        `;
        card.appendChild(body);

        // Footer
        const footer = document.createElement('div');
        footer.className = 'card-footer';
        footer.innerHTML = `
            <a href="${location.directionLink}" target="_blank" class="get-direction-btn">
                Get Direction
            </a>
        `;
        card.appendChild(footer);

        return card;
    }

    function renderLocations() {
        const container = document.getElementById('locationsContainer');
        if (container) {
            locationsData.forEach(location => {
                const card = createLocationCard(location);
                container.appendChild(card);
            });
        }
    }

    document.addEventListener('DOMContentLoaded', renderLocations);
</script>

<?= $this->endSection(); ?>
