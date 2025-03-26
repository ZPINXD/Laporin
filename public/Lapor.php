<?php
session_start();
include_once("database.php");

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menampilkan semua laporan yang ada
$sql = "SELECT laporan.*, user.username 
        FROM laporan 
        LEFT JOIN user ON laporan.id_user = user.id_user 
        ORDER BY laporan.id_laporan DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Menentukan nama yang ditampilkan berdasarkan privasi
        $nama_pelapor = ($row['privasi'] == 'anonim') ? 'Anonim' : $row['username'];

        // Menampilkan laporan dengan format yang diinginkan
        echo '<div class="bg-white shadow-md rounded-lg p-6 mb-10 mt-14 py-20">';
        echo '<div class="flex items-center mb-4">';
        echo '<div class="w-10 h-10 bg-gray-300 rounded-full mr-3"></div>';
        echo '<div>';
        echo '<p class="text-gray-700"><strong>' . htmlspecialchars($nama_pelapor) . '</strong></p>';
        echo '<p class="text-gray-500 text-sm">1 jam yang lalu</p>'; // Placeholder waktu
        echo '</div>';
        echo '</div>';
        
        echo '<div class="flex justify-between text-sm text-gray-500 mb-2">';
        echo '<p>Website - ' . htmlspecialchars($row['instansi']) . '</p>';
        echo '<p>Selesai otomatis dalam 10 hari</p>';
        echo '</div>';
        
        echo '<div class="mb-4">';
        echo '<p class="text-primary font-bold">Terdisposisi ' . htmlspecialchars($row['instansi']) . '</p>';
        echo '</div>';
        
        echo '<h2 class="text-lg font-bold text-teal-600 mb-2">' . htmlspecialchars($row['judul']) . '</h2>';
        echo '<p class="text-gray-600 mb-2">' . nl2br(htmlspecialchars($row['isi'])) . '</p>';
        echo '<p class="text-gray-600 mb-4"><strong>Alamat:</strong> ' . htmlspecialchars($row['lokasi']) . '</p>';
        echo '<a href="#" class="text-blue-500 hover:underline">Selengkapnya</a>';
        echo '</div><hr>';
    }
} else {
    echo "Tidak ada laporan.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Formulir Keluhan</title>
</head>

<body >
<?php include "layout/navbar.html"?>
    
</body>
<?php include "layout/footer.html"?>
</html>
