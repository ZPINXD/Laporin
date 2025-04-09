<?php
session_start();
include_once("database.php");

// Ambil ID laporan dari URL
$id_laporan = $_GET['id_laporan'] ?? 0;

// Cek laporan valid
$sql = "SELECT * FROM laporan WHERE id_laporan = $id_laporan";
$result = $conn->query($sql);
if (!$result || $result->num_rows == 0) {
    die("Laporan tidak ditemukan.");
}
$laporan = $result->fetch_assoc();
?>




?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Donasi</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-gray-100">

<?php include "layout/navbar.html"; ?>

<section class="container mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold text-teal-700 mb-6">Form Donasi untuk: <?php echo htmlspecialchars($laporan['judul']); ?></h1>

    <form action="proses_donasi.php" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-4 max-w-xl">
        <input type="hidden" name="id_laporan" value="<?php echo $laporan['id_laporan']; ?>">

        <div>
            <label class="block mb-1 font-semibold text-gray-700">Nama Donatur</label>
            <input type="text" name="nama" class="w-full border border-gray-300 rounded p-2" required>
        </div>

        <div>
            <label class="block mb-1 font-semibold text-gray-700">Email</label>
            <input type="email" id="email" name="email" value="<?= isset($_SESSION["email"]) ? htmlspecialchars($_SESSION["email"]) : "" ?>" readonly class="w-full px-4 py-2 border rounded-lg bg-gray-100 text-gray-700">
            </div>
        </div>

        <div>
            <label class="block mb-1 font-semibold text-gray-700">Nominal Donasi</label>
            <input type="number" name="jumlah" class="w-full border border-gray-300 rounded p-2" min="1000" required>
        </div>

        <div class="mb-4">
                <label class="block text-gray-700 mb-2" for="pesan">Pesan</label>
                <textarea id="pesan" name="pesan" rows="3" class="w-full px-3 py-2 border rounded"></textarea>
            </div>

        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
            Donasi Sekarang
        </button>
    </form>
</section>

<?php include "layout/footer.html"; ?>
</body>
</html>

<?php $conn->close(); ?>
