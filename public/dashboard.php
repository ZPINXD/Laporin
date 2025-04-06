<?php
    include 'database.php'; 
    $query = "SELECT COUNT(*) AS total_laporan FROM laporan";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    $totalLaporan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM laporan"))['total'];
    $totalInstansi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM instansi WHERE status = 'Aktif'"))['total'];
    $totalUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM user WHERE status_user = 'Aktif'"))['total'];
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include "layout/navbaradmin.php"; ?>
        <div class="flex-1 p-6 transition-all md:ml-64">
            <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-6"> 

                <a href="daftarlaporin.php" class="hover:scale-105 transform transition duration-300 block">
                    <div class="p-6 bg-gradient-to-tr from-green-400 to-green-600 text-white shadow-xl rounded-xl text-center">
                        <div class="text-5xl font-bold mb-2">
                            <?php echo $totalLaporan; ?>
                        </div>
                        <div class="text-lg font-semibold tracking-wide">
                            Laporan Masuk <i class="fa-solid fa-pen-to-square"></i>
                        </div>
                    </div>
                </a>


                <a href="daftarinstansi.php" class="hover:scale-105 transform transition duration-300 block">
                    <div class="p-6 bg-gradient-to-tr from-orange-400 to-orange-600 text-white shadow-xl rounded-xl text-center">
                        <div class="text-5xl font-bold mb-2">
                            <?php echo $totalInstansi; ?>
                        </div>
                        <div class="text-lg font-semibold tracking-wide">
                            Instansi Terdaftar <i class="fa-solid fa-building"></i>
                        </div>
                    </div>
                </a>

                <a href="profiluser.php" class="hover:scale-105 transform transition duration-300 block">
                    <div class="p-6 bg-gradient-to-tr from-yellow-400 to-yellow-600 text-white shadow-xl rounded-xl text-center">
                        <div class="text-5xl font-bold mb-2">
                            <?php echo $totalUser; ?>
                        </div>
                        <div class="text-lg font-semibold tracking-wide">
                            User Aktif <i class="fa-solid fa-users"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </body>
</html>