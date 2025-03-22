<?php
// Konfigurasi koneksi database
$host = "192.168.55.217"; // IP server MySQL
$user = "trinity"; // User MySQL
$password = "laporaja"; // Password MySQL
$database = "laporin"; // Nama database
$port = 3306; // Port MySQL (default 3306)

// Membuat koneksi
$conn = mysqli_connect($host, $user, $password, $database, $port);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
} else {
    echo "Koneksi berhasil!";
}
?>
