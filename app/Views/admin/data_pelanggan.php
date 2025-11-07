<h2>Daftar Pelanggan</h2>

<table border="1" cellpadding="5">
  <tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Email</th>
  </tr>
  <?php if (!empty($pelanggan)): ?>
    <?php foreach ($pelanggan as $p): ?>
      <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['username'] ?></td>
        <td><?= $p['email'] ?></td>
      </tr>
    <?php endforeach; ?>
  <?php else: ?>
    <tr><td colspan="3">Belum ada pelanggan.</td></tr>
  <?php endif; ?>
</table>
