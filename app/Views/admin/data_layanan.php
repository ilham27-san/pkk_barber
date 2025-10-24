<h2>Daftar Layanan</h2>
<a href="/admin/layanan/create">+ Tambah Layanan</a>
<table>
  <thead><tr><th>ID</th><th>Nama</th><th>Harga</th><th>Aksi</th></tr></thead>
  <tbody>
    <?php foreach($layanan as $l): ?>
      <tr>
        <td><?= $l['id'] ?></td>
        <td><?= esc($l['nama_layanan']) ?></td>
        <td><?= number_format($l['harga']) ?></td>
        <td>
          <a href="/admin/layanan/edit/<?= $l['id'] ?>">Edit</a> |
          <a href="/admin/layanan/delete/<?= $l['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
