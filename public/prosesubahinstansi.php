<?php
include_once("database.php");

// Pastikan semua data tersedia
if (isset($_POST['id_instansi']) && isset($_POST['nama_instansi']) && isset($_POST['Kontak'])) {
    $id_instansi = $_POST['id_instansi'];
    $nama_instansi = $_POST['nama_instansi'];
    $kontak = $_POST['Kontak']; // Menyesuaikan dengan nama input di form

    // Mencegah SQL Injection
    $id_instansi = mysqli_real_escape_string($conn, $id_instansi);
    $nama_instansi = mysqli_real_escape_string($conn, $nama_instansi);
    $kontak = mysqli_real_escape_string($conn, $kontak);

    // Query Update
    $query = "UPDATE instansi SET 
                nama_instansi='$nama_instansi', 
                kontak='$kontak' 
              WHERE id_instansi='$id_instansi'";

    $hasil = mysqli_query($conn, $query);

    if ($hasil) {
        header('location:daftarinstansi.php'); // Redirect ke daftar instansi setelah update
        exit();
    } else {
        echo "Update data gagal: " . mysqli_error($conn);
    }
} else {
    echo "Error: Data tidak lengkap.";
}
?>
