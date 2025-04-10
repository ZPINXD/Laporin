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

// Data untuk Pie Chart berdasarkan Instansi
$instansiData = [];
$queryInstansi = mysqli_query($conn, "SELECT i.nama_instansi, COUNT(l.id_laporan) as jumlah 
    FROM laporan l 
    JOIN instansi i ON l.instansi = i.id_instansi 
    GROUP BY l.instansi");

while ($row = mysqli_fetch_assoc($queryInstansi)) {
    $instansiData[$row['nama_instansi']] = $row['jumlah'];
}
$instansiLabels = json_encode(array_keys($instansiData));
$instansiCounts = json_encode(array_values($instansiData));


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
        <div class="bg-white p-6 w-full max-w-3xl mx-auto rounded-xl shadow-md">
            <h2 class="text-xl font-bold text-center mb-4">Tren Jumlah Laporan 3 Bulan Terakhir</h2>
            <div class="relative h-64">
                <canvas id="lineChart" class="w-full h-full"></canvas>
            </div>
        </div>
    </div>
    <!-- Grafik Pie Instansi -->
    <div class="mt-10 flex justify-center">
        <div class="bg-white p-6 rounded-xl shadow-md w-full  mx-auto">
            <h2 class="text-xl font-bold text-center mb-4">Distribusi Laporan per Instansi</h2>
            <div class="relative flex justify-center">
            <canvas id="instansiChart" class="w-full max-w-[350px] h-auto"></canvas>
            </div>
        </div>
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
                    'rgba(239, 68, 68, 0.7)',
                    'rgba(250, 204, 21, 0.7)',
                     'rgba(59, 130, 246, 0.7)',
                     'rgba(34, 197, 94, 0.7)'
                ],
                borderColor: [
                    'rgba(239, 68, 68, 1)',
                    'rgba(250, 204, 21, 1)',
                     'rgba(59, 130, 246, 1)',
                     'rgba(34, 197, 94, 1)'
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


// Grafik Pie Instansi
const instansiCtx = document.getElementById('instansiChart').getContext('2d');
new Chart(instansiCtx, {
    type: 'pie',
    data: {
        labels: <?= $instansiLabels ?>,
        datasets: [{
            data: <?= $instansiCounts ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 159, 64, 0.7)',
                'rgba(34, 197, 94, 0.7)',
                'rgba(245, 158, 11, 0.7)'
            ],
            borderColor: 'rgba(255, 255, 255, 1)',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, // Agar bisa fleksibel terhadap ukuran container
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    font: {
                        size: window.innerWidth < 640 ? 10 : 14 // Responsive font size
                    },
                    padding: 12
                }
            },
            tooltip: {
                bodyFont: {
                    size: window.innerWidth < 640 ? 10 : 14 // Tooltip size juga disesuaikan
                }
            }
        }
    }
});



</script>


</body>
</html>
