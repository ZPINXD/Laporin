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
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Form Donasi</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

<?php include "layout/navbar.html"; ?>

<!-- Section dengan padding responsif -->
<section class="flex-grow flex items-center justify-center mt-20 py-12 px-4">
    <div class="bg-white w-full max-w-2xl sm:max-w-xl md:max-w-lg lg:max-w-xl xl:max-w-2xl rounded-lg shadow-lg p-6 sm:p-8 md:p-10">
        <h1 class="text-xl sm:text-2xl font-bold text-orange-700 mb-6 text-center leading-snug">
            Form Donasi untuk:<br>
            <span class="text-gray-800 block mt-2 text-base sm:text-lg md:text-xl">
                <?php echo htmlspecialchars($laporan['judul']); ?>
            </span>
        </h1>

        <form action="proses_donasi.php" method="POST" class="space-y-5">
            <input type="hidden" name="id_laporan" value="<?php echo $laporan['id_laporan']; ?>">

            <div>
                <label class="block mb-1 font-semibold text-gray-700">Nama Donatur</label>
                <input type="text" name="nama" class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-orange-200" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-700">Email</label>
                <input type="email" id="email" name="email" 
                       value="<?= isset($_SESSION["email"]) ? htmlspecialchars($_SESSION["email"]) : "" ?>" 
                       readonly 
                       class="w-full px-4 py-2 border rounded-lg bg-gray-100 text-gray-700">
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-700">Nominal Donasi</label>
                <input type="number" name="jumlah" min="1000" class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-orange-200" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-700" for="pesan">Pesan</label>
                <textarea id="pesan" name="pesan" rows="3" class="w-full px-3 py-2 border rounded resize-none focus:ring focus:ring-orange-200"></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="w-full sm:w-auto bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded transition">
                    Donasi Sekarang
                </button>
            </div>
        </form>
    </div>
</section>

<?php include "layout/footer.html"; ?>
</body>
</html>

<?php $conn->close(); ?>
