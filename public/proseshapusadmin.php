<?php
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["hapus"])) {
    $adminId = mysqli_real_escape_string($conn, $_POST["id_admin"]);
    $password = $_POST["password"];

    // Ambil password admin dari database
    $queryGetPassword = "SELECT password FROM admin WHERE id_admin='$adminId'";
    $result = mysqli_query($conn, $queryGetPassword);
    $adminData = mysqli_fetch_assoc($result);

    if (!$adminData) {
        echo "<script>alert('Admin tidak ditemukan!'); window.history.back();</script>";
        exit();
    }

    $storedPassword = $adminData["password"]; // Password tersimpan (SHA256 hash)

    // Validasi password yang dimasukkan
    if (hash('sha256', $password) !== $storedPassword) {
        echo "<script>alert('Password salah! Admin tidak dapat dihapus.'); window.history.back();</script>";
        exit();
    }

    // Jika password benar, hapus admin
    $queryDelete = "DELETE FROM admin WHERE id_admin='$adminId'";
    $hapus = mysqli_query($conn, $queryDelete);

    if ($hapus) {
        echo "<script>alert('Admin berhasil dihapus.'); window.location.href='profiladmin.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus admin: " . mysqli_error($conn) . "'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Akses tidak valid!'); window.history.back();</script>";
}
?>
