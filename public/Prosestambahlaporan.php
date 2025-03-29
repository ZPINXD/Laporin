<?php
include_once("database.php");
session_start();

// Periksa apakah user sudah login
if (!isset($_SESSION['id_user'])) {
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

    // Proses upload file
    if (isset($_FILES['lampiran']) && $_FILES['lampiran']['error'] === UPLOAD_ERR_OK) {
        $lampiran = file_get_contents($_FILES['lampiran']['tmp_name']); // Baca file
    } else {
        $lampiran = null;
    }

    // Gunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("INSERT INTO laporan (id_user, judul, isi, tanggal, lokasi, instansi, kategori,lampiran, privasi, status) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?,?, 'Pending')");

    $stmt->bind_param("issssssss", $id_user, $judul, $isi, $tanggal, $lokasi, $instansi, $kategori, $lampiran, $privasi,);

    if ($stmt->execute()) {
        header("Location: Lapor.php");
        exit();
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
