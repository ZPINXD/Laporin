<?php
include_once("database.php");
session_start();

// Membuat koneksi

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengecek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $id_user = $_SESSION['id_user'] ?? null; 
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = $_POST['tanggal'];
    $lokasi = $_POST['lokasi'];
    $instansi = $_POST['instansi'];
    $kategori = $_POST['kategori'];
    $privasi = isset($_POST['privacy']) ? $_POST['privasi'] : 'publik'; // Menangani pilihan privasi

    // Menyimpan data ke database
    $sql = "INSERT INTO laporan (id_user, judul, isi, tanggal, lokasi, instansi, kategori, privasi) 
            VALUES ('$id_user','$judul', '$isi', '$tanggal', '$lokasi', '$instansi', '$kategori', '$privasi')";

    if ($conn->query($sql) === TRUE) {
        header("Location: Lapor.php");
            exit();
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }
}

$conn->close();
?>
