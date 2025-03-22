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
            <li><a href="login.php" class="text-white font-semibold hover:text-orange-400">MASUK</a></li>
            <li><a href="register.php" class="text-white font-semibold hover:text-orange-400">DAFTAR</a></li>

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
            <li><a href="login.php" class="block text-gray-600 font-semibold hover:text-orange-400">MASUK</a></li>
            <li><a href="register.php" class="block text-gray-600 font-semibold hover:text-orange-400">DAFTAR</a></li>
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

    
    <!-- Konten Laporan -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-10 mt-14 py-20">
        <div class="flex items-center mb-4">
            <div class="w-10 h-10 bg-grays-300 rounded-full mr-3"></div>
            <div>
                <p class="text-gray-700"><strong>Anonim</strong></p>
                <p class="text-gray-500 text-sm">1 jam yang lalu</p>
            </div>
        </div>
        
        <div class="flex justify-between text-sm text-gray-500 mb-2">
            <p>Website - pemerintah-provisi-dki-jakarta</p>
            <p>Selesai otomatis dalam 10 hari</p>
        </div>
        
        <div class="mb-4">
            <p class="text-primary font-bold">Terdisposisi ke Pemprov DKI 2</p>
        </div>

        <h2 class="text-lg font-bold text-teal-600 mb-2">Perbaikan Trotuar Smpn 205, Semanan</h2>

        <p class="text-gray-600 mb-2">Trotuar seberang smpn 205 tolong diperbaiki berupa pemasangan kanstin dan perbaikan paving block.</p>
        
        <p class="text-gray-600 mb-4"><strong>Alamat:</strong> jl. semanan raya, semanan, kec. kalideres, jakarta barat, dki jakarta</p>
        
        <a href="#" class="text-blue-500 hover:underline">Selengkapnya</a>

        <div class="mt-4">
            <p class="text-gray-600 font-medium">📍 TROTROAR</p>
            <img src="/src/asset/trotoar.jpeg" alt="Trotuar" class="w-full h-auto rounded-lg mt-2">
        </div>

        <div class="mt-4 text-sm">
            <p class="text-gray-700">#8734151</p>
            <div class="flex space-x-4 mt-2">
                <button class="text-blue-500 hover:underline">Tindak Lanjut 2</button>
                <button class="text-gray-500 hover:underline">Komentar 0</button>
                <button class="text-gray-500 hover:underline">Dukung</button>
                <button class="text-gray-500 hover:underline">Bagikan</button>
            </div>
        </div>
    </div>


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
