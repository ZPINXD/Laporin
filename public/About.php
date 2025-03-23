<?php
include_once("database.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    
    <!-- Home Cover --> 
    
    
    <!-- Hero Section -->
<section class="relative bg-cover bg-center text-white py-10 mt-16 text-center flex items-center justify-center" style="background-image: url('Assets/Untitled\ \(2600\ x\ 1000\ px\).png');">
    <!-- Overlay untuk meningkatkan keterbacaan teks -->
    <div class="absolute inset-0 bg-black bg-opacity-50"></div> 
    <!-- Teks -->
    <div class="relative z-10">
        <h1 class="text-3xl font-bold">Apa itu Lapor.in?</h1>
    </div>
</section>
    
    <!-- About Content -->
    <section class="max-w-6xl mx-auto py-10 px-6">
        <h2 class="text-2xl font-bold">Lapor.in</h2>
        <p class="text-gray-600 mt-4">Pengelolaan pengaduan terkait berbagai permasalahan di masyarakat, seperti ketidakadilan pemerintahan, fasilitas umum yang tidak layak, dan kejadian bencana alam, masih belum terintegrasi dengan baik. Setiap instansi atau pihak berwenang sering kali menangani aduan secara parsial dan tidak terkoordinasi, yang dapat menyebabkan duplikasi penanganan atau bahkan pengabaian laporan dengan alasan di luar kewenangan. Akibatnya, banyak permasalahan yang tidak terselesaikan secara efektif.
        
        Oleh karena itu, untuk mendukung transparansi dan akuntabilitas dalam sistem pelaporan masyarakat, diperlukan sebuah platform yang terintegrasi dan mudah diakses. Lapor.in hadir sebagai solusi pengaduan satu pintu yang memungkinkan masyarakat untuk melaporkan berbagai kejadian dengan cepat dan akurat. Dengan sistem ini, setiap laporan akan diteruskan ke pihak yang berwenang sesuai dengan kategori pengaduan, sehingga proses penanganan menjadi lebih efisien dan tepat sasaran. </p>   
        <div id="moreText" class="hidden mt-2">
            <p class="text-gray-600">Lapor.in dibangun dengan prinsip “no wrong door policy”, yang menjamin bahwa setiap laporan yang masuk akan diproses dan diteruskan kepada pihak yang berwenang menangani permasalahan tersebut. Tujuan utama dari sistem ini adalah:
            <p >
                <ol class="text-gray-600 m-3" type="1">
                    <li>1. Mempermudah masyarakat dalam menyampaikan pengaduan secara cepat, tepat, dan terkoordinasi.</li>
                    <li>2. Memberikan akses transparan bagi masyarakat untuk berpartisipasi dalam melaporkan permasalahan di lingkungan mereka.</li>
                    <li>3. Meningkatkan efektivitas dalam penyelesaian aduan dengan sistem yang responsif dan terintegrasi.
                    </li>
                </ol>
            </p>
            <p class="text-gray-600 mt-2">
            Dengan adanya Lapor.in, diharapkan setiap masalah yang dilaporkan oleh masyarakat dapat segera mendapatkan tanggapan dan penyelesaian yang tepat, sehingga tercipta lingkungan yang lebih baik, adil, dan nyaman bagi semua.</p>
        </div>
        <button id="readMoreBtn" class="mt-6 px-6 py-3 border-none bg-orange-700 text-white rounded-lg hover:bg-orange-600">Lebih banyak</button>
        
        <script>document.getElementById("readMoreBtn").addEventListener("click", function() {
            var moreText = document.getElementById("moreText");
            if (moreText.classList.contains("hidden")) {
                moreText.classList.remove("hidden");
                this.textContent = "Lebih sedikit";
            } else {
                moreText.classList.add("hidden");
                this.textContent = "Lebih banyak";
            }
        
        });
        </script>
    </section>
    
    

</section>
    <!-- Why Choose Us -->
    <section class="bg-gray-100 py-10">
        <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-3 gap-6">
            <div>
                <h3 class="text-xl font-bold">Mengapa harus Lapor.in?</h3>
                <p class="text-gray-600 mt-2">Kami menyediakan platform yang transparan, cepat, dan mudah digunakan untuk melaporkan berbagai kejadian penting, memastikan setiap laporan mendapat perhatian dari pihak yang berwenang.</p>
            </div>
            <div>
                <h3 class="text-xl font-bold">Solusi kami</h3>
                <div class="bg-white p-4 shadow rounded mt-2">Pelaporan Cepat </div>
                <div class="bg-white p-4 shadow rounded mt-2">Distribusi Tepat Sasaran</div>
                <div class="bg-white p-4 shadow rounded mt-2">Pantauan dan Tindak Lanjut</div>

            </div>

            <div>
                <h3 class="text-xl font-bold">Data Lapor.in</h3>
                    <!-- Bencana Alam -->
                    <div class="mt-2">
                        <p class="text-sm font-semibold">Bencana alam</p>
                        <div class="w-full bg-gray-300 h-2 rounded relative">
                            <div class="bg-red-500 h-2 rounded relative group" style="width: 70%;">
                                <span class="absolute -top-6 left-1/2 transform -translate-x-1/2 hidden group-hover:block bg-black text-white text-xs px-2 py-1 rounded">
                                    70%
                                </span>
                            </div>
                        </div>
                       </div>
                
                    <!-- Ketidakadilan -->
                    <div class="mt-2">
                        <p class="text-sm font-semibold">Ketidakadilan</p>
                        <div class="w-full bg-gray-300 h-2 rounded relative">
                            <div class="bg-green-500 h-2 rounded relative group" style="width: 80%;">
                                <span class="absolute -top-6 left-1/2 transform -translate-x-1/2 hidden group-hover:block bg-black text-white text-xs px-2 py-1 rounded">
                                    80%
                                </span>
                            </div>
                        </div>
                    </div>
                
                    <!-- Kerusakan Infrastruktur -->
                    <div class="mt-2">
                        <p class="text-sm font-semibold">Kerusakan infrastruktur</p>
                        <div class="w-full bg-gray-300 h-2 rounded relative">
                            <div class="bg-blue-500 h-2 rounded relative group" style="width: 60%;">
                                <span class="absolute -top-6 left-1/2 transform -translate-x-1/2 hidden group-hover:block bg-black text-white text-xs px-2 py-1 rounded">
                                    60%
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
        </div>
    </section>


<!-- Grafik Laporan -->
<div class="flex justify-center items-center mt-10">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm text-center">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">GRAFIK LAPORAN</h2>
        <div class="w-64 h-64 mx-auto">
            <canvas id="grafik"></canvas>
        </div>
    </div>
</div>

<?php

// Hitung jumlah laporan per kategori
$bencana = mysqli_query($conn, "SELECT * FROM laporan WHERE kategori='Bencana Alam'");
$jumlah_bencana = mysqli_num_rows($bencana);

$demo = mysqli_query($conn, "SELECT * FROM laporan WHERE kategori='demo'");
$jumlah_demo = mysqli_num_rows($demo);
?>

<script>
    var ctx = document.getElementById("grafik").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Bencana Alam", "demo"],
            datasets: [{
                label: 'Jumlah Laporan',
                data: [<?php echo $jumlah_bencana; ?>, <?php echo $jumlah_demo; ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: Math.max(<?php echo $jumlah_bencana; ?>, <?php echo $jumlah_demo; ?>) + 5
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        color: '#333',
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });
</script>





    

  <!-- Footer -->
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
