<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    /* VARIABLES */
    :root {
        --primary-brown: #3e2b26;
        --secondary-brown: #5d4037;
        --accent-gold: #cba155;
        --bg-light: #fdfaf7;
        --card-bg: #ffffff;
        --text-dark: #333;
        --text-muted: #777;
        --danger: #c62828;
        --warning: #f57c00;
    }

    body {
        background-color: var(--bg-light);
        font-family: 'Montserrat', sans-serif;
    }

    /* CONTAINER */
    .admin-wrapper {
        padding: 50px 20px;
        min-height: 90vh;
        max-width: 1000px;
        margin: 0 auto;
    }

    /* HEADER */
    .page-header {
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 2px dashed #e0d0c0;
    }

    .page-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: #ffffff;
        margin: 0;
        font-weight: 700;
    }

    .page-subtitle {
        color: #ffffff;
        font-size: 1rem;
        margin-top: 5px;
    }

    /* ALERT */
    .alert-modern {
        background: #e8f5e9;
        color: #2e7d32;
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 15px;
        border-left: 5px solid #2e7d32;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    /* --- FORM UPLOAD (Tetap Sama/Modern) --- */
    .upload-card {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 30px;
        margin-bottom: 50px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 0, 0, 0.02);
    }

    .form-title {
        font-size: 1.5rem;
        color: var(--primary-brown);
        font-family: 'Playfair Display', serif;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--text-dark);
        font-size: 0.9rem;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        font-family: inherit;
        font-size: 0.95rem;
        transition: border-color 0.3s;
        background-color: #fdfdfd;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--accent-gold);
    }

    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }

    .file-input-wrapper input[type=file] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        cursor: pointer;
    }

    .file-input-btn {
        background: #f0f0f0;
        color: #555;
        padding: 12px;
        border-radius: 10px;
        border: 1px dashed #ccc;
        text-align: center;
        display: block;
        cursor: pointer;
        transition: all 0.3s;
    }

    .file-input-wrapper:hover .file-input-btn {
        background: #e9e9e9;
        border-color: var(--primary-brown);
    }

    .btn-submit {
        background-color: var(--primary-brown);
        color: #fff;
        padding: 14px;
        border-radius: 10px;
        border: none;
        width: 100%;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 1rem;
        margin-top: 10px;
        box-shadow: 0 5px 15px rgba(62, 43, 38, 0.2);
    }

    .btn-submit:hover {
        background-color: var(--secondary-brown);
        transform: translateY(-2px);
    }

    /* --- GALLERY LIST LAYOUT (UBAHAN UTAMA) --- */
    .gallery-list {
        display: flex;
        flex-direction: column;
        /* Menyusun ke bawah */
        gap: 25px;
        /* Jarak antar item */
    }

    .gallery-item {
        display: flex;
        /* Layout Horizontal (Gambar di kiri, Teks di kanan) */
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
        border: 1px solid #f0f0f0;
        transition: transform 0.3s, box-shadow 0.3s;
        height: 280px;
        /* Tinggi kartu fix agar rapi */
    }

    .gallery-item:hover {
        transform: translateX(5px);
        /* Efek geser kanan sedikit saat hover */
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        border-color: rgba(203, 161, 85, 0.3);
    }

    /* AREA GAMBAR (PORTRAIT) */
    .gallery-img-box {
        width: 220px;
        /* Lebar fix */
        height: 100%;
        /* Tinggi mengikuti kartu */
        flex-shrink: 0;
        /* Agar tidak tergencet */
        position: relative;
        overflow: hidden;
        background-color: #f0f0f0;
    }

    .gallery-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Memenuhi area portrait */
        transition: transform 0.5s ease;
    }

    .gallery-item:hover .gallery-img-box img {
        transform: scale(1.05);
    }

    /* AREA KONTEN (KANAN) */
    .gallery-content {
        padding: 25px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        /* Konten di tengah secara vertikal */
    }

    .item-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        color: var(--primary-brown);
        font-weight: 700;
        margin: 0 0 10px 0;
    }

    .item-desc {
        color: var(--text-muted);
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 20px;
        flex-grow: 1;
        /* Mendorong tombol ke bawah jika teks sedikit */
        /* Batasi baris teks */
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .item-actions {
        display: flex;
        gap: 10px;
        padding-top: 15px;
        border-top: 1px dashed #eee;
    }

    /* BUTTONS */
    .btn-action {
        padding: 8px 16px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .btn-edit {
        background: #fff3e0;
        color: var(--warning);
    }

    .btn-edit:hover {
        background: #ffe0b2;
    }

    .btn-delete {
        background: #ffebee;
        color: var(--danger);
    }

    .btn-delete:hover {
        background: #ffcdd2;
    }

    /* EMPTY STATE */
    .empty-state {
        text-align: center;
        padding: 60px;
        color: #aaa;
        width: 100%;
    }

    /* RESPONSIVE (Mobile) */
    @media (max-width: 768px) {
        .gallery-item {
            flex-direction: column;
            /* Balik jadi vertikal di HP */
            height: auto;
        }

        .gallery-img-box {
            width: 100%;
            height: 300px;
            /* Tinggi gambar di HP */
        }

        .gallery-content {
            padding: 20px;
        }
    }
</style>

<div class="admin-wrapper">

    <div class="page-header">
        <h2 class="page-title">Kelola Gallery</h2>
        <p class="page-subtitle">Pamerkan hasil karya potongan rambut terbaik kepada pelanggan.</p>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert-modern">
            <i class="fas fa-check-circle fa-lg"></i>
            <span><?= session()->getFlashdata('success'); ?></span>
        </div>
    <?php endif; ?>

    <div class="upload-card">
        <h3 class="form-title"><i class="fas fa-camera"></i> Upload Foto Baru</h3>

        <form action="<?= base_url('admin/gallery/simpan') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <div class="form-group">
                <label class="form-label">Judul Foto</label>
                <input type="text" name="judul" class="form-control" placeholder="Misal: Burst Fade Modern" required>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi Singkat</label>
                <textarea name="deskripsi" class="form-control" placeholder="Jelaskan detail potongan..." rows="2" required></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Pilih Gambar</label>
                <div class="file-input-wrapper">
                    <div class="file-input-btn">
                        <i class="fas fa-cloud-upload-alt"></i> Klik untuk memilih file (JPG, PNG - Max 2MB)
                    </div>
                    <input type="file" name="gambar" accept="image/*" required onchange="this.previousElementSibling.innerText = this.files[0].name">
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-upload"></i> Upload ke Gallery
            </button>
        </form>
    </div>

    <div style="margin-bottom: 20px; font-weight: 700; color: #ffffff;; font-size: 1.2rem;">
        Daftar Foto Saat Ini
    </div>

    <div class="gallery-list">

        <?php if (!empty($gallery)) : ?>
            <?php foreach ($gallery as $g) : ?>
                <div class="gallery-item">

                    <div class="gallery-img-box">
                        <img src="<?= base_url('img/gallery/' . $g['gambar']) ?>" alt="<?= esc($g['judul']); ?>">
                    </div>

                    <div class="gallery-content">
                        <h4 class="item-title"><?= esc($g['judul']); ?></h4>
                        <p class="item-desc"><?= esc($g['deskripsi']); ?></p>

                        <div class="item-actions">
                            <a href="<?= base_url('admin/gallery/edit/' . $g['id']) ?>" class="btn-action btn-edit">
                                <i class="fas fa-pencil-alt"></i> Edit
                            </a>

                            <form action="<?= base_url('admin/gallery/delete/' . $g['id']) ?>" method="post" style="display:inline;">
                                <?= csrf_field(); ?>
                                <button type="submit" class="btn-action btn-delete" onclick="return confirm('Hapus foto ini dari gallery?')">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <div class="empty-state">
                <i class="far fa-images fa-4x" style="opacity:0.2; margin-bottom:20px;"></i>
                <h3>Gallery Kosong</h3>
                <p>Belum ada foto yang diunggah.</p>
            </div>
        <?php endif; ?>

    </div>

</div>

<?= $this->endSection(); ?>