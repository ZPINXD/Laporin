<?php
include_once("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Loop untuk memproses setiap perubahan status
    foreach ($_POST['status'] as $id_instansi => $status) {
        $id_instansi = mysqli_real_escape_string($conn, $id_instansi);
        $status = mysqli_real_escape_string($conn, $status);

        // Query untuk memperbarui status
        $query = "UPDATE instansi SET status = '$status' WHERE id_instansi = '$id_instansi'";
        mysqli_query($conn, $query);
    }

    // Redirect kembali ke halaman daftar instansi dengan pesan sukses
    header("Location: daftarinstansi.php?status=success");
    exit();
} else {
    // Jika akses langsung tanpa metode POST, kembalikan ke halaman utama
    header("Location: daftarinstansi.php");
    exit();
}
?>
