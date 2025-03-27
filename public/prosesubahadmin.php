<?php
include "database.php";

if (isset($_POST["simpan"])) {
    $adminId = mysqli_real_escape_string($conn, $_POST["id_admin"]);
    $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
    $email = strtolower(mysqli_real_escape_string($conn, $_POST["email"])); // Email jadi lowercase
    $password = $_POST["password"];

    if (!empty($password)) {
        // Gunakan SHA-256 untuk hashing password
        $hashedPassword = hash('sha256', $password);
        $query = "UPDATE admin SET nama='$nama', email='$email', password='$hashedPassword' WHERE id_admin='$adminId'";
    } else {
        $query = "UPDATE admin SET nama='$nama', email='$email' WHERE id_admin='$adminId'";
    }

    $hasil = mysqli_query($conn, $query);

    if ($hasil) {
        header("Location: profiladmin.php");
        exit();
    } else {
        echo "<script>alert('Gagal memperbarui data: " . mysqli_error($conn) . "'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Akses tidak valid!'); window.history.back();</script>";
}
?>
