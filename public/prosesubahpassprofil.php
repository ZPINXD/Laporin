<?php
session_start();
include_once("database.php"); // Pastikan koneksi benar

// Pastikan semua data tersedia
if (isset($_SESSION['id_user']) && isset($_POST['pass_old']) && isset($_POST['pass_new']) && isset($_POST['pass_conf'])) {
    
    $id_user = $_SESSION['id_user']; 
    $pass_old = $_POST['pass_old'];
    $pass_new = $_POST['pass_new'];
    $pass_conf = $_POST['pass_conf'];

    // Ambil password lama dari database
    $query = "SELECT password FROM user WHERE id_user='$id_user'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "User tidak ditemukan!";
        exit();
    }

    // Verifikasi password lama dengan SHA-256
    $hashed_old_input = hash('sha256', $pass_old);
    if ($hashed_old_input !== $row['password']) {
        echo "Password lama salah!";
        exit();
    }

    // Cek apakah password baru dan konfirmasinya sama
    if ($pass_new !== $pass_conf) {
        echo "Konfirmasi password tidak cocok!";
        exit();
    }

    // Hash password baru dengan SHA-256
    $hashed_new_password = hash('sha256', $pass_new);

    // Update password di database
    $query_update = "UPDATE user SET password='$hashed_new_password' WHERE id_user='$id_user'";
    $update_result = mysqli_query($conn, $query_update);

    if ($update_result) {
        header('location: proseslogout.php'); // Redirect setelah update berhasil
        exit();
    } else {
        echo "Gagal mengubah password: " . mysqli_error($conn);
    }
} else {
    echo "Error: Data tidak lengkap.";
}
?>
