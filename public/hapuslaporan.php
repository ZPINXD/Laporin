<?php
include 'database.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_laporan = $_POST['id_laporan'];

    // Cek apakah ID ada dan valid
    if (!empty($id_laporan)) {
        $query = "DELETE FROM laporan WHERE id_laporan = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id_laporan);

        if (mysqli_stmt_execute($stmt)) {
            // Redirect kembali ke halaman laporan
            header("Location: lihatlaporan.php?status=deleted");
            exit();
        } else {
            echo "Gagal menghapus laporan.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "ID laporan tidak valid.";
    }
}

mysqli_close($conn);
?>
