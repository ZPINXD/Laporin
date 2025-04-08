<?php
session_start();
include 'database.php';
$idUser = $_SESSION['id_user']; // contoh session user login
$query = "SELECT laporan.*, instansi.nama_instansi 
          FROM laporan 
          JOIN instansi ON laporan.instansi = instansi.id_instansi 
          WHERE laporan.id_user = '$idUser' 
          ORDER BY laporan.tanggal DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-gray-100">
    <div class="relative w-full h-[275px] overflow-hidden ">
        <?php include "layout/navbar.html"?>
        <section class="relative bg-cover bg-center text-white py-10 mt-16 text-center flex " style="background-image: url('Assets/bg about.png');">
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>   
            <div class="relative px-10 flex items-center gap-4">
                <img src="profile-pic.jpg" alt="Profile Picture" class="w-24 h-24 rounded-full border-2 border-white">
                <h1 class="text-3xl font-bold text-white">Profil</h1>
            </div>
        </section>
    </div>
    
    <div class="container flex px-4 md:px-8 py-5">
    <main class="w-full bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold mb-4">Daftar Laporan Saya</h2>
        <div class="space-y-4">
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <div class="bg-white shadow-md rounded-lg p-4 w-full border-l-4
                    <?php
                        switch ($row['status']) {
                            case 'Pending': echo 'border-gray-500'; break;
                            case 'Selesai': echo 'border-green-500'; break;
                            case 'Diproses': echo 'border-yellow-500'; break;
                            case 'Batal': echo 'border-red-500'; break;
                        }
                    ?>">
                    
                    <!-- Judul & Tanggal -->
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-lg font-bold text-gray-800">
                            <?php echo htmlspecialchars($row['judul']); ?>
                        </h3>
                        <span class="text-sm text-gray-500">
                            <?php echo date('d M Y', strtotime($row['tanggal'])); ?>
                        </span>
                    </div>

                    <!-- Isi -->
                    <p class="text-gray-700 mb-3">
                        <?php echo nl2br(htmlspecialchars($row['isi'])); ?>
                    </p>

                    <!-- Info tambahan -->
                    <div class="grid md:grid-cols-2 gap-2 text-sm text-gray-600 mb-3">
                        <div><strong>Lokasi:</strong> <?php echo htmlspecialchars($row['lokasi']); ?></div>
                        <div><strong>Instansi:</strong> <?php echo htmlspecialchars($row['nama_instansi']); ?></div>
                        <div><strong>Kategori:</strong> <?php echo htmlspecialchars($row['kategori']); ?></div>
                        <div><strong>Privasi:</strong> <?php echo htmlspecialchars($row['privasi']); ?></div>
                        <div><strong>Lampiran:</strong>
                            <?php if (!empty($row['lampiran'])): ?>
                                <a href="lihat_lampiran.php?id=<?php echo $row['id_laporan']; ?>" target="_blank" class="text-blue-600 hover:underline">
                                    Lihat Lampiran
                                </a>
                            <?php else: ?>
                                Tidak ada
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Status & Aksi -->
                    <div class="flex justify-between items-center">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                            <?php
                                switch ($row['status']) {
                                    case 'Pending': echo 'bg-gray-100 text-gray-700'; break;
                                    case 'Selesai': echo 'bg-green-100 text-green-700'; break;
                                    case 'Diproses': echo 'bg-yellow-100 text-yellow-700'; break;
                                    case 'Batal': echo 'bg-red-100 text-red-700'; break;
                                }
                            ?>">
                            Status: <?php echo $row['status']; ?>
                        </span>

                        <?php if ($row['status'] === 'Pending') : ?>
                            <form action="hapuslaporan.php" method="post" onsubmit="return confirm('Laporan yang akan ditarik tidak bisa kembali?');">
                                <input type="hidden" name="id_laporan" value="<?php echo $row['id_laporan']; ?>">
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white text-sm font-semibold py-1 px-3 rounded transition">
                                    Tarik laporan
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </main>
</div>


</body>
</html>