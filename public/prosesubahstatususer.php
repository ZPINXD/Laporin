<?php
include_once("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Loop untuk memproses setiap perubahan status
    foreach ($_POST['status'] as $id_user => $status) {
        $id_user = mysqli_real_escape_string($conn, $id_user);
        $status = mysqli_real_escape_string($conn, $status);

        // Query untuk memperbarui status
        $query = "UPDATE user SET status_user = '$status' WHERE id_user = '$id_user'";
        mysqli_query($conn, $query);
    }

    // Redirect kembali ke halaman daftar instansi dengan pesan sukses
    header("Location: profiluser.php?status=success");
    exit();
} else {
    // Jika akses langsung tanpa metode POST, kembalikan ke halaman utama
    header("Location: profiluser.php");
    exit();
}
?>
