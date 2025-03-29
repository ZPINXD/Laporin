<?php
session_start(); // Pastikan session dimulai sebelum digunakan
include_once("database.php"); // Pastikan nama file koneksi benar

// Pastikan semua data tersedia
if (isset($_SESSION['id_user']) && isset($_POST['nama']) && isset($_POST['tempat']) && isset($_POST['jenis_kelamin']) && isset($_POST['no']) && isset($_POST['email'])) {
    
    $id_user = $_SESSION['id_user']; 
    $username = $_POST['nama'];
    $alamat = $_POST['tempat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_telp = $_POST['no'];
    $email = $_POST['email'];
    
    $id_user = mysqli_real_escape_string($conn, $id_user);
    $username = mysqli_real_escape_string($conn, $username);
    $alamat = mysqli_real_escape_string($conn, $alamat);
    $jenis_kelamin = mysqli_real_escape_string($conn, $jenis_kelamin);
    $no_telp = mysqli_real_escape_string($conn, $no_telp);
    $email = mysqli_real_escape_string($conn, $email);

    // Query untuk update data user
    $query = "UPDATE user SET 
                username='$username', 
                alamat='$alamat', 
                jenis_kelamin='$jenis_kelamin', 
                no_telp='$no_telp', 
                email='$email' 
              WHERE id_user='$id_user'";

    $hasil = mysqli_query($conn, $query);

    if ($hasil) {
        header('location: ubahprofil.php'); // Redirect ke halaman profil setelah update berhasil
        exit();
    } else {
        echo "Update data gagal: " . mysqli_error($conn);
    }
} else {
    echo "Error: Data tidak lengkap.";
}
?>
