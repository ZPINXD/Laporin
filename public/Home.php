

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
	<link rel="stylesheet" href="css/style.css">
    

    <link rel="icon" type="image/x-icon" href="">
</head>

<script>
    let lastScrollTop = 0;
    window.addEventListener("scroll", function () {
    let navbar = document.getElementById("navbar");
    let currentScroll = window.scrollY;

    if (currentScroll > lastScrollTop) {
        // Jika discroll ke bawah, tambahkan efek blur dan transparansi
        navbar.classList.add("bg-gray/50", "backdrop-blur-md", "backdrop-opacity-30", "shadow-lg");
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

    <div class="relative w-full h-[400px] overflow-hidden mt-10">

    <!-- Slides -->
    <div class="relative w-full h-full"> 	
        <!-- Slide 1: Bencana Alam -->
        <div class="slide fade absolute w-full h-full">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0d0d0da4] to-transparent"></div>
            <img src="Assets/bencana alam.jpg" class="w-full h-full object-cover">
            <div class="absolute bottom-10 left-6 text-white">
                <h2 class="text-3xl font-bold">Bencana Alam</h2>
                <p class="text-lg max-w-md">Bantuan sampai lebih cepat.</p>
            </div>
        </div>
    
        <!-- Slide 2: Demo -->
        <div class="slide fade absolute w-full h-full hidden">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0d0d0da4] to-transparent"></div>
            <img src="Assets/Demo.jpg" class="w-full h-full object-cover">
            <div class="absolute bottom-10 left-6 text-white">
                <h2 class="text-3xl font-bold">Ketidakadilan</h2>
                <p class="text-lg max-w-md">Menindak lanjut semua ketidakadilan.</p>
            </div>
        </div>
    
        <!-- Slide 3: Kerusakan Infrastruktur -->
        <div class="slide fade absolute w-full h-full hidden">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0d0d0da4] to-transparent"></div>
            <img src="Assets/kerusakan infrastruktur.jpg" class="w-full h-full object-cover">
            <div class="absolute bottom-10 left-6 text-white">
                <h2 class="text-3xl font-bold">Kerusakan Infrastruktur</h2>
                <p class="text-lg max-w-md">Infrastruktur rusak cepat pulih.</p>
            </div>
        </div>
    </div>
    

	<!-- Tombol Navigasi -->
	<button class="prev absolute top-1/2 left-3 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-4 rounded-full text-2xl hover:bg-opacity-75 transition">
		&#10094;
	</button>
	<button class="next absolute top-1/2 right-3 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-4 rounded-full text-2xl hover:bg-opacity-75 transition">
		&#10095;
	</button>

	<!-- Indikator Bulat -->
	<div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-3">
		<span class="dot w-4 h-4 bg-white rounded-full cursor-pointer"></span>
		<span class="dot w-4 h-4 bg-gray-400 rounded-full cursor-pointer"></span>
		<span class="dot w-4 h-4 bg-gray-400 rounded-full cursor-pointer"></span>
	    </div>
    </div>

  
	 <div class="container mx-auto p-6">
        <!-- Hero Section -->
        <div class="flex flex-col items-center text-center py-16">
            <h1 class="text-5xl font-bold text-black">Selamat Datang di Lapor.In</h1>
            <p class="text-lg text-gray-600 mt-4">Platform pengaduan yang cepat dan responsif</p>
            <a href="#formaduan" class="mt-6 px-6 py-3 border-none bg-orange-600 text-white rounded-lg hover:bg-orange-700">Buat Laporan</a>
        </div>
    </div>



<div class="max-w-6xl  mx-auto relative overflow-x-auto">
    <div class="flex items-center gap-6 md:gap-8 relative z-10 w-full">
        <!-- Langkah 1 -->
        <div class="flex flex-col items-center text-center w-1/5 min-w-[200px]">
            <div class="w-16 h-16 flex items-center justify-center bg-green-600 text-white text-2xl rounded-full border-4 border-white shadow-lg">
                ✍️
            </div>
            <h3 class="font-semibold mt-4">Tulis Laporan</h3>
            <p class="text-gray-600 text-sm">Laporkan keluhan atau aspirasi Anda dengan jelas dan lengkap</p>
        </div>

        <div class="h-1 w-1/5 bg-gray-300"></div> <!-- Garis penghubung -->

        <!-- Langkah 2 -->
        <div class="flex flex-col items-center text-center w-1/5 min-w-[200px]">
            <div class="w-16 h-16 flex items-center justify-center bg-white text-blue-500 text-2xl rounded-full border-4 border-gray-300 shadow-lg">
                🔍
            </div>
            <h3 class="font-semibold mt-4">Proses Verifikasi</h3>
            <p class="text-gray-600 text-sm">Dalam 3 hari, laporan Anda akan diverifikasi dan diteruskan ke instansi berwenang</p>
        </div>

        <div class="h-1 w-1/5 bg-gray-300"></div> <!-- Garis penghubung -->

        <!-- Langkah 3 -->
        <div class="flex flex-col items-center text-center w-1/5 min-w-[200px]">
            <div class="w-16 h-16 flex items-center justify-center bg-white text-green-500 text-2xl rounded-full border-4 border-gray-300 shadow-lg">
                ✅
            </div>
            <h3 class="font-semibold mt-4">Proses Tindak Lanjut</h3>
            <p class="text-gray-600 text-sm">Dalam 5 hari, instansi akan menindaklanjuti dan membalas laporan Anda</p>
        </div>

        <div class="h-1 w-1/5 bg-gray-300"></div> <!-- Garis penghubung -->

        <!-- Langkah 4 -->
        <div class="flex flex-col items-center text-center w-1/5 min-w-[200px]">
            <div class="w-16 h-16 flex items-center justify-center bg-white text-gray-500 text-2xl rounded-full border-4 border-gray-300 shadow-lg">
                💬
            </div>
            <h3 class="font-semibold mt-4">Beri Tanggapan</h3>
            <p class="text-gray-600 text-sm">Anda dapat menanggapi kembali balasan dalam waktu 10 hari</p>
        </div>

        <div class="h-1 w-1/5 bg-gray-300"></div> <!-- Garis penghubung -->

        <!-- Langkah 5 -->
        <div class="flex flex-col items-center text-center w-1/5 min-w-[200px]">
            <div class="w-16 h-16 flex items-center justify-center bg-white text-purple-500 text-2xl rounded-full border-4 border-gray-300 shadow-lg">
                ✔️
            </div>
            <h3 class="font-semibold mt-4">Selesai</h3>
            <p class="text-gray-600 text-sm">Laporan Anda akan terus ditindaklanjuti hingga selesai</p>
        </div>
    </div>
</div>
    
        
        <!-- Section Informasi -->
        <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 py-16 ">
            <div class="p-6 bg-white shadow-lg rounded-lg ">
                <h3 class="text-xl font-semibold flex items-center">
                    Cepat <span class="ml-2">🚀</span>
                </h3>
                <p class="text-gray-600 mt-2">Laporan Anda akan diproses dengan cepat dan akurat.</p>
            </div>
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <h3 class="text-xl font-semibold flex items-center">
                    Akurat <span class="ml-2">🎯</span>
                </h3>
                <p class="text-gray-600 mt-2">Data yang Anda kirimkan akan diverifikasi secara sistematis.</p>
            </div>
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <h3 class="text-xl font-semibold flex items-center">
                    Terpercaya <span class="ml-2">✅</span>
                </h3>
                <p class="text-gray-600 mt-2">Privasi dan keamanan laporan Anda adalah prioritas kami.</p>
            </div>
        </div>
        


    <div id="formaduan" class="max-w-4xl mx-auto p-8">
        <div  class="bg-white p-6 rounded-lg shadow-lg ">
          <!-- Title -->
          <h2  class="text-2xl text-black font-semibold text-center mb-6">Sampaikan Laporan Anda</h2>
          <!-- Form Content -->
          <form id="laporanForm" action="proses_laporan.php" method="post">
            <!-- Judul Laporan -->
            <div class="mb-4">
                <label for="judul" class="block text-sm font-semibold text-gray-700">Ketikan Judul Laporan Anda</label>
                <input type="text" id="judul" name="judul" class="w-full mt-2 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary" placeholder="Masukkan judul laporan" required>
            </div>

            <!-- Isi Laporan -->
            <div class="mb-4">
                <label for="isi" class="block text-sm font-semibold text-gray-700">Ketikan Isi Laporan Anda</label>
                <textarea id="isi" name="isi" class="w-full mt-2 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary" rows="4" placeholder="Masukkan isi laporan" required></textarea>
            </div>

            <!-- Tanggal Kejadian -->
            <div class="mb-4">
                <label for="tanggal" class="block text-sm font-semibold text-gray-700">Pilih Tanggal Kejadian</label>
                <input type="date" id="tanggal" name="tanggal" class="w-full mt-2 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary" required>
            </div>

            <!-- Lokasi Kejadian -->
            <div class="mb-4">
                <label for="lokasi" class="block text-sm font-semibold text-gray-700">Ketikan Lokasi Kejadian</label>
                <input type="text" id="lokasi" name="lokasi" class="w-full mt-2 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary" placeholder="Masukkan lokasi kejadian" required>
            </div>

            <!-- Instansi Tujuan -->
            <div class="mb-4">
                <label for="instansi" class="block text-sm font-semibold text-gray-700">Ketikan Instansi Tujuan</label>
                <input type="text" id="instansi" name="instansi" class="w-full mt-2 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary" placeholder="Masukkan instansi tujuan" required>
            </div>

            <!-- Kategori Laporan -->
            <div class="mb-4">
                <label for="kategori" class="block text-sm font-semibold text-gray-700">Pilih Kategori Laporan Anda</label>
                <select id="kategori" name="kategori" class="w-full mt-2 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary" required>
                    <option value="" disabled selected>Pilih kategori</option>
                    <option value="bencana">Bencana Alam</option>
                    <option value="demo">Demo</option>
                    <option value="kerusakan">Kerusakan Infrastruktur</option>
                </select>
            </div>

            <!-- Pilihan Anonim atau Rahasia -->
            <div class="mb-4 flex items-center">
                <input type="radio" id="anonim" name="privasi" value="anonim" class="mr-2" required>
                <label for="anonim" class="text-sm">Anonim</label>
                <input type="radio" id="rahasia" name="privasi" value="rahasia" class="ml-4 mr-2">
                <label for="rahasia" class="text-sm">Rahasia</label>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="bg-orange-600 text-white px-6 py-3 rounded-full text-l w-full focus:outline-none hover:bg-orange-700">Lapor!</button>
            </div>
        </form>
        
            
 
        </div>
        <script>
            document.getElementById("laporanForm").addEventListener("submit", function(event) {
    event.preventDefault();  // Cegah submit default dulu biar kita cek datanya

    // Ambil data form
    let judul = document.getElementById("judul").value;
    let isi = document.getElementById("isi").value;
    let tanggal = document.getElementById("tanggal").value;
    let lokasi = document.getElementById("lokasi").value;
    let instansi = document.getElementById("instansi").value;
    let kategori = document.getElementById("kategori").value;
    let privasi = document.querySelector('input[name="privasi"]:checked');

    // Cek data form (simple validasi)
    if (!judul || !isi || !tanggal || !lokasi || !instansi || !kategori || !privasi) {
        alert("Semua field harus diisi!");
        return;
    }

    // Kirim data via fetch ke PHP
    fetch("proses_laporan.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `judul=${judul}&isi=${isi}&tanggal=${tanggal}&lokasi=${lokasi}&instansi=${instansi}&kategori=${kategori}&privasi=${privasi.value}`
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        window.location.href = "Lapor.php";  // Redirect kalau sukses
    })
    .catch(error => alert("Terjadi kesalahan: " + error));
});

        </script>
    </div>
    

                <script src="Js/formValidation.js"></script>
                <script src="Js/script.js"></script>
                <script src="Js/slide.js"></script>

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