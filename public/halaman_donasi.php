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

// Fungsi export ke CSV
if (isset($_GET['export'])) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=riwayat_donasi.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, array('No', 'Nama', 'Judul Laporan', 'Jumlah Donasi', 'Pesan', 'Tanggal Donasi'));
    $no = 1;
    while ($data = mysqli_fetch_assoc($result)) {
        fputcsv($output, array($no++, $data['nama'], $data['judul'], $data['jumlah'], $data['pesan'], $data['tanggal']));
    }    
    fclose($output);
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Riwayat Donasi - LaporIn</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen mt-10">
<?php include "layout/navbar.html"; ?>

<main class="flex-grow">
    <h1 class="text-3xl font-bold text-center text-gray-800 mt-10 mb-8">Riwayat Donasi</h1>

    <div class="w-full max-w-4xl mx-auto bg-white p-6 rounded-2xl shadow-md">
        <table id="donasiTable" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Donatur</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Laporan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nominal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pesan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php $no = 1; while($row = $result->fetch_assoc()): ?>
                        <tr class="text-center border-b">
                            <td class="px-4 py-2"><?= $no++ ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($row['nama']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($row['judul']) ?></td>
                            <td class="px-4 py-2"><?= number_format($row['jumlah'], 0, ',', '.') ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($row['pesan']) ?></td>
                            <td class="px-4 py-2"><?= $row['tanggal'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">Belum ada donasi.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="flex justify-center mt-6 text-center mb-6">
            <a href="lapor.php" class="inline-block bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition">Donasi Lagi</a>
        </div>

        <button onclick="generatePDF()" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4">
            Export PDF
        </button>
    </div>
</main>

<?php include "layout/footer.html"; ?>

<!-- jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<!-- AutoTable plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>
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
