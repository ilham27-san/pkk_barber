<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="admin-container">
    <h2>Form Tambah Capster Baru</h2>

    <?php $validation = \Config\Services::validation(); ?>
    
    <?php if ($validation->getErrors()) : ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('admin/capster/save'); ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        
        <div class="form-group">
            <label for="nama">Nama Capster:</label>
            <input type="text" id="nama" name="nama" class="form-control" value="<?= old('nama'); ?>" required>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                <option value="Pria" <?= (old('jenis_kelamin') == 'Pria') ? 'selected' : ''; ?>>Pria</option>
                <option value="Wanita" <?= (old('jenis_kelamin') == 'Wanita') ? 'selected' : ''; ?>>Wanita</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="spesialisasi">Spesialisasi:</label>
            <input type="text" id="spesialisasi" name="spesialisasi" class="form-control" value="<?= old('spesialisasi'); ?>">
        </div>
        
        <div class="form-group">
            <label for="deskripsi">Deskripsi/Biografi:</label>
            <textarea id="deskripsi" name="deskripsi" class="form-control"><?= old('deskripsi'); ?></textarea>
        </div>

        <div class="form-group">
            <label for="foto">Foto Capster (JPG/PNG, Max 2MB):</label>
            <input type="file" id="foto" name="foto" class="form-control-file" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan Capster</button>
        <a href="<?= base_url('admin/capster'); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?= $this->endSection() ?>