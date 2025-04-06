<?php
include_once("database.php");

if (isset($_GET['id'])) {
    $id_laporan = intval($_GET['id']);
    
    $stmt = $conn->prepare("SELECT lampiran FROM laporan WHERE id_laporan = ?");
    $stmt->bind_param("i", $id_laporan);
    $stmt->execute();
    $stmt->bind_result($lampiran);
    $stmt->fetch();
    $stmt->close();
    
    if ($lampiran) {
        header("Content-Type: image/jpeg"); // Sesuaikan dengan jenis file yang disimpan, misalnya image/png atau application/pdf
        echo $lampiran;
        exit();
    } else {
        echo "Lampiran tidak ditemukan.";
    }
} else {
    echo "ID laporan tidak valid.";
}
?>
