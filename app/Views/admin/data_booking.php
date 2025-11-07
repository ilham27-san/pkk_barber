<h2>Daftar Booking</h2>

<?php if (!empty($bookings) && is_array($bookings)): ?>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nama Pelanggan</th>
            <th>Layanan</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Status</th>
        </tr>
        <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?= esc($booking['id']) ?></td>
                <td><?= esc($booking['nama_pelanggan']) ?></td>
                <td><?= esc($booking['layanan']) ?></td>
                <td><?= esc($booking['tanggal_booking']) ?></td>
                <td><?= esc($booking['jam_booking']) ?></td>
                <td><?= esc($booking['status']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Tidak ada data booking.</p>
<?php endif; ?>
