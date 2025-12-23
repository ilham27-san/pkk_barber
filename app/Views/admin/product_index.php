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
        --success: #2e7d32;
    }

    body { background-color: var(--bg-light); font-family: 'Montserrat', sans-serif; }

    /* CONTAINER */
    .admin-wrapper {
        padding: 50px 20px;
        min-height: 90vh;
        max-width: 1100px;
        margin: 0 auto;
    }

    /* HEADER */
    .page-header {
        margin-bottom: 40px; padding-bottom: 20px;
        border-bottom: 2px dashed #e0d0c0;
    }

    .page-title {
        font-family: 'Playfair Display', serif; font-size: 2.5rem; 
        color: var(--primary-brown); margin: 0; font-weight: 700;
    }

    .page-subtitle { color: var(--text-muted); font-size: 1rem; margin-top: 5px; }

    /* ALERT */
    .alert-modern {
        background: #e8f5e9; color: var(--success); padding: 15px 20px;
        border-radius: 12px; margin-bottom: 30px; display: flex; align-items: center; gap: 15px;
        border-left: 5px solid var(--success); box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    /* --- FORM UPLOAD (MODERN CARD) --- */
    .upload-card {
        background: var(--card-bg); border-radius: 16px;
        padding: 30px; margin-bottom: 50px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.02);
    }

    .form-title {
        font-size: 1.5rem; color: var(--primary-brown); 
        font-family: 'Playfair Display', serif; margin-bottom: 20px;
        display: flex; align-items: center; gap: 10px;
    }

    .form-grid {
        display: grid; grid-template-columns: 1fr 1fr; gap: 20px;
    }

    .form-group { margin-bottom: 20px; }
    
    .form-label {
        display: block; font-weight: 600; margin-bottom: 8px; 
        color: var(--text-dark); font-size: 0.9rem;
    }

    .form-control {
        width: 100%; padding: 12px 15px; border-radius: 10px;
        border: 1px solid #e0e0e0; font-family: inherit; font-size: 0.95rem;
        transition: border-color 0.3s; background-color: #fdfdfd;
    }
    .form-control:focus { outline: none; border-color: var(--accent-gold); }

    .file-input-wrapper {
        position: relative; overflow: hidden; display: inline-block; width: 100%;
    }
    .file-input-wrapper input[type=file] {
        font-size: 100px; position: absolute; left: 0; top: 0; opacity: 0; cursor: pointer;
    }
    .file-input-btn {
        background: #f0f0f0; color: #555; padding: 12px; border-radius: 10px;
        border: 1px dashed #ccc; text-align: center; display: block; cursor: pointer;
        transition: all 0.3s;
    }
    .file-input-wrapper:hover .file-input-btn { background: #e9e9e9; border-color: var(--primary-brown); }

    .btn-submit {
        background-color: var(--primary-brown); color: #fff;
        padding: 14px; border-radius: 10px; border: none; width: 100%;
        font-weight: 700; cursor: pointer; transition: all 0.3s;
        font-size: 1rem; margin-top: 10px;
        box-shadow: 0 5px 15px rgba(62, 43, 38, 0.2);
    }
    .btn-submit:hover { background-color: var(--secondary-brown); transform: translateY(-2px); }

    /* --- PRODUCT LIST (HORIZONTAL LAYOUT) --- */
    .product-list-title {
        margin-bottom: 20px; font-weight: 700; 
        color: var(--primary-brown); font-size: 1.2rem;
    }

    .product-list-container {
        display: flex;
        flex-direction: column; /* Item disusun ke bawah */
        gap: 25px; /* Jarak antar item */
    }

    .product-card-horizontal {
        display: flex; /* Layout Horizontal: Gambar Kiri, Konten Kanan */
        background: #fff; border-radius: 16px; overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.03); border: 1px solid #f0f0f0;
        transition: transform 0.3s, box-shadow 0.3s;
        height: 280px; /* Tinggi kartu fix agar seragam */
    }

    .product-card-horizontal:hover { 
        transform: translateX(5px); /* Efek geser kanan saat hover */
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        border-color: rgba(203, 161, 85, 0.3);
    }

    /* GAMBAR PRODUK (KIRI - PORTRAIT) */
    .img-wrapper-horizontal {
        width: 220px; /* Lebar fix */
        height: 100%; /* Tinggi penuh kartu */
        flex-shrink: 0; /* Agar tidak tergencet */
        position: relative;
        overflow: hidden; background: #f9f9f9;
        border-right: 1px solid #f0f0f0;
    }

    .img-wrapper-horizontal img {
        width: 100%; height: 100%; object-fit: cover; /* Memenuhi area portrait */
        transition: transform 0.5s;
    }
    .product-card-horizontal:hover .img-wrapper-horizontal img { transform: scale(1.05); }

    /* KONTEN (KANAN) */
    .card-body-horizontal { 
        padding: 25px; flex-grow: 1; display: flex; flex-direction: column; 
        justify-content: center; /* Konten di tengah vertikal */
    }

    .card-header-flex {
        display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;
    }

    .card-title {
        font-weight: 700; font-size: 1.3rem; color: var(--primary-brown);
        margin: 0; font-family: 'Playfair Display', serif; line-height: 1.3;
    }

    .card-price {
        font-weight: 700; color: #d35400; font-size: 1.1rem; white-space: nowrap;
        background: #fff3e0; padding: 5px 10px; border-radius: 8px;
    }

    .card-desc { 
        font-size: 0.9rem; color: var(--text-muted); margin-bottom: 20px; 
        flex-grow: 1; line-height: 1.6;
        /* Batasi 3 baris */
        display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
    }

    /* ACTIONS */
    .card-actions {
        display: flex; justify-content: flex-end; gap: 10px; padding-top: 15px; border-top: 1px dashed #eee;
    }

    .btn-action {
        padding: 8px 16px; border-radius: 8px;
        display: inline-flex; align-items: center; gap: 8px;
        border: none; cursor: pointer; transition: all 0.2s;
        text-decoration: none; font-size: 0.9rem; font-weight: 600;
    }

    .btn-edit { background: #fff3e0; color: var(--warning); }
    .btn-edit:hover { background: #ffe0b2; }

    .btn-delete { background: #ffebee; color: var(--danger); }
    .btn-delete:hover { background: #ffcdd2; }

    /* EMPTY STATE */
    .empty-state { text-align: center; padding: 60px; color: #aaa; width: 100%; }

    /* RESPONSIVE (MOBILE) */
    @media (max-width: 768px) {
        .form-grid { grid-template-columns: 1fr; gap: 0; }
        
        .product-card-horizontal {
            flex-direction: column; /* Balik jadi vertikal di HP */
            height: auto;
        }
        .img-wrapper-horizontal {
            width: 100%;
            height: 280px; /* Tinggi gambar di HP */
            border-right: none; border-bottom: 1px solid #f0f0f0;
        }
        .card-body-horizontal { padding: 20px; }
        .card-header-flex { flex-direction: column; gap: 10px; }
        .card-actions { justify-content: flex-start; }
    }
</style>

<div class="admin-wrapper">
    
    <div class="page-header">
        <h2 class="page-title">Kelola Produk</h2>
        <p class="page-subtitle">Atur katalog produk grooming yang dijual di barbershop.</p>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert-modern">
            <i class="fas fa-check-circle fa-lg"></i>
            <span><?= session()->getFlashdata('success'); ?></span>
        </div>
    <?php endif; ?>

    <div class="upload-card">
        <h3 class="form-title"><i class="fas fa-box-open"></i> Tambah Produk Baru</h3>
        
        <form action="<?= base_url('admin/products/simpan') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control" placeholder="Contoh: Pomade Waterbased" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Harga (Rupiah)</label>
                    <input type="number" name="harga" class="form-control" placeholder="Contoh: 150000" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi Produk</label>
                <textarea name="deskripsi" class="form-control" placeholder="Jelaskan keunggulan produk..." rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Foto Produk</label>
                <div class="file-input-wrapper">
                    <div class="file-input-btn">
                        <i class="fas fa-cloud-upload-alt"></i> Klik untuk memilih foto (JPG, PNG)
                    </div>
                    <input type="file" name="gambar" accept="image/*" required onchange="this.previousElementSibling.innerText = this.files[0].name">
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Simpan Produk
            </button>
        </form>
    </div>

    <div class="product-list-title">Daftar Produk Tersedia</div>

    <div class="product-list-container">
        
        <?php if (!empty($products)) : ?>
            <?php foreach ($products as $p) : ?>
                <div class="product-card-horizontal">
                    
                    <div class="img-wrapper-horizontal">
                        <img src="<?= base_url('img/products/' . $p['gambar']) ?>" alt="<?= esc($p['nama_produk']); ?>">
                    </div>

                    <div class="card-body-horizontal">
                        <div class="card-header-flex">
                            <h4 class="card-title"><?= esc($p['nama_produk']); ?></h4>
                            <span class="card-price">Rp <?= number_format($p['harga'], 0, ',', '.'); ?></span>
                        </div>
                        
                        <p class="card-desc"><?= esc($p['deskripsi']); ?></p>
                        
                        <div class="card-actions">
                            <a href="<?= base_url('admin/products/edit/' . $p['id']) ?>" class="btn-action btn-edit">
                                <i class="fas fa-pencil-alt"></i> Edit
                            </a>

                            <form action="<?= base_url('admin/products/delete/' . $p['id']) ?>" method="post" style="display:inline;">
                                <?= csrf_field(); ?>
                                <button type="submit" class="btn-action btn-delete" onclick="return confirm('Hapus produk ini?')">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-box fa-4x" style="opacity:0.2; margin-bottom:20px;"></i>
                <h3>Katalog Kosong</h3>
                <p>Belum ada produk yang ditambahkan.</p>
            </div>
        <?php endif; ?>

    </div>

</div>

<?= $this->endSection(); ?>