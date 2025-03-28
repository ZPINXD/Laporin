<?php
include "database.php";

if (!isset($_GET['id'])) {
    echo "<script>alert('ID Admin tidak ditemukan!'); window.history.back();</script>";
    exit();
}

$adminId = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Hapus Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h3>Konfirmasi Penghapusan Admin</h3>
        <p>Untuk menghapus admin, silakan masukkan password Anda sebagai konfirmasi.</p>
        
        <form action="proseshapusadmin.php" method="POST">
            <input type="hidden" name="id_admin" value="<?= htmlspecialchars($adminId); ?>">

            <label for="password" class="font-weight-bold">Password:</label>
            <input type="password" name="password" class="form-control mb-3" required>

            <button type="submit" name="hapus" class="btn btn-danger">Hapus Admin</button>
            <a href="profiladmin.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>

