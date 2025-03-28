<?php
include_once("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST['status'] as $id_laporan => $status) {
        $id_laporan = mysqli_real_escape_string($conn, $id_laporan);
        $status = mysqli_real_escape_string($conn, $status);

        $query = "UPDATE laporan SET status = '$status' WHERE id_laporan = '$id_laporan'";
        mysqli_query($conn, $query);
    }
    header("Location: daftarlaporin.php?status=success");
    exit();
} else {
    header("Location: daftarlaporin.php?status=error");
    exit();
}
?>
