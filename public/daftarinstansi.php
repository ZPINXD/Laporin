<?php 
include_once ("database.php");
$query = "SELECT * FROM instansi";
$hasil = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function confirmSubmit() {
            return confirm("Apakah Anda yakin ingin menyimpan perubahan?");
        }
    </script>
</head>
<body class="bg-gray-100">

<?php include "layout/navbaradmin.php"; ?>

<div id="content" class="flex-1 p-6 transition-all md:ml-64 flex flex-col justify-center items-center">
    <h2 class="text-3xl font-bold text-orange-700 mb-6">Daftar instansi</h2>

    <div class="w-full max-w-5xl">
        <div id="button_tambah" class="flex justify-end mb-4">
            <a href="tambahinstansi.php" class="bg-green-600 text-white px-4 py-2 rounded-lg text-l focus:outline-none hover:bg-green-700">
            Tambah <i class="fa-solid fa-plus"></i> 
            </a>
        </div>

        <form action="prosesubahstatus.php" method="POST" onsubmit="return confirmSubmit()">
    <div class="overflow-x-auto bg-white shadow-lg">
        <table class="w-full text-sm text-left border border-orange-700">
            <thead class="bg-orange-700 text-white text-base">
                <tr>
                    <th class="px-6 py-4">ID instansi</th>
                    <th class="px-6 py-4">Nama instansi</th>
                    <th class="px-6 py-4">Informasi Kontak</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-20 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody id="adminTableBody" class="bg-white divide-y divide-orange-200">
                <?php while ($data = mysqli_fetch_array($hasil)) { ?>
                    <tr class="hover:bg-orange-100 transition-all">
                        <td class="px-6 py-4"><?php echo $data['id_instansi']; ?></td>
                        <td class="px-6 py-4"><?php echo $data['nama_instansi']; ?></td>
                        <td class="px-6 py-4"><?php echo $data['Kontak']; ?></td>
                        <td class="px-6 py-4">
                            <select name="status[<?php echo $data['id_instansi']; ?>]" class="status-dropdown text-sm w-full px-2 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none">
                                <option value="Aktif" <?php if ($data['status'] == 'Aktif') echo 'selected'; ?>>Aktif</option>
                                <option value="Nonaktif" <?php if ($data['status'] == 'Nonaktif') echo 'selected'; ?>>Nonaktif</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="ubahinstansi.php?id=<?php echo $data['id_instansi']; ?>" 
                            class="bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-yellow-600 transition-all">
                            <i class="fa-regular fa-pen-to-square"></i> Edit 
                            </a>
                            <a href="hapusinstansi.php?id=<?php echo $data['id_instansi']; ?>"  
                            class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-600 transition-all"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus instansi ini?')">
                            <i class="fa-solid fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="w-full mt-5 max-w-5xl">
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
