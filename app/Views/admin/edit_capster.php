<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="admin-container">
    <h2>Form Edit Capster: <?= $capster['nama']; ?></h2>

    <?php $validation = \Config\Services::validation(); ?>
    <?php if ($validation->getErrors()) : ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('admin/capster/' . $capster['id_capster']); ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        
        <input type="hidden" name="foto_lama" value="<?= $capster['foto']; ?>">
        
        <div class="form-group">
            <label for="nama">Nama Capster:</label>
            <input type="text" id="nama" name="nama" class="form-control" value="<?= old('nama') ?: $capster['nama']; ?>" required>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <?php $jk = old('jenis_kelamin') ?: $capster['jenis_kelamin']; ?>
            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                <option value="Pria" <?= ($jk == 'Pria') ? 'selected' : ''; ?>>Pria</option>
                <option value="Wanita" <?= ($jk == 'Wanita') ? 'selected' : ''; ?>>Wanita</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="spesialisasi">Spesialisasi:</label>
            <input type="text" id="spesialisasi" name="spesialisasi" class="form-control" value="<?= old('spesialisasi') ?: $capster['spesialisasi']; ?>">
        </div>
        
        <div class="form-group">
            <label for="deskripsi">Deskripsi/Biografi:</label>
            <textarea id="deskripsi" name="deskripsi" class="form-control"><?= old('deskripsi') ?: $capster['deskripsi']; ?></textarea>
        </div>

        <div class="form-group">
            <label>Foto Saat Ini:</label><br>
            <img src="<?= base_url('assets/img/capster/' . $capster['foto']); ?>" width="150" class="img-thumbnail"><br>
        </div>

        <div class="form-group">
            <label for="foto">Ubah Foto Capster (Opsional, Max 2MB):</label>
            <input type="file" id="foto" name="foto" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-success">Update Capster</button>
        <a href="<?= base_url('admin/capster'); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?= $this->endSection() ?>