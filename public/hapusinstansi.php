<?php
include_once ("database.php");
$id=$_GET['id'];
$query="delete from instansi where id_instansi=$id";
$hasil=mysqli_query($conn,$query);
if ($hasil) {
header('location:daftarinstansi.php');
}else {
echo "Hapus Data Gagal";
}?>