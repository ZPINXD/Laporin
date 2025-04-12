<?php 
include_once ("database.php");
$query = "SELECT * FROM user";
$hasil = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil User</title>
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function confirmSubmit() {
            return confirm("Apakah Anda yakin ingin menyimpan perubahan?");
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

<?php include "layout/navbaradmin.php"; ?>

<div id="content" class="flex-1 p-4 sm:p-6 md:p-8 lg:p-10 xl:p-12 transition-all md:ml-64 flex flex-col items-center">
    <h2 class="text-2xl sm:text-3xl font-bold text-orange-700 mb-6 text-center">Daftar User</h2>

    <form action="prosesubahstatususer.php" method="POST" onsubmit="return confirmSubmit()" class="w-full">
        <div class="w-full overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full text-sm text-left border border-orange-700">
                <thead class="bg-orange-700 text-white text-sm sm:text-base">
                    <tr>
                        <th class="px-4 py-3">User ID</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">No.Telp</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Jenis Kelamin</th>
                        <th class="px-4 py-3">Alamat</th>
                        <th class="px-4 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php while ($data = mysqli_fetch_array($hasil)) { ?>
                        <tr class="hover:bg-orange-100 transition">
                            <td class="px-4 py-3"><?php echo $data['id_user']; ?></td>
                            <td class="px-4 py-3"><?php echo $data['username']; ?></td>
                            <td class="px-4 py-3"><?php echo $data['no_telp']; ?></td>
                            <td class="px-4 py-3"><?php echo $data['email']; ?></td>
                            <td class="px-4 py-3"><?php echo $data['jenis_kelamin']; ?></td>
                            <td class="px-4 py-3"><?php echo $data['alamat']; ?></td>
                            <td class="px-4 py-3">
                                <select name="status[<?php echo $data['id_user']; ?>]" 
                                        class="text-sm w-full px-2 py-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none">
                                    <option value="Aktif" <?php if ($data['status_user'] == 'Aktif') echo 'selected'; ?>>Aktif</option>
                                    <option value="Nonaktif" <?php if ($data['status_user'] == 'Nonaktif') echo 'selected'; ?>>Nonaktif</option>
                                </select>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="w-full mt-6 flex">
            <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan
            </button>
        </div>
    </form>
</div>

</body>
</html>
