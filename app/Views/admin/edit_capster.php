<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="admin-wrapper">
    <div class="admin-container">
        <div class="form-header">
            <h2 class="form-title">Edit Capster</h2>
            <p class="form-subtitle">Perbarui informasi profil stylist: <strong><?= esc($capster['nama']); ?></strong></p>
        </div>

        <?php $validation = \Config\Services::validation(); ?>
        <?php if ($validation->getErrors()) : ?>
            <div class="alert alert-danger">
                <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                <div class="alert-content">
                    <?= $validation->listErrors() ?>
                </div>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('admin/capster/' . $capster['id_capster']); ?>" method="POST" enctype="multipart/form-data" class="admin-form">
            <?= csrf_field() ?>

            <input type="hidden" name="foto_lama" value="<?= $capster['foto']; ?>">

            <div class="form-grid">
                <div class="form-left">
                    <div class="form-group">
                        <label for="nama">Nama Capster</label>
                        <input type="text" id="nama" name="nama" class="form-control" value="<?= old('nama') ?: $capster['nama']; ?>" placeholder="Masukkan nama lengkap" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <?php $jk = old('jenis_kelamin') ?: $capster['jenis_kelamin']; ?>
                        <div class="select-wrapper">
                            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                                <option value="Pria" <?= ($jk == 'Pria') ? 'selected' : ''; ?>>Pria</option>
                                <option value="Wanita" <?= ($jk == 'Wanita') ? 'selected' : ''; ?>>Wanita</option>
                            </select>
                            <i class="fas fa-chevron-down select-arrow"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="spesialisasi">Spesialisasi</label>
                        <input type="text" id="spesialisasi" name="spesialisasi" class="form-control" value="<?= old('spesialisasi') ?: $capster['spesialisasi']; ?>" placeholder="Contoh: Hair Cut, Coloring, Creambath">
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi / Biografi</label>
                        <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" placeholder="Tuliskan deskripsi singkat tentang stylist ini..."><?= old('deskripsi') ?: $capster['deskripsi']; ?></textarea>
                    </div>
                </div>

                <div class="form-right">
                    <div class="form-group photo-upload-section">
                        <label>Foto Profil</label>
                        <div class="current-photo-wrapper">
                            <img src="<?= base_url('assets/img/capster/' . $capster['foto']); ?>" alt="Foto Capster" class="img-preview" id="img-preview">
                            <div class="photo-overlay">
                                <i class="fas fa-camera"></i>
                            </div>
                        </div>

                        <div class="file-input-wrapper">
                            <input type="file" id="foto" name="foto" class="input-file" onchange="previewImage(this)">
                            <label for="foto" class="btn-upload">
                                <i class="fas fa-upload"></i> Ubah Foto
                            </label>
                            <small class="text-muted">Maksimal 2MB (JPG/PNG)</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="<?= base_url('admin/capster'); ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* --- VARIABLE & RESET --- */
    :root {
        --primary-dark: #3E2723;
        --primary-gold: #D4AF37;
        --bg-color: #F8F9FA;
        --card-bg: #FFFFFF;
        --border-color: #E0E0E0;
        --text-color: #4A4A4A;
        --danger-color: #e74c3c;
        --input-bg: #FCFCFC;
    }

    /* Pastikan font dimuat (sesuai template Anda) */
    .admin-wrapper {
        font-family: 'Poppins', sans-serif;
        background-color: var(--bg-color);
        padding: 40px 20px;
        min-height: 85vh;
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }

    /* --- CONTAINER --- */
    .admin-container {
        background: var(--card-bg);
        width: 100%;
        max-width: 900px;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
        padding: 40px;
        border: 1px solid rgba(0, 0, 0, 0.02);
    }

    /* --- HEADER --- */
    .form-header {
        margin-bottom: 30px;
        border-bottom: 2px solid var(--bg-color);
        padding-bottom: 20px;
    }

    .form-title {
        color: var(--primary-dark);
        font-family: 'Playfair Display', serif;
        /* Opsional: Mengikuti style booking */
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0 0 5px 0;
    }

    .form-subtitle {
        color: #888;
        font-size: 0.9rem;
        margin: 0;
    }

    /* --- ALERT --- */
    .alert {
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 25px;
        display: flex;
        align-items: flex-start;
        gap: 15px;
        font-size: 0.9rem;
    }

    .alert-danger {
        background-color: #FDEDEC;
        color: var(--danger-color);
        border: 1px solid #FADBD8;
    }

    .alert-content ul {
        margin: 0;
        padding-left: 20px;
    }

    /* --- FORM GRID & LAYOUT --- */
    .form-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        /* Kiri lebih lebar dari kanan */
        gap: 40px;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        color: var(--primary-dark);
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    /* --- INPUT STYLES --- */
    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid var(--border-color);
        background-color: var(--input-bg);
        border-radius: 10px;
        font-size: 0.95rem;
        color: var(--text-color);
        transition: all 0.3s ease;
        box-sizing: border-box;
        /* Penting agar padding tidak merusak lebar */
    }

    .form-control:focus {
        border-color: var(--primary-gold);
        outline: none;
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.15);
        background-color: #fff;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    /* Custom Select Arrow */
    .select-wrapper {
        position: relative;
    }

    .select-wrapper select {
        appearance: none;
        -webkit-appearance: none;
        cursor: pointer;
    }

    .select-arrow {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: #888;
        font-size: 0.8rem;
    }

    /* --- PHOTO UPLOAD SECTION --- */
    .photo-upload-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        background: var(--bg-color);
        padding: 20px;
        border-radius: 12px;
        border: 1px dashed var(--border-color);
    }

    .current-photo-wrapper {
        position: relative;
        width: 160px;
        height: 160px;
        margin-bottom: 15px;
        border-radius: 50%;
        /* Membuat foto jadi bulat */
        overflow: hidden;
        border: 4px solid #fff;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .img-preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* File Input Styling */
    .input-file {
        display: none;
    }

    .btn-upload {
        display: inline-block;
        padding: 8px 16px;
        border: 1px solid var(--primary-dark);
        border-radius: 20px;
        cursor: pointer;
        font-size: 0.85rem;
        color: var(--primary-dark);
        font-weight: 600;
        transition: 0.3s;
        background: transparent;
    }

    .btn-upload:hover {
        background: var(--primary-dark);
        color: #fff;
    }

    .text-muted {
        display: block;
        margin-top: 5px;
        font-size: 0.75rem;
        color: #999;
    }

    /* --- BUTTONS ACTIONS --- */
    .form-actions {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: flex-end;
        /* Tombol rata kanan */
        gap: 15px;
    }

    .btn {
        padding: 12px 25px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.95rem;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: transform 0.2s, box-shadow 0.2s;
        text-decoration: none;
    }

    .btn-secondary {
        background-color: #EFEFEF;
        color: #666;
    }

    .btn-secondary:hover {
        background-color: #E0E0E0;
        color: #333;
    }

    .btn-success {
        background-color: var(--primary-dark);
        /* Menggunakan warna dark brown tema */
        color: var(--primary-gold);
        box-shadow: 0 4px 15px rgba(62, 39, 35, 0.2);
    }

    .btn-success:hover {
        background-color: #2D1B18;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(62, 39, 35, 0.3);
    }

    /* --- RESPONSIVE MOBILE --- */
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
            /* Jadi satu kolom di HP */
            gap: 20px;
        }

        .form-right {
            order: -1;
            /* Foto pindah ke atas di HP */
            margin-bottom: 20px;
        }

        .admin-container {
            padding: 25px;
        }

        .form-actions {
            flex-direction: column-reverse;
            /* Tombol simpan di atas tombol batal */
            gap: 10px;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<script>
    // Script sederhana untuk preview gambar saat dipilih
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('img-preview').src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<?= $this->endSection() ?>