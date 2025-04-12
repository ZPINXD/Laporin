<?php
session_start();
include_once("database.php");

// Ambil kategori dan instansi dari URL (GET parameter)
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';
$instansi = isset($_GET['instansi']) ? $_GET['instansi'] : '';
// Query laporan & instansi & user
$sql = "SELECT laporan.*, user.username, instansi.nama_instansi 
        FROM laporan 
        LEFT JOIN user ON laporan.id_user = user.id_user 
        LEFT JOIN instansi ON laporan.instansi = instansi.id_instansi 
        ORDER BY laporan.id_laporan DESC";
// Query laporan dengan filter kategori dan instansi
$sql = "SELECT laporan.*, user.username, instansi.nama_instansi 
        FROM laporan 
        LEFT JOIN user ON laporan.id_user = user.id_user 
        LEFT JOIN instansi ON laporan.instansi = instansi.id_instansi 
        WHERE 1";

// Menambahkan filter berdasarkan kategori jika dipilih
if ($kategori) {
    $sql .= " AND laporan.kategori = '" . $conn->real_escape_string($kategori) . "'";
}

// Menambahkan filter berdasarkan instansi jika dipilih
if ($instansi) {
    $sql .= " AND instansi.nama_instansi = '" . $conn->real_escape_string($instansi) . "'";
}

$sql .= " ORDER BY laporan.id_laporan DESC";

// Eksekusi query
$result = $conn->query($sql);
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Laporan Publik</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body class="bg-gray-100">

<?php include "layout/navbar.html"; ?>

<section class="container mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-teal-700 mb-8 mt-10">Laporan Publik</h1>

    <?php if ($result->num_rows > 0): ?>
        <div class="space-y-6">
            
            <?php while ($row = $result->fetch_assoc()):
                $nama = ($row['privasi'] == 'Anonim') ? 'Anonim' : $row['username'];
                $status = strtolower($row['status'] ?? '');
                // Warna status dinamis
                $statusColor = match($status) {
                    'selesai' => 'bg-green-100 text-green-800',
                    'diproses' => 'bg-blue-100 text-blue-800',
                    'pending' => 'bg-yellow-100 text-yellow-800',
                    'batal' => 'bg-red-100 text-red-800',
                    default => 'bg-gray-100 text-gray-800'
                };
                $showCheck = ($status == 'selesai');
                $isBencanaAlam = ($row['kategori'] == 'Bencana Alam');
                $isActiveDonasi = ($status == 'diproses' || $status == 'selesai') && $isBencanaAlam;
            ?>
                <div class="rounded-lg shadow-md p-6 mb-6 border hover:shadow-lg transition-shadow duration-300 bg-white border-gray-200">
                    <!-- Header: Status dengan warna dan ukuran diperbesar -->
                    <span class="px-3 py-1.5 text-sm font-semibold rounded-full mb-4 inline-block <?php echo $statusColor; ?>">
                        <?php echo ucfirst($status); ?>
                    </span>

                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-teal-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                <span><?php echo strtoupper(substr($nama, 0, 1)); ?></span>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 text-lg"><?php echo $nama; ?></p>
                                <p class="text-gray-500"><?php echo date("d M Y", strtotime($row['tanggal'])); ?></p>
                            </div>
                        </div>
                        <?php if ($showCheck): ?>
                            <div class="text-green-600 text-2xl" title="Laporan selesai">
                            <i class="fa-solid fa-check fa-lg" style="color: #00ff4c;"></i>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Judul -->
                    <h2 class="text-xl font-bold text-teal-700 mb-3"><?php echo htmlspecialchars($row['judul']); ?></h2>

                    <!-- Isi -->
                    <p class="text-gray-700 mb-4 text-base leading-relaxed"><?php echo nl2br(htmlspecialchars($row['isi'])); ?></p>

                    <!-- Info Tambahan -->
                    <div class="grid md:grid-cols-2 text-base text-gray-600 gap-2 mb-4">
                        <p><strong class="text-teal-600">Lokasi:</strong> <?php echo htmlspecialchars($row['lokasi']); ?></p>
                        <p><strong class="text-teal-600">Instansi:</strong> <?php echo htmlspecialchars($row['nama_instansi']); ?></p>
                        <p><strong class="text-teal-600">Kategori:</strong> <?php echo htmlspecialchars($row['kategori']); ?></p>
                        <p><strong class="text-teal-600">Privasi:</strong> <?php echo htmlspecialchars($row['privasi']); ?></p>
                        <?php if (!empty($row['lampiran'])): ?>
                            <p><strong class="text-teal-600">Lampiran:</strong>
                                <a href="lihat_lampiran.php?id=<?php echo $row['id_laporan']; ?>" class="text-blue-500 hover:underline font-medium">Lihat 📎</a>
                            </p>
                        <?php endif; ?>
                    </div>
                        
                    <?php if ($isBencanaAlam && $isActiveDonasi): ?>
                        <div class="mt-4">
                            <?php if (isset($_SESSION['id_user'])): ?>
                                <a href="form_donasi.php?id_laporan=<?php echo $row['id_laporan']; ?>" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-200">
                                    🎗️ Donasi Sekarang
                                </a>
                            <?php else: ?>
                                <a href="login.php" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-200">
                                    🔒 Login untuk Donasi
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="text-gray-500 text-lg">Belum ada laporan publik yang masuk.</p>
    <?php endif; ?>
</section>

<?php include "layout/footer.html"; ?>
</body>
</html>