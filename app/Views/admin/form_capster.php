<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="admin-wrapper">
    <div class="admin-container">
        <div class="form-header">
            <h2 class="form-title">Tambah Capster Baru</h2>
            <p class="form-subtitle">Masukkan data lengkap untuk mendaftarkan stylist baru.</p>
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

        <form action="<?= base_url('admin/capster/save'); ?>" method="POST" enctype="multipart/form-data" class="admin-form">
            <?= csrf_field() ?>

            <div class="form-grid">
                <div class="form-left">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" class="form-control" value="<?= old('nama'); ?>" placeholder="Masukkan nama stylist" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <div class="select-wrapper">
                            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                                <option value="" disabled selected>-- Pilih Gender --</option>
                                <option value="Pria" <?= (old('jenis_kelamin') == 'Pria') ? 'selected' : ''; ?>>Pria</option>
                                <option value="Wanita" <?= (old('jenis_kelamin') == 'Wanita') ? 'selected' : ''; ?>>Wanita</option>
                            </select>
                            <i class="fas fa-chevron-down select-arrow"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="spesialisasi">Spesialisasi</label>
                        <input type="text" id="spesialisasi" name="spesialisasi" class="form-control" value="<?= old('spesialisasi'); ?>" placeholder="Contoh: Hair Cut, Coloring, Massage">
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi / Biografi</label>
                        <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" placeholder="Tuliskan pengalaman atau keahlian stylist ini..."><?= old('deskripsi'); ?></textarea>
                    </div>
                </div>

                <div class="form-right">
                    <div class="form-group photo-upload-section">
                        <label>Foto Profil</label>

                        <div class="current-photo-wrapper">
                            <img id="img-preview" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1%20%7Bfill%3A%23E9ECEF%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A10pt%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23E9ECEF%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274%22%20y%3D%22104%22%3EPreview%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Preview Foto" class="img-preview">
                            <div class="photo-overlay">
                                <i class="fas fa-camera"></i>
                            </div>
                        </div>

                        <div class="file-input-wrapper">
                            <input type="file" id="foto" name="foto" class="input-file" onchange="previewImage(this)" required>
                            <label for="foto" class="btn-upload">
                                <i class="fas fa-upload"></i> Pilih Foto
                            </label>
                            <small class="text-muted">Wajib diisi. Maksimal 2MB (JPG/PNG).</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="<?= base_url('admin/capster'); ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* --- CSS INI SAMA DENGAN HALAMAN EDIT AGAR KONSISTEN --- */

    /* Variables */
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

    .admin-wrapper {
        font-family: 'Poppins', sans-serif;
        background-color: var(--bg-color);
        padding: 40px 20px;
        min-height: 85vh;
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }

    .admin-container {
        background: var(--card-bg);
        width: 100%;
        max-width: 900px;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
        padding: 40px;
        border: 1px solid rgba(0, 0, 0, 0.02);
    }

    .form-header {
        margin-bottom: 30px;
        border-bottom: 2px solid var(--bg-color);
        padding-bottom: 20px;
    }

    .form-title {
        color: var(--primary-dark);
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0 0 5px 0;
    }

    .form-subtitle {
        color: #888;
        font-size: 0.9rem;
        margin: 0;
    }

    /* Alert Style */
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

    /* Layout Grid */
    .form-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
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

    /* Input Fields */
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
    }

    .form-control:focus {
        border-color: var(--primary-gold);
        outline: none;
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.15);
        background-color: #fff;
    }

    /* Select Arrow */
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

    /* Photo Upload */
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
        overflow: hidden;
        border: 4px solid #fff;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        background: #E9ECEF;
    }

    .img-preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

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

    /* Buttons */
    .form-actions {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: flex-end;
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
        text-decoration: none;
        transition: transform 0.2s, box-shadow 0.2s;
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
        color: var(--primary-gold);
        box-shadow: 0 4px 15px rgba(62, 39, 35, 0.2);
    }

    .btn-success:hover {
        background-color: #2D1B18;
        transform: translateY(-2px);
    }

    /* Mobile */
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .form-right {
            order: -1;
            margin-bottom: 20px;
        }

        .admin-container {
            padding: 25px;
        }

        .form-actions {
            flex-direction: column-reverse;
            gap: 10px;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<script>
    // Script untuk preview gambar secara live
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