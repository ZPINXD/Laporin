<?php
include_once("database.php");
session_start();

// Periksa apakah user sudah login
if (!isset($_SESSION['id_user'])) {
    // Jika belum login, alihkan ke halaman login dengan pesan error
    header("Location: login.php?error=belum_login");
    exit();
}

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $id_user = $_SESSION['id_user']; 
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = $_POST['tanggal'];
    $lokasi = $_POST['lokasi'];
    $instansi = $_POST['instansi'];
    $kategori = $_POST['kategori'];
    $privasi = $_POST['privasi'] ?? 'publik'; 

    $sql = "INSERT INTO laporan (id_user, judul, isi, tanggal, lokasi, instansi, kategori, privasi, status) 
            VALUES ('$id_user', '$judul', '$isi', '$tanggal', '$lokasi', '$instansi', '$kategori', '$privasi', 'Pending')";

    if ($conn->query($sql) === TRUE) {
        header("Location: Lapor.php");
        exit();
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }
}

$conn->close();
?>
