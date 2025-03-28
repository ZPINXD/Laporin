<?php
include_once("database.php");

if (isset($_GET['id'])) {
    $id_instansi = $_GET['id']; 

    
    $stmt = $conn->prepare("SELECT * FROM instansi WHERE id_instansi = ?");
    $stmt->bind_param("i", $id_instansi);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $instansi = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan!";
        exit();
    }
} else {
    echo "ID tidak ditemukan!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit instansi</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<body class="bg-gray-100 flex justify-center items-center h-screen">

<div class="bg-white p-6 rounded-lg shadow-lg w-96">
    <h2 class="text-2xl font-bold text-center text-orange-500 mb-4">Edit Instansi</h2>
    
    <form action="prosesubahinstansi.php" method="POST">
        <input type="hidden" name="id_instansi" value="<?= htmlspecialchars($instansi['id_instansi']); ?>">

        <label class="block font-semibold">Admin ID:</label>
        <input type="text" name="id_instansi" value="<?= htmlspecialchars($instansi['id_instansi']); ?>" class="w-full px-4 py-2 border rounded-lg mb-3 bg-gray-200" readonly>

        <label class="block font-semibold">Nama:</label>
        <input type="text" name="nama_instansi" value="<?= htmlspecialchars($instansi['nama_instansi']); ?>" class="w-full px-4 py-2 border rounded-lg mb-3" required>

        <label class="block font-semibold">Informasi Kontak:</label>
        <input type="text" name="Kontak" value="<?= htmlspecialchars($instansi['Kontak']); ?>" class="w-full px-4 py-2 border rounded-lg mb-3" required>
        <div class="flex justify-between mt-5">
        <button type="submit" name="simpan" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Simpan</button>
            <a href="daftarinstansi.php" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Kembali</a>
        </div>
    </form>
</div>

</body>
</html>
