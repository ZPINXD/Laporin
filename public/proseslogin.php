<?php
session_start();
include_once("database.php");

$email = $_POST['email'];
$password = $_POST['password'];
$hash_password = hash("sha256", $password);

// Cek di tabel admin terlebih dahulu
$sql_admin = "SELECT * FROM admin WHERE email = '$email' AND password = '$hash_password'";
$result_admin = $conn->query($sql_admin);

if ($result_admin->num_rows > 0) {
    $data = $result_admin->fetch_assoc();
    $_SESSION["email"] = $data["email"];
    $_SESSION["nama"] = $data["nama"];
    $_SESSION["id_admin"] = $data["id_admin"];
    $_SESSION["is_login"] = true;

    header("location: dashboardadmin.php");
    exit;
}

// Jika tidak ditemukan di admin, cek di tabel user
$sql_user = "SELECT * FROM user WHERE email = '$email' AND password = '$hash_password'";
$result_user = $conn->query($sql_user);

if ($result_user->num_rows > 0) {
    $data = $result_user->fetch_assoc();
    
    // Cek apakah status_user adalah "Nonaktif"
    if ($data['status_user'] === "Nonaktif") {
        $_SESSION['login_message'] = "Akun Anda telah dinonaktifkan. Silakan hubungi admin!";
        header("location: login.php");
        exit;
    }

    // Jika status_user aktif, lanjut login
    $_SESSION["email"] = $data["email"];
    $_SESSION["username"] = $data["username"];
    $_SESSION["id_user"] = $data["id_user"];
    $_SESSION["is_login"] = true;

    header("location: Home.php");
    exit;
} else {
    $_SESSION['login_message'] = "Akun tidak ditemukan atau password salah!";
    header("location: login.php");
    exit;
}

$conn->close();
?>
