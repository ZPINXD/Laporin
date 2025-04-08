<?php
session_start();
include "database.php"; // File koneksi database

// Pastikan user sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php"); // Redirect jika tidak login
    exit();
}

$user_id = $_SESSION['id_user'];

// Ambil data user dari database
$query = "SELECT username, password,no_telp,email, jenis_kelamin,alamat FROM user WHERE id_user = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-gray-100">
    <div class="relative w-full h-[275px] overflow-hidden ">
        <?php include "layout/navbar.html"?>
        <section class="relative bg-cover bg-center text-white py-10 mt-16 text-center flex " style="background-image: url('Assets/bg about.png');">
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>   
            <div class="relative px-10 flex items-center gap-4">
                <img src="profile-pic.jpg" alt="Profile Picture" class="w-24 h-24 rounded-full border-2 border-white">
                <h1 class="text-3xl font-bold text-white">Profil</h1>
            </div>
        </section>
    </div>
    
    <div class="container flex gap-6 p-6">
        <!-- Sidebar -->
        <aside class="w-1/6 bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-4">Aksi</h2>
            <button class="w-full bg-orange-600 font-semibold text-white py-2 rounded-lg hover:bg-orange-700 transition duration-200" onclick="changeProfile()">Ubah profil</button>
            <button class="w-full bg-orange-600 font-semibold text-white py-2 rounded-lg hover:bg-orange-700 transition duration-200 mt-2" onclick="changePassword()">Ubah password</button>
        </aside>
        <div id="editProfileModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h2 class="text-lg font-semibold mb-4 text-orange-500">Edit Profil</h2>
                <form action="prosesubahprofil.php" method="POST">
                    <div class="mb-4">
                        <label class="block text-sm font-semibold">Nama</label>
                        <input type="text"  value="<?php echo htmlspecialchars($user['username']); ?>" name="nama" class="w-full p-2 border border-gray-300 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-semibold">Tempat Tinggal</label>
                        <input type="text" value="<?php echo htmlspecialchars($user['alamat']); ?>" name="tempat" class="w-full p-2 border border-gray-300 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-semibold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full p-2 border border-gray-300 rounded">
                            <option value="Laki-laki" <?php echo ($user['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                            <option value="Perempuan" <?php echo ($user['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold">No. Telp</label>
                        <input type="tel" value="<?php echo htmlspecialchars($user['no_telp']); ?>" name="no" class="w-full p-2 border border-gray-300 rounded" readonly>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-semibold">Email</label>
                        <input type="email" value="<?php echo htmlspecialchars($user['email']); ?>" name="email" class="w-full p-2 border border-gray-300 rounded focus:outline-none" readonly>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Batal</button>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-500">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div id="editPassModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h2 class="text-lg font-semibold mb-4 text-red-600">Edit Password</h2>
                <form action="prosesubahpassprofil.php" method="POST">
                    <div class="mb-4">
                        <label class="block text-sm font-semibold">Password sebelumnya</label>
                        <input type="password" id="pass1" name="pass_old" class="w-full p-2 border border-gray-300 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-semibold">Password baru</label>
                        <input type="password" id="pass2" name="pass_new" class="w-full p-2 border border-gray-300 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold">Konfirmasi password</label>
                        <input type="password" id="pass3" name="pass_conf" class="w-full p-2 border border-gray-300 rounded" required>
                        <input type="checkbox" onclick="togglePassword()"> Show password
                     </div>
               
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeModal2()" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Batal</button>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-500">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <script>
            function togglePassword() {
            var pass1 = document.getElementById("pass1");
            var pass2 = document.getElementById("pass2");
            var pass3 = document.getElementById("pass3");
            if (pass1.type === "password" && pass2.type === "password"  && pass2.type === "password" ) {
                pass1.type = "text";
                pass2.type = "text";
                pass3.type = "text";
            } else {
                pass1.type = "password";
                pass2.type = "password";
                pass3.type = "password";
            }
        }
        </script>
        <!-- Main Content -->
        <main class="w-3/4 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-4">Informasi personal</h2>
            <div class="space-y-2">
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Nama</label>
                    <input type="text" value="<?php echo htmlspecialchars($user['username']); ?>" name="nama" class="w-full p-2 border border-gray-300 rounded font-semibold" readonly>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Tempat Tinggal Saat Ini</label>
                    <input type="text" value="<?php echo htmlspecialchars($user['alamat']); ?>" name="tempat" class="w-full p-2 border border-gray-300 rounded font-semibold" readonly>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Jenis Kelamin</label>
                    <input type="text" value="<?php echo htmlspecialchars($user['jenis_kelamin']); ?>" name="jenis_kelamin" class="w-full p-2 border border-gray-300 rounded font-semibold" readonly>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">No. Telp Aktif</label>
                    <input type="tel" value="<?php echo htmlspecialchars($user['no_telp']); ?>" name="no" class="w-full p-2 border border-gray-300 rounded font-semibold" readonly>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Email</label>
                    <input type="email" value="<?php echo htmlspecialchars($user['email']); ?>" name="email" class="w-full p-2 border border-gray-300 rounded focus:outline-none font-semibold" readonly>
                </div>
            </div>
        </main>
    </div>

    

    <script>
        function changeProfile() {
            document.getElementById("editProfileModal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("editProfileModal").classList.add("hidden");
        }

        function changePassword() {
            document.getElementById("editPassModal").classList.remove("hidden");
        }

        function closeModal2() {
            document.getElementById("editPassModal").classList.add("hidden");
        }
    </script>
</body>
</html>
