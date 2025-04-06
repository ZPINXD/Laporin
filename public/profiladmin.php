<?php 
include_once ("database.php");
$query = "SELECT * FROM admin";
$hasil = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin</title>
    <link rel="stylesheet" href="css/style.css">    
</head>
<body class="bg-gray-100">

<?php include "layout/navbaradmin.php"; ?>

<div id="content" class="flex-1 p-6 transition-all md:ml-64 flex flex-col justify-center items-center">
    <h2 class="text-3xl font-bold text-black mb-6">Daftar Admin</h2>

    <div class="w-full max-w-5xl">
        <div id="button_tambah" class="flex justify-end mb-4">
            <a href="tambahadmin.php" class="bg-green-600 text-white px-4 py-2 rounded-lg text-l focus:outline-none hover:bg-green-700">
            Tambah <i class="fa-solid fa-plus"></i> 
            </a>
        </div>

        <div class="overflow-x-auto bg-white shadow-lg">
            <table class="w-full text-sm text-left border border-black">
                <thead class="bg-black text-white text-base">
                    <tr>
                        <th class="px-6 py-4">User ID</th>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-20 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody id="adminTableBody" class="bg-white divide-y divide-black">
                    <?php while ($data = mysqli_fetch_array($hasil)) { ?>
                        <tr class="hover:bg-gray-100 transition-all">
                            <td class="px-6 py-4"><?php echo $data['id_admin']; ?></td>
                            <td class="px-6 py-4"><?php echo $data['nama']; ?></td>
                            <td class="px-6 py-4"><?php echo $data['email']; ?></td>
                            <td class="px-6 py-4 flex space-x-2">
                                <a href="ubahadmin.php?id=<?php echo $data['id_admin']; ?>" 
                                class="bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-yellow-600 transition-all">
                                <i class="fa-regular fa-pen-to-square"></i> Edit 
                                </a>
                                <a href="hapusadmin.php?id=<?php echo $data['id_admin']; ?>" 
                                class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-600 transition-all">
                                <i class="fa-solid fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
