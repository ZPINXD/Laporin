<?php
include 'database.php'; 

// Totalan data
$totalLaporan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM laporan"))['total'];
$totalInstansi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM instansi WHERE status = 'Aktif'"))['total'];
$totalUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM user WHERE status_user = 'Aktif'"))['total'];

// Data untuk Grafik Status
$dataStatus = [];
$queryStatus = mysqli_query($conn, "SELECT status, COUNT(*) as jumlah FROM laporan GROUP BY status");
while ($row = mysqli_fetch_assoc($queryStatus)) {
    $dataStatus[$row['status']] = $row['jumlah'];
}
$statusLabels = json_encode(array_keys($dataStatus));
$statusCounts = json_encode(array_values($dataStatus));

// Data untuk Grafik Bulanan
$labels = [];
$data = [];
$queryBulanan = "SELECT DATE_FORMAT(tanggal, '%M') AS bulan, COUNT(*) AS jumlah 
          FROM laporan 
          WHERE tanggal >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)
          GROUP BY MONTH(tanggal)
          ORDER BY MONTH(tanggal)";
$resultBulanan = mysqli_query($conn, $queryBulanan);
while ($row = mysqli_fetch_assoc($resultBulanan)) {
    $labels[] = $row['bulan'];
    $data[] = $row['jumlah'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include "layout/navbaradmin.php"; ?>

<div class="flex-1 p-6 transition-all md:ml-64 relative z-10">
    <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-6"> 
        <a href="daftarlaporin.php" class="hover:scale-105 transform transition duration-300 block">
            <div class="p-6 bg-gradient-to-tr from-green-400 to-green-600 text-white shadow-xl rounded-xl text-center">
                <div class="text-5xl font-bold mb-2"><?= $totalLaporan ?></div>
                <div class="text-lg font-semibold tracking-wide">Laporan Masuk <i class="fa-solid fa-pen-to-square"></i></div>
            </div>
        </a>
        <a href="daftarinstansi.php" class="hover:scale-105 transform transition duration-300 block">
            <div class="p-6 bg-gradient-to-tr from-orange-400 to-orange-600 text-white shadow-xl rounded-xl text-center">
                <div class="text-5xl font-bold mb-2"><?= $totalInstansi ?></div>
                <div class="text-lg font-semibold tracking-wide">Instansi Terdaftar <i class="fa-solid fa-building"></i></div>
            </div>
        </a>
        <a href="profiluser.php" class="hover:scale-105 transform transition duration-300 block">
            <div class="p-6 bg-gradient-to-tr from-yellow-400 to-yellow-600 text-white shadow-xl rounded-xl text-center">
                <div class="text-5xl font-bold mb-2"><?= $totalUser ?></div>
                <div class="text-lg font-semibold tracking-wide">User Aktif <i class="fa-solid fa-users"></i></div>
            </div>
        </a>
    </div>

   <!-- Grafik -->
<div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Grafik Status -->
    <div class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-xl font-bold text-center mb-4">Grafik Status Laporan</h2>
        <canvas id="statusChart"></canvas>
    </div>

    <!-- Grafik Bulanan -->
    <!-- Grafik Bulanan -->
<div class="bg-white p-6 w-full max-w-3xl mx-auto rounded-xl shadow-md">
    <h2 class="text-xl font-bold text-center mb-4">Tren Jumlah Laporan 3 Bulan Terakhir</h2>
    <div class="relative h-64">
        <canvas id="lineChart" class="w-full h-full"></canvas>
    </div>
</div>


<script>
    // Grafik Status
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'bar',
        data: {
            labels: <?= $statusLabels ?>,
            datasets: [{
                label: 'Jumlah Laporan',
                data: <?= $statusCounts ?>,
                backgroundColor: [
                    'rgba(34, 197, 94, 0.7)',
                    'rgba(250, 204, 21, 0.7)',
                    'rgba(239, 68, 68, 0.7)',
                    'rgba(59, 130, 246, 0.7)'
                ],
                borderColor: [
                    'rgba(34, 197, 94, 1)',
                    'rgba(250, 204, 21, 1)',
                    'rgba(239, 68, 68, 1)',
                    'rgba(59, 130, 246, 1)'
                ],
                borderWidth: 1,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: {
                    ticks: {
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: {
                            size: 14
                        }
                    }
                }
            }
        }
    });

    // Grafik Bulanan
    const bulananCtx = document.getElementById('lineChart').getContext('2d');
    new Chart(bulananCtx, {
        type: 'line',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{
                label: 'Jumlah Laporan',
                data: <?= json_encode($data) ?>,
                borderColor: 'rgba(12, 119, 12, 1)',
                backgroundColor: 'rgba(12, 119, 12, 0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: {
                    ticks: {
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: 14
                        }
                    }
                }
            }
        }
    });
</script>


</body>
</html>
