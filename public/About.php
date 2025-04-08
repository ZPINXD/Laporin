<?php
include_once("database.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor.in</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body >
    <?php include "layout/navbar.html"?>    
    
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
    
    
<!-- Why Choose Us -->
<section class="bg-gray-100 py-16">
    <div class="max-w-4xl mx-auto text-center px-6">
        <h2 class="text-2xl font-bold mb-6">Mengapa harus Lapor.in?</h2>
        <p class="text-gray-700 mb-10">Kami menyediakan platform yang transparan, cepat, dan mudah digunakan untuk melaporkan berbagai kejadian penting, memastikan setiap laporan mendapat perhatian dari pihak yang berwenang.</p>
        
        <div class="grid gap-6 md:grid-cols-3 text-left">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
                <h3 class="font-semibold text-lg mb-2 text-orange-700">Pelaporan Cepat</h3>
                <p class="text-gray-600 text-sm">Langsung lapor dengan cepat tanpa proses rumit.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
                <h3 class="font-semibold text-lg mb-2 text-orange-700">Distribusi Tepat Sasaran</h3>
                <p class="text-gray-600 text-sm">Laporan langsung diteruskan ke pihak berwenang.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
                <h3 class="font-semibold text-lg mb-2 text-orange-700">Pantauan dan Tindak Lanjut</h3>
                <p class="text-gray-600 text-sm">Tiap laporan dimonitor dan ditindaklanjuti.</p>
            </div>
        </div>
    </div>
</section>


    
    <div class="flex justify-center items-center mt-10">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md text-center">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">GRAFIK LAPORAN</h2>
        <div class="w-full h-80 mx-auto">
            <canvas id="grafik"></canvas>
        </div>
    </div>
</div>

<?php
// Hitung jumlah laporan per kategori (membuat case-insensitive)
function getJumlahLaporan($conn, $kategori) {
    $query = mysqli_query($conn, "SELECT * FROM laporan WHERE LOWER(kategori) = LOWER('$kategori')");
    return mysqli_num_rows($query);
}

$jumlah_bencana = getJumlahLaporan($conn, "Bencana Alam");
$jumlah_demo = getJumlahLaporan($conn, "Demo");
$jumlah_kerusakan = getJumlahLaporan($conn, "Kerusakan");
?>

<script>
    var ctx = document.getElementById("grafik").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Bencana Alam", "Demo", "Kerusakan"],
            datasets: [
                {
                    label: 'Bencana Alam',
                    data: [<?php echo $jumlah_bencana; ?>, 0, 0],
                    backgroundColor: 'rgba(255, 99, 132, 0.7)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2
                },
                {
                    label: 'Demo',
                    data: [0, <?php echo $jumlah_demo; ?>, 0],
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2
                },
                {
                    label: 'Kerusakan',
                    data: [0, 0, <?php echo $jumlah_kerusakan; ?>],
                    backgroundColor: 'rgba(255, 206, 86, 0.7)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            aspectRatio: 2, // Menghindari grafik terlalu tinggi
            scales: {
                y: {
                    beginAtZero: true,
                    max: Math.max(<?php echo $jumlah_bencana; ?>, <?php echo $jumlah_demo; ?>, <?php echo $jumlah_kerusakan; ?>) + 5,
                    ticks: {
                        stepSize: 1
                    }
                },
                x: {
                    stacked: false, // Supaya label tidak menempel
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                }
            },
            barPercentage: 0.6, // Mengurangi lebar batang agar ada jarak
            categoryPercentage: 0.8, // Memberi ruang antar kategori
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        color: '#333',
                        font: {
                            size: 14
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
