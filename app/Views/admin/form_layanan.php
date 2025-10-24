<?php $isEdit = isset($layanan); ?>
<h2><?= $isEdit ? 'Edit' : 'Tambah' ?> Layanan</h2>
<form method="post" action="<?= $isEdit ? '/admin/layanan/update/'.$layanan['id'] : '/admin/layanan/store' ?>">
  <label>Nama Layanan</label><br>
  <input type="text" name="nama_layanan" value="<?= $isEdit ? esc($layanan['nama_layanan']) : '' ?>" required><br>
  <label>Harga</label><br>
  <input type="number" name="harga" value="<?= $isEdit ? esc($layanan['harga']) : '' ?>" required><br>
  <label>Deskripsi</label><br>
  <textarea name="deskripsi"><?= $isEdit ? esc($layanan['deskripsi']) : '' ?></textarea><br><br>
  <button type="submit"><?= $isEdit ? 'Update' : 'Simpan' ?></button>
</form>
