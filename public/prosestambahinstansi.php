<?php 
include_once("database.php");


$nama = mysqli_real_escape_string($conn, $_POST['nama_instansi']);
$kontak = mysqli_real_escape_string($conn, $_POST['kontak']);
$status = mysqli_real_escape_string($conn, $_POST['status']);


$query = "INSERT INTO instansi (nama_instansi, kontak, status) VALUES ('$nama', '$kontak', '$status')";
$hasil = mysqli_query($conn, $query);

// Cek apakah data berhasil ditambahkan
if ($hasil) {
    header('Location: daftarinstansi.php'); // Redirect ke halaman daftar instansi
    exit();
} else {
    echo "Input data gagal: " . mysqli_error($conn); // Menampilkan pesan error jika gagal
}
?>
