<?php
include_once("database.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM admin WHERE id_admin = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Admin berhasil dihapus.";
    } else {
        echo "Gagal menghapus admin.";
    }

    $stmt->close();
}

$conn->close();
?>
