<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'laporin_db');

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$judul = $_POST['judul'];
$isi = $_POST['isi'];
$tanggal = date("Y-m-d");
$lokasi = $_POST['lokasi'];
$instansi = $_POST['instansi'];
$kategori = $_POST['kategori'];
$privasi = $_POST['privasi'];

// Insert ke database
$sql = "INSERT INTO laporan (judul, isi, tanggal, lokasi, instansi, kategori, privasi)
        VALUES ('$judul', '$isi', '$tanggal', '$lokasi', '$instansi', '$kategori', '$privasi')";

if ($conn->query($sql) === TRUE) {
    // Redirect ke Lapor.php tanpa parameter
    header("Location: Lapor.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
exit;

$conn->close();
?>
