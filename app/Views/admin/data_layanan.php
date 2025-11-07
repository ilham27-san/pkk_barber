<h2>Kelola Layanan</h2>

<a href="<?= base_url('admin/layanan/create') ?>">Tambah Layanan</a>

<table border="1" cellpadding="5">
  <tr>
    <th>ID</th>
    <th>Nama Layanan</th>
    <th>Harga</th>
    <th>Deskripsi</th>
    <th>Aksi</th>
  </tr>
  <?php if (!empty($layanan)): ?>
    <?php foreach ($layanan as $row): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['nama_layanan'] ?></td>
        <td><?= $row['harga'] ?></td>
        <td><?= $row['deskripsi'] ?></td>
        <td>
          <a href="<?= base_url('admin/layanan/edit/' . $row['id']) ?>">Edit</a> |
          <a href="<?= base_url('admin/layanan/delete/' . $row['id']) ?>" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>
  <?php else: ?>
    <tr><td colspan="5">Belum ada layanan.</td></tr>
  <?php endif; ?>
</table>
