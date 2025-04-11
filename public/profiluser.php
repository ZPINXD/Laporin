<?php 
include_once ("database.php");
$query = "SELECT * FROM user";
$hasil = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil User</title>
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
    <h2 class="text-3xl font-bold text-orange-700 mb-6">Daftar User</h2>

    <form action="prosesubahstatususer.php" method="POST" onsubmit="return confirmSubmit()"> 
        <div class="w-full max-w-5xl">
            <div class="overflow-x-auto bg-white shadow-lg">
                
                <table class="w-full text-sm text-left border border-orange-700">
                    <thead class="bg-orange-700 text-white text-base">
                        <tr>
                            <th class="px-2 py-4">User ID</th>
                            <th class="px-6 py-4">Nama</th>
                            <th class="px-6 py-4">No.Telp</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Jenis kelamin</th>
                            <th class="px-6 py-4">Alamat</th>
                            <th class="px-20 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody id="adminTableBody" class="bg-white divide-y divide-green-200">
                        <?php while ($data = mysqli_fetch_array($hasil)) { ?>
                            <tr class="hover:bg-orange-100 transition-all">
                                <td class="px-6 py-4"><?php echo $data['id_user']; ?></td>
                                <td class="px-6 py-4"><?php echo $data['username']; ?></td>
                                <td class="px-6 py-4"><?php echo $data['no_telp']; ?></td>
                                <td class="px-6 py-4"><?php echo $data['email']; ?></td>
                                <td class="px-6 py-4"><?php echo $data['jenis_kelamin']; ?></td>
                                <td class="px-6 py-4"><?php echo $data['alamat']; ?></td>
                                <td class="px-6 py-4">
                                    <select name="status[<?php echo $data['id_user']; ?>]" class="status-dropdown text-sm w-full px-2 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none">
                                        <option value="Aktif" <?php if ($data['status_user'] == 'Aktif') echo 'selected'; ?>>Aktif</option>
                                        <option value="Nonaktif" <?php if ($data['status_user'] == 'Nonaktif') echo 'selected'; ?>>Nonaktif</option>
                                    </select>
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
        </div>
    </form>
</div>

</body>
</html>