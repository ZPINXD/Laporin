<?php 
include_once ("database.php");

// Ambil data dari tabel laporan
$query = "SELECT laporan.*, user.username, instansi.nama_instansi
FROM laporan 
LEFT JOIN user ON laporan.id_user = user.id_user
LEFT JOIN instansi ON laporan.instansi = instansi.id_instansi";
;
$hasil = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Laporan</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function confirmSubmit() {
            return confirm("Apakah Anda yakin ingin menyimpan perubahan?");
        }
    </script>
</head>
<body class="bg-gray-100">

<?php include "layout/navbaradmin.php"; ?>

<form action="prosesubahstatuslaporan.php" method="POST" onsubmit="return confirmSubmit()">
<div id="content" class="flex-1 p-6 transition-all md:ml-64 flex flex-col justify-center items-center">
     <h2 class="text-3xl font-bold text-orange-700 mb-6">Daftar Laporan</h2>
<div class="overflow-x-auto w-full bg-white shadow-lg">
    <table class="w-full min-w-full text-sm text-left border border-orange-700">
        <thead class="bg-orange-700 text-white text-base">
            <tr>
                <th class="px-4 py-4">ID</th>
                <th class="px py-4">User </th>
                <th class="px-4 py-4">Nama</th>
                <th class="px-4 py-4">Judul</th>
                <th class="px-4 py-4">Isi</th>
                <th class="px-4 py-4">Tanggal</th>
                <th class="px-4 py-4">Lokasi</th>
                <th class="px-4 py-4">Instansi</th>
                <th class="px-4 py-4">Kategori</th>
                <th class="px-4 py-4">Lampiran</th>
                <th class="px-4 py-4">Privasi</th>
                <th class="px-4 py-4">Status</th>
            </tr>
        </thead>
        <tbody id="laporanTableBody" class="bg-white divide-y divide-orange-200">
            <?php while ($data = mysqli_fetch_array($hasil)) { ?>
                <tr class="hover:bg-orange-100 transition-all">
                    <td class="px-4 py-4"><?php echo $data['id_laporan']; ?></td>
                    <td class="px-4 py-4">
                        <?php echo ($data['privasi'] == 'publik') ? $data['id_user'] : '-'; ?>
                    </td>
                    <td class="px-4 py-4">
                    <?php echo ($data['privasi'] == 'publik') ? $data['username'] : '-'; ?>
                
                </td>
                    <td class="px-4 py-4"><?php echo htmlspecialchars($data['judul']); ?></td>
                    <td class="px-4 py-4 break-words whitespace-normal"><?php echo htmlspecialchars($data['isi']); ?></td>
                    <td class="px-4 py-4"><?php echo $data['tanggal']; ?></td>
                    <td class="px-4 py-4"><?php echo htmlspecialchars($data['lokasi']); ?></td>
                    <td class="px-4 py-4"><?php echo htmlspecialchars($data['nama_instansi']); ?></td>
                    <td class="px-4 py-4"><?php echo htmlspecialchars($data['kategori']); ?></td>
                    <td class="px-4 py-4">
                        <?php if (!empty($data['lampiran'])): ?>
                            <a href="lihat_lampiran.php?id=<?php echo $data['id_laporan']; ?>" 
                            target="_blank" 
                            class="text-blue-700 underline">
                                Lihat Lampiran
                            </a>
                        <?php else: ?>
                            <span class="text-gray-500">Tidak ada lampiran</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-4">
                        <?php echo ($data['privasi'] == 'Publik') ? 
                            '<span class="text-green-600 font-semibold">Publik</span>' : 
                            '<span class="text-red-600 font-semibold">Anonymous</span>'; 
                        ?>
                    </td>
                    <td class="px-2 py-2">
                        <select name="status[<?php echo $data['id_laporan']; ?>]" class="status-dropdown text-sm w-full px-2 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none">
                            <option value="Pending" <?php if ($data['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                            <option value="Diproses" <?php if ($data['status'] == 'Diproses') echo 'selected'; ?>>Diproses</option>
                            <option value="Selesai" <?php if ($data['status'] == 'Selesai') echo 'selected'; ?>>Selesai</option>
                            <option value="Batal" <?php if ($data['status'] == 'Batal') echo 'selected'; ?>>Batal</option>
                        </select>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</form>

        <div class="w-full mt-5 ">
            <div id="button_simpan" class="flex mb-4">
                <button type="submit" class="bg-orange-600 text-white px-4 py-2 rounded-lg text-l focus:outline-none hover:bg-orange-700">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan
                </button>
            </div>
        </div>
    </form>
</div>

</body>
</html>
