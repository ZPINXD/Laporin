<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">

<div class="bg-white p-6 rounded-lg shadow-lg w-96">
    <h2 class="text-2xl font-bold text-center text-green-700 mb-4">Tambah Admin</h2>
    
    <form action="prosestambahadmin.php" method="POST">
        <label class="block font-semibold">Nama:</label>
        <input type="text" name="nama" class="w-full px-4 py-2 border rounded-lg mb-3" required>

        <label class="block font-semibold">Email:</label>
        <input type="text" name="email" class="w-full px-4 py-2 border rounded-lg mb-3" required>

        <label class="block font-semibold">Password:</label>
        <input type="password" id="password"name="password"  class="w-full px-4 py-2 border rounded-lg mb-3" required>
        <div class=" text-gray-500" >
                <input type="checkbox" onclick="togglePassword()"> Show password
            </div>
            <script>
                function togglePassword() {
                    var pass = document.getElementById("password");
                    if (pass.type === "password") {
                        pass.type = "text";
                    } else {
                        pass.type = "password";
                    }
                }
            </script>
        <div class="flex justify-between mt-5">
        <button type="submit" name="simpan" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Simpan</button>
            <a href="profiladmin.php" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Kembali</a>
        </div>
    </form>
</div>

</body>
</html>
