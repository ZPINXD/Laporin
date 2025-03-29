<?php
session_start();
include_once("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass_new = $_POST['pass_new'];
    $pass_conf = $_POST['pass_conf'];

    // Cek apakah email terdaftar di database
    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Cek apakah password dan konfirmasi cocok
        if ($pass_new === $pass_conf) {
            // Enkripsi password dengan SHA-256
            $hash_password = hash("sha256", $pass_new);

            // Update password di database
            $update_query = "UPDATE user SET password='$hash_password' WHERE email='$email'";
            if (mysqli_query($conn, $update_query)) {
                $_SESSION['login_message'] = "Password baru telah berhasil diperbarui, silakan coba login kembali!";
            } else {
                $_SESSION['login_message'] = "Terjadi kesalahan saat memperbarui password!";
            }
        } else {
            $_SESSION['login_message'] = "Password baru dan konfirmasi password tidak cocok!";
        }
    } else {
        $_SESSION['login_message'] = "Email tidak ditemukan!";
    }

    // Redirect kembali ke login.php dengan pesan
    header("location: login.php");
    exit();
}
?>
