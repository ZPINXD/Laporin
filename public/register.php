<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

<div class="bg-white rounded shadow-md max-w-4xl mx-auto p-8 mt-24">
    <h2 class="text-2xl font-bold mb-10 text-center"><i class="fa-solid fa-user"></i> Form Registrasi</h2>
    <form>
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
        <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Nama Lengkap</label>
                <input type="text" placeholder="Nama Lengkap" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Tempat Tinggal Saat Ini</label>
                <input type="text" placeholder="Ketikan Tempat Tinggal Saat Ini" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Jenis Kelamin</label>
                <select class="w-full p-2 border border-gray-300 rounded" required>
                    <option>Pilih Jenis Kelamin</option>
                    <option>Laki-laki</option>
                    <option>Perempuan</option>
                </select>
            </div>
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">No. Telp Aktif</label>
                <input type="tel" placeholder="Minimal 8-14 Angka" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Email</label>
                <input type="email" placeholder="lapor@contoh.com" class="w-full p-2 border border-gray-300 rounded focus:outline-none" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Password</label>
                <input type="password" class=" p-2 border border-gray-300 rounded focus:outline-none" required>
                <p class="text-xs text-gray-500 mt-1">Minimal 8 karakter dan harus berisi kombinasi huruf kapital, huruf kecil, angka dan karakter khusus (@$!%*?&).</p>
            </div>
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Password Confirmation</label>
                <input type="password" class=" p-2 border border-gray-300 rounded" required>
            </div>
        </div>

        <button type="submit" class="mt-6 rounded-full text-lg w-full focus:outline-none  bg-orange-600 hover:bg-orange-700 text-white py-2 "><i class="fa-solid fa-up-right-from-square"></i> DAFTAR</button>
    </form>
</div>
<!-- JavaScript buat handle error -->
<script>
    // Ambil elemen email & password
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");

    // Fungsi untuk tambah border merah kalau kosong
    const validateInput = (input) => {
        if (input.value.trim() === "") {
            input.classList.add("border-red-500");
        } else {
            input.classList.remove("border-red-500");
        }
    };

    // Event saat klik dan keluar dari input email
    emailInput.addEventListener("blur", () => validateInput(emailInput));
    passwordInput.addEventListener("blur", () => validateInput(passwordInput));

    // Cek ulang kalau submit
    document.getElementById("registerForm").addEventListener("submit", (e) => {
        validateInput(emailInput);
        validateInput(passwordInput);

        // Stop submit kalau ada field yang masih kosong
        if (emailInput.value.trim() === "" || passwordInput.value.trim() === "") {
            e.preventDefault();
            alert("Pastikan email dan password sudah terisi ya!");
        }
    });
</script>
<!-- Footer -->
<footer class="bg-gray-900 text-white py-10 mt-10">
    <div class="container mx-auto text-center">
        <h2 class="text-xl font-semibold">INSTANSI TERHUBUNG</h2>
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