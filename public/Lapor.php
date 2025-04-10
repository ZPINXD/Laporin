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
</head>
<body class="bg-gray-100">

<?php include "layout/navbar.html"; ?>

<section class="container mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold text-teal-700 mb-6 mt-10">Laporan Publik</h1>

    <?php if ($result->num_rows > 0): ?>
        <div class="space-y-6">
            
            <?php while ($row = $result->fetch_assoc()):
                $nama = ($row['privasi'] == 'Anonim') ? 'Anonim' : $row['username'];
                $status = strtolower($row['status'] ?? '');
                $bgColor = ($status == 'selesai') ? 'bg-green-100 border-green-300' : 'bg-white border-gray-200';
                $showCheck = ($status == 'selesai');
                $isBencanaAlam = ($row['kategori'] == 'Bencana Alam');
                $isActiveDonasi = ($status == 'diproses' || $status == 'selesai') && $isBencanaAlam;
                $disabledClass = $isActiveDonasi ? '' : 'opacity-50 cursor-not-allowed';
            ?>
                <div class="rounded-lg shadow-md p-6 mb-6 border hover:shadow-lg transition-shadow duration-300 <?php echo $bgColor; ?>">
                    <!-- Header: Avatar + Nama + Tanggal + (Centang jika selesai) -->
                    <span class="px-2 py-1 text-xs rounded bg-green-200 text-green-800"><?php echo ucfirst($status); ?></span>

                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold">
                                <span><?php echo strtoupper(substr($nama, 0, 1)); ?></span>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800"><?php echo $nama; ?></p>
                                <p class="text-sm text-gray-500"><?php echo date("d M Y", strtotime($row['tanggal'])); ?></p>
                            </div>
                        </div>
                        <?php if ($showCheck): ?>
                            <div class="text-green-600" title="Laporan selesai">
                                ✅
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Judul -->
                    <h2 class="text-xl font-bold text-teal-700 mb-2"><?php echo htmlspecialchars($row['judul']); ?></h2>

                    <!-- Isi -->
                    <p class="text-gray-700 mb-4"><?php echo nl2br(htmlspecialchars($row['isi'])); ?></p>

                    <!-- Info Tambahan -->
                    <div class="grid md:grid-cols-2 text-sm text-gray-600 gap-1">
                        <p><strong>Lokasi:</strong> <?php echo htmlspecialchars($row['lokasi']); ?></p>
                        <p><strong>Instansi:</strong> <?php echo htmlspecialchars($row['nama_instansi']); ?></p>
                        <p><strong>Kategori:</strong> <?php echo htmlspecialchars($row['kategori']); ?></p>
                        <p><strong>Privasi:</strong> <?php echo htmlspecialchars($row['privasi']); ?></p>
                        <?php if (!empty($row['lampiran'])): ?>
                            <p><strong>Lampiran:</strong>
                                <a href="lihat_lampiran.php?id=<?php echo $row['id_laporan']; ?>" class="text-blue-500 hover:underline">Lihat 📎</a>
                            </p>
                        <?php endif; ?>
                    </div>
                        
                    <!-- Tombol Donasi -->
                    <?php if ($isBencanaAlam): ?>
                        <div class="mt-4">
                            <a href="form_donasi.php?id_laporan=<?php echo $row['id_laporan']; ?>" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded <?php echo $disabledClass; ?>" <?php echo !$isActiveDonasi ? 'disabled' : ''; ?>>
                                Donasi Sekarang
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="text-gray-500">Belum ada laporan publik yang masuk.</p>
    <?php endif; ?>
</section>

<?php include "layout/footer.html"; ?>
</body>
</html>

<?php $conn->close(); ?>
