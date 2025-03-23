<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
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

<!-- LOGIN -->

<div class="flex justify-center items-center h-screen ">
        <div class="w-96 p-6 shadow-lg bg-white rounded-md">
            <h1 class="text-3xl block text-center font-semibold"><i class="fa-solid fa-user"></i> Login</h1>
            <hr class="mt-3">
            <form action="proseslogin.php" method="POST">
            <div class="mt-3">
                <label for="email" class="block text-base mb-2">Email</label>
                <input type="text" name="email" class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-gray-600" placeholder="Masukkan Username..." />
            </div>
            <div class="mt-3">
                <label for="password" class="block text-base mb-2">Password</label>
                <input type="password" id= "password" name="password" class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-gray-600" placeholder="Masukkan Password..." />
            </div>

            <div class="mt-3 text-gray-500" >
                <input type="checkbox" onclick="togglePassword()"> Show password
            </div>
            <script>
                function togglePassword() {
                    var pass = document.getElementById("password");
                    if (pass.type === "password") {
                        pass.type = "text";
                    } else {
                        pass.type = "password";
                    }
                }
            </script>
           
            <div class="mt-5">
            <?php
            if (isset($_SESSION['login_message'])) {
            echo "<p style='color: red;'>" . $_SESSION['login_message'] . "</p>";
            unset($_SESSION['login_message']); // Hapus pesan setelah ditampilkan
            }
            ?>
                <button type="submit" class="border-2 bg-orange-600 hover:bg-orange-700 text-white py-1 w-full rounded-md  font-semibold"><i class="fa-solid fa-right-to-bracket"></i>&nbsp;&nbsp;Login</button>
            </div>
            </form>
        </div>
    </div>

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