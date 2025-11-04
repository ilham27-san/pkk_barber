<?php
// generate_hash.php
// Jalankan file ini hanya untuk membuat hash password admin

$plainPassword = 'admin123';
$hashed = password_hash($plainPassword, PASSWORD_BCRYPT);

echo "<h3>Password asli:</h3> $plainPassword";
echo "<h3>Hasil hash (gunakan di database):</h3> <textarea cols='100' rows='3'>$hashed</textarea>";
