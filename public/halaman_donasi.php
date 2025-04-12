<?php
session_start();
$email = $_SESSION['email'];
include 'database.php';

$query = "SELECT d.nama, d.jumlah, d.pesan, d.tanggal, l.judul
          FROM donasi d 
          JOIN laporan l ON d.id_laporan = l.id_laporan 
          WHERE d.email = ?
          ORDER BY d.tanggal DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Riwayat Donasi - LaporIn</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen mt-10">
<?php include "layout/navbar.html"; ?>

<main class="flex-grow px-4">
    <h1 class="text-2xl sm:text-3xl font-bold text-center text-gray-800 mt-10 mb-6">Riwayat Donasi</h1>

    <div class="w-full max-w-6xl mx-auto bg-white p-4 sm:p-6 rounded-2xl shadow-md overflow-x-auto">
        <table id="donasiTable" class="min-w-full text-sm divide-y divide-gray-200">
            <thead class="bg-gray-100 text-gray-700">
                <tr class="text-center">
                    <th class="px-2 sm:px-4 py-2 sm:py-3">No</th>
                    <th class="px-2 sm:px-4 py-2 sm:py-3">Nama Donatur</th>
                    <th class="px-2 sm:px-4 py-2 sm:py-3">Judul Laporan</th>
                    <th class="px-2 sm:px-4 py-2 sm:py-3">Nominal</th>
                    <th class="px-2 sm:px-4 py-2 sm:py-3">Pesan</th>
                    <th class="px-2 sm:px-4 py-2 sm:py-3">Tanggal</th>
                </tr>
            </thead>
            <tbody class="text-center text-gray-600">
                <?php if ($result->num_rows > 0): ?>
                    <?php $no = 1; while($row = $result->fetch_assoc()): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-2 sm:px-4 py-2"><?= $no++ ?></td>
                            <td class="px-2 sm:px-4 py-2 font-semibold"><?= htmlspecialchars($row['nama']) ?></td>
                            <td class="px-2 sm:px-4 py-2"><?= htmlspecialchars($row['judul']) ?></td>
                            <td class="px-2 sm:px-4 py-2">
                                <span class="inline-block bg-green-100 text-green-800 text-xs sm:text-sm px-2 py-1 rounded">
                                    Rp <?= number_format($row['jumlah'], 0, ',', '.') ?>
                                </span>
                            </td>
                            <td class="px-2 sm:px-4 py-2 italic"><?= htmlspecialchars($row['pesan']) ?></td>
                            <td class="px-2 sm:px-4 py-2"><?= date("d M Y", strtotime($row['tanggal'])) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">Belum ada donasi.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="flex flex-col sm:flex-row justify-between items-center mt-6 gap-4">
            <a href="lapor.php" class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition text-center">
                Donasi Lagi
            </a>
            <button onclick="generatePDF()" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
                Export PDF
            </button>
        </div>
    </div>
</main>

<?php include "layout/footer.html"; ?>

<script>
    function generatePDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        doc.text("Riwayat Donasi", 14, 15);
        doc.autoTable({
            html: '#donasiTable',
            startY: 20,
            styles: {
                fontSize: 10
            },
            headStyles: {
                fillColor: [22, 160, 133]
            }
        });

        doc.save("riwayat_donasi.pdf");
    }
</script>
</body>
</html>

<?php $conn->close(); ?>
