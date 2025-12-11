<?php
// Asumsikan koneksi database Anda sudah di-include
// include '../koneksi.php'; 

if (isset($_POST['simpan'])) {
    
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $spesialisasi = $_POST['spesialisasi'];
    $deskripsi = $_POST['deskripsi'];
    
    // --- PENANGANAN UPLOAD FOTO ---
    $nama_file = $_FILES['foto']['name'];
    $ukuran_file = $_FILES['foto']['size'];
    $tmp_file = $_FILES['foto']['tmp_name'];
    
    // Tentukan folder tempat foto akan disimpan
    // Pastikan folder 'assets/img/capster/' sudah ada di root project Anda
    $folder = "../assets/img/capster/"; 
    
    // Ambil ekstensi file
    $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
    $ext_diizinkan = array('jpg', 'jpeg', 'png');
    
    // Buat nama file baru yang unik untuk menghindari tabrakan nama
    $nama_file_baru = uniqid() . '.' . $ext;

    // Cek apakah ekstensi diizinkan
    if (in_array($ext, $ext_diizinkan) === true) {
        // Cek ukuran file (contoh: maksimal 2MB)
        if ($ukuran_file <= 2000000) { 
            
            // Proses upload file
            if (move_uploaded_file($tmp_file, $folder . $nama_file_baru)) {
                
                // Proses penyimpanan ke database
                $query_insert = "INSERT INTO capster (nama, jenis_kelamin, spesialisasi, deskripsi, foto) 
                                 VALUES ('$nama', '$jenis_kelamin', '$spesialisasi', '$deskripsi', '$nama_file_baru')";
                
                if (mysqli_query($koneksi, $query_insert)) {
                    // Redirect kembali ke halaman daftar Capster jika berhasil
                    header("location: data_capster.php?pesan=tambah_sukses");
                    exit();
                } else {
                    echo "Gagal menyimpan data ke database: " . mysqli_error($koneksi);
                }

            } else {
                echo "Gagal mengupload file.";
            }
            
        } else {
            echo "Ukuran file terlalu besar. Maksimal 2MB.";
        }
    } else {
        echo "Ekstensi file tidak diizinkan. Hanya boleh JPG, JPEG, atau PNG.";
    }
}
?>