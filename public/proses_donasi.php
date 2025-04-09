<?php
session_start();
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = isset($_SESSION["username"]) ? $_SESSION["username"] : '';
    $jumlah = $_POST['jumlah'];
    $pesan = $_POST['pesan'];
    $tanggal = date("Y-m-d H:i:s");

    $query = "INSERT INTO donasi (nama, email, jumlah, pesan, tanggal) VALUES ('$nama', '$email', '$jumlah', '$pesan', '$tanggal')";

    if (mysqli_query($conn, $query)) {
        header("Location: halaman_donasi.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
