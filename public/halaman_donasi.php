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
</head>
<body class="bg-gray-100 flex flex-col min-h-screen mt-10">
<?php include "layout/navbar.html"; ?>

<main class="flex-grow">
    <h1 class="text-3xl font-bold text-center text-gray-800 mt-10 mb-8">Riwayat Donasi</h1>

    <div class="w-full max-w-5xl mx-auto bg-white p-6 rounded-2xl shadow-md">
        <table id="donasiTable" class="table-fixed w-full text-sm divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr class="text-center">
                    <th class="w-[5%] px-4 py-3">No</th>
                    <th class="w-[20%] px-4 py-3">Nama Donatur</th>
                    <th class="w-[25%] px-4 py-3">Judul Laporan</th>
                    <th class="w-[15%] px-4 py-3">Nominal</th>
                    <th class="w-[25%] px-4 py-3">Pesan</th>
                    <th class="w-[10%] px-4 py-3">Tanggal</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php if ($result->num_rows > 0): ?>
                    <?php $no = 1; while($row = $result->fetch_assoc()): ?>
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2"><?= $no++ ?></td>
                            <td class="px-4 py-2 font-semibold text-gray-700"><?= htmlspecialchars($row['nama']) ?></td>
                            <td class="px-4 py-2 text-gray-600"><?= htmlspecialchars($row['judul']) ?></td>
                            <td class="px-4 py-2">
                                <span class="inline-block bg-green-100 text-green-800 text-sm px-2 py-1 rounded">
                                    Rp <?= number_format($row['jumlah'], 0, ',', '.') ?>
                                </span>
                            </td>
                            <td class="px-4 py-2 italic text-gray-500"><?= htmlspecialchars($row['pesan']) ?></td>
                            <td class="px-4 py-2 text-gray-600"><?= date("d M Y", strtotime($row['tanggal'])) ?></td>
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

        <!-- Export PDF Button di pojok kiri bawah -->
        <div class="flex justify-start mt-4">
            <button onclick="generatePDF()" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
                Export PDF
            </button>
        </div>
    </div>
</main>

<?php include "layout/footer.html"; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
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
