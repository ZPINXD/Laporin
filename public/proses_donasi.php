<?php
session_start();
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_laporan = $_POST['id_laporan']; // Ambil id laporan
    $nama = $_POST['nama'];
    $email = isset($_SESSION["username"]) ? $_SESSION["email"] : '';
    $jumlah = $_POST['jumlah'];
    $pesan = $_POST['pesan'];
    $tanggal = date("Y-m-d H:i:s");

    // Tambahkan id_laporan ke query INSERT
    $query = "INSERT INTO donasi (id_laporan, nama, email, jumlah, pesan, tanggal) 
              VALUES ('$id_laporan', '$nama', '$email', '$jumlah', '$pesan', '$tanggal')";

    if (mysqli_query($conn, $query)) {
        header("Location: halaman_donasi.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
