<?php
include_once("database.php");
session_start();

$id_admin = $_SESSION["id_admin"] ?? 0;  // Pastikan ID admin ada

// Ambil data terbaru dari database
$query = "SELECT nama FROM admin WHERE id_admin = '$id_admin'";
$result = mysqli_query($conn, $query);
$admin = mysqli_fetch_assoc($result);
$nama_admin = $admin["nama"] ?? "Admin"; // Gunakan "Admin" jika tidak ditemukan
?>
 <body>
    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

 
 <div id="sidebar" class="fixed top-0 left-0 w-64 h-full bg-gray-900 text-white p-5 transition-transform transform -translate-x-64 md:translate-x-0 shadow-lg flex flex-col justify-between">
    <div>
        <h2 class="text-xl font-bold mb-6 mt-10 text-white">
        Admin <span class="text-orange-500"><?= htmlspecialchars($nama_admin) ?></span>
        </h2>
        <ul>
            <li>
                <a href="profiladmin.php" class="flex items-center gap-3 py-3 px-4 rounded-lg hover:text-orange-400 hover:bg-gray-700 transition-all">
                    <i class="fa-regular fa-user "></i> Kelola Admin
                </a>
            </li>
            <li>
                <a href="daftarlaporin.php" class="flex items-center gap-3 py-3 px-4 rounded-lg hover:text-orange-400 hover:bg-gray-700 transition-all">
                    <i class="fa-regular fa-pen-to-square"></i> Daftar Laporin
                </a>
            </li>
            <li>
                <a href="daftarinstansi.php" class="flex items-center gap-3 py-3 px-4 rounded-lg hover:text-orange-400 hover:bg-gray-700 transition-all">
                    <i class="fa-solid fa-building"></i> Daftar Instansi
                </a>
            </li>
        </ul>
    </div>

    <div class="mb-4">
        <a href="proseslogout.php" class="flex items-center gap-3 py-3 px-4 rounded-lg bg-red-600 hover:bg-red-700 transition-all text-white">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
    </div>
</div>


<button id="menu-btn" class="fixed top-4 left-4 p-2 bg-gray-800 text-white rounded z-50 md:hidden transition-all ">☰</button>

</body>
<script>
    const menuBtn = document.getElementById("menu-btn");
    const sidebar = document.getElementById("sidebar");

    menuBtn.addEventListener("click", () => {
        sidebar.classList.toggle("-translate-x-64"); 
    });
</script>
