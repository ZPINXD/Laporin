<?php
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminId = mysqli_real_escape_string($conn, $_POST["id_admin"]);
    $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
    $email = strtolower(mysqli_real_escape_string($conn, $_POST["email"])); 
    $currentPassword = $_POST["current_password"]; 
    $newPassword = $_POST["password"]; 

    $queryGetPassword = "SELECT password FROM admin WHERE id_admin='$adminId'";
    $result = mysqli_query($conn, $queryGetPassword);
    $adminData = mysqli_fetch_assoc($result);
    
    if (!$adminData) {
        echo "<script>alert('Admin tidak ditemukan!'); window.history.back();</script>";
        exit();
    }

    $storedPassword = $adminData["password"]; 

    
    if (!empty($newPassword)) {
        if (hash('sha256', $currentPassword) !== $storedPassword) {
            echo "<script>alert('Password lama salah!'); window.history.back();</script>";
            exit();
        }

       
        $hashedPassword = hash('sha256', $newPassword);
        $query = "UPDATE admin SET nama='$nama', email='$email', password='$hashedPassword' WHERE id_admin='$adminId'";
    } else {
        // Jika tidak mengganti password, update hanya nama dan email
        $query = "UPDATE admin SET nama='$nama', email='$email' WHERE id_admin='$adminId'";
    }

    $hasil = mysqli_query($conn, $query);

    if ($hasil) {
        $_SESSION["nama"] = $nama_baru;
        header("Location: profiladmin.php");
        exit();
    } else {
        echo "<script>alert('Gagal memperbarui data: " . mysqli_error($conn) . "'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Akses tidak valid!'); window.history.back();</script>";
}
?>
