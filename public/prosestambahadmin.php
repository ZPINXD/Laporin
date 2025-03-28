<?php 
include_once("database.php");
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$email = strtolower(mysqli_real_escape_string($conn, $_POST['email']));
$password = $_POST['password'];
$hashedPassword = hash('sha256', $password);
$query = "INSERT INTO admin (email, nama, password) VALUES ('$email', '$nama', '$hashedPassword')";
$hasil = mysqli_query($conn, $query);

if ($hasil) {
    header('location:profiladmin.php');
} else {
    echo "input data gagal";
}
?>
