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
<script>
    let lastScrollTop = 0;
    window.addEventListener("scroll", function () {
    let navbar = document.getElementById("navbar");
    let currentScroll = window.scrollY;

    if (currentScroll > lastScrollTop) {
        // Jika discroll ke bawah, tambahkan efek blur dan transparansi
        navbar.classList.add("bg-gray/50", "backdrop-blur-md", "backdrop-opacity-30" "shadow-lg");
        navbar.classList.remove("bg-gray-900");
    } else if (currentScroll === 0) {
        // Jika kembali ke atas, tetap putih
        navbar.classList.remove("bg-gray/50", "backdrop-blur-md", "shadow-lg");
        navbar.classList.add("bg-gray-900");
    }

    lastScrollTop = currentScroll;
});

</script>
<body >
	<nav id="navbar" class="fixed top-0 left-0 w-full bg-gray-900 shadow-md p-4 flex justify-between items-center z-50 transition-all duration-300">
        <div class="flex items-center space-x-2">
            <div class="bg-green-700 w-8 h-8 flex items-center justify-center rounded-full shadow">
                <span class="text-white text-lg font-bold">L</span>
            </div>
            <h2 class="text-white text-lg font-bold">Lapor.in</h2>
        </div>
    
        <!-- Navigasi Desktop -->
        <ul class="hidden md:flex space-x-6 ">
            <li><a href="Home.php" class="text-white font-semibold hover:text-orange-400">HOME</a></li>
            <li><a href="About.php" class="text-white font-semibold hover:text-orange-400">ABOUT US</a></li>
            <li><a href="Lapor.php" class="text-white font-semibold hover:text-orange-400">LAPOR</a></li>
            
            <?php if (isset($_SESSION['is_login']) && $_SESSION['is_login'] === true): ?>
            <a href="proseslogout.php" class="text-white font-semibold hover:text-orange-400">LOGOUT</a>
            <?php else: ?>
            <a href="login.php" class="text-white font-semibold hover:text-orange-400">MASUK</a>
            <a href="register.php" class="text-white font-semibold hover:text-orange-400">DAFTAR</a>
            <?php endif; ?>

        </ul>
    
        <!-- Tombol Menu untuk HP -->
        <button id="menu-toggle" class="md:hidden text-gray-600 text-2xl focus:outline-none">
            ☰
        </button>
    </nav>
    
    <!-- Dropdown Menu (Hidden by Default) -->
    <div id="dropdown-menu" class="hidden fixed top-16 right-4 w-48 border-2 border-gray-600 bg-white shadow-md rounded-md z-50 md:hidden">
        <ul class="flex flex-col space-y-2 px-4 py-2">
            <li><a href="Home.php" class="block text-gray-600 font-semibold hover:text-orange-400">HOME</a></li>
            <li><a href="About.php" class="block text-gray-600 font-semibold hover:text-orange-400">ABOUT US</a></li>
            <li><a href="Lapor.php" class="block text-gray-600 font-semibold hover:text-orange-400">LAPOR</a></li>
            <?php if (isset($_SESSION['is_login']) && $_SESSION['is_login'] === true): ?>
        <li><a href="logout.php" class="block text-gray-600 font-semibold hover:text-orange-400">LOGOUT</a></li>
    <?php else: ?>
        <li><a href="login.php" class="block text-gray-600 font-semibold hover:text-orange-400">MASUK</a></li>
        <li><a href="register.php" class="block text-gray-600 font-semibold hover:text-orange-400">DAFTAR</a></li>
    <?php endif; ?>
        </ul>
    </div>
    
    
    <!-- Home Cover -->
    <script>
        document.getElementById("menu-toggle").addEventListener("click", function () {
            let dropdown = document.getElementById("dropdown-menu");
            dropdown.classList.toggle("hidden");
    });
    </script>

<!--Navbar END-->

    


    <footer class="bg-gray-900 text-white py-10 mt-10">
        <div class="container mx-auto text-center">
            <!-- Judul -->
            <h2 class="text-xl font-semibold">INSTANSI TERHUBUNG</h2>
    
            <!-- Logo Instansi -->
            <div class="flex justify-center gap-6 mt-6 flex-wrap">
                <a href="https://www.menpan.go.id/" target="_blank">
                    <img src="Assets/Logo_PANRB_Default.png" alt="PANRB" class="h-12 transition-transform duration-300 hover:scale-110">
                </a>
                <a href="https://www.komdigi.id/" target="_blank">
                    <img src="Assets/KOMDIGI Logo 2024.webp" alt="Komdigi" class="h-12 transition-transform duration-300 hover:scale-110">
                </a>
                <a href="https://www.ombudsman.go.id/" target="_blank">
                    <img src="Assets/ombudsman.png" alt="Ombudsman RI" class="h-12 transition-transform duration-300 hover:scale-110">
                </a>
            </div>
            
    
            <!-- Navigasi dan Hak Cipta -->
            <div class="mt-8">
                <ul class="flex justify-center gap-4 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-green-600">Privacy</a></li>
                    <li><a href="#" class="hover:text-green-600">Ketentuan Layanan</a></li>
                    <li><a href="#" class="hover:text-green-600">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-green-600">Hubungi Kami</a></li>
                </ul>
                <p class="text-xs text-gray-500 mt-4">&copy; 2025 Kantor Staf Presiden. Hak cipta dilindungi Undang-Undang.</p>
            </div>
        </div>
    </footer>
</body>
</html>
