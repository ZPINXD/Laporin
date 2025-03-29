<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body >
	<?php include "layout/navbar.html"?>

<div class="bg-white rounded shadow-md max-w-4xl mx-auto p-8 mt-24">
    <h2 class="text-2xl font-bold mb-10 text-center"><i class="fa-solid fa-user px-2"></i>Daftar Akun</h2>
    <form action="prosesregister.php" method="POST">
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
        <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Nama</label>
                <input type="text" placeholder="Nama Lengkap" name="nama" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Tempat Tinggal Saat Ini</label>
                <input type="text" placeholder="Ketikan Tempat Tinggal Saat Ini" name="tempat" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Jenis Kelamin</label>
                <select class="w-full p-2 border border-gray-300 rounded" name="kelamin" required>
                    <option>Pilih Jenis Kelamin</option>
                    <option>Laki-laki</option>
                    <option>Perempuan</option>
                </select>
            </div>
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">No. Telp Aktif</label>
                <input type="tel" placeholder="Minimal 8-14 Angka" name="no" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Email</label>
                <input type="email" placeholder="lapor@contoh.com" name="email" class="w-full p-2 border border-gray-300 rounded focus:outline-none" required>
            </div>
            <div>
            <label class="block mb-2 text-sm font-semibold text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="p-2 border border-gray-300 rounded focus:outline-none" required>
            
            <p class="text-xs text-gray-500 mt-1">Minimal 8 karakter dan harus berisi kombinasi huruf kapital, huruf kecil, angka, dan karakter khusus (@$!%*?&).</p>
        </div>
        <div>
            <label class="block mb-2 text-sm font-semibold text-gray-700">Password Confirmation</label>
            <input type="password" id="password2" class="p-2 border border-gray-300 rounded" required>
            
        </div>
        <div class= "text-gray-500" >
        <input type="checkbox" onclick="togglePassword()"> Show Password
        </div>
       

        <script>
        function togglePassword() {
            var pass1 = document.getElementById("password");
            var pass2 = document.getElementById("password2");
            
            if (pass1.type === "password" && pass2.type === "password") {
                pass1.type = "text";
                pass2.type = "text";
            } else {
                pass1.type = "password";
                pass2.type = "password";
            }
        }
        </script>
        </div>
        <?php
            if (isset($_SESSION["register_message"])) {
            echo "<p style='color: red;'>" . $_SESSION["register_message"] . "</p>";
            unset($_SESSION["register_message"]); // Hapus pesan setelah ditampilkan
            }
        ?>
        <button type="submit" class="mt-6 rounded-full text-lg w-full focus:outline-none  bg-orange-600 hover:bg-orange-700 text-white py-2 "><i class="fa-solid fa-up-right-from-square"></i> DAFTAR</button>
    </form>
</div>
<!-- JavaScript buat handle error -->
<script>
    // Ambil elemen email & password
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");

    // Fungsi untuk tambah border merah kalau kosong
    const validateInput = (input) => {
        if (input.value.trim() === "") {
            input.classList.add("border-red-500");
        } else {
            input.classList.remove("border-red-500");
        }
    };

    // Event saat klik dan keluar dari input email
    emailInput.addEventListener("blur", () => validateInput(emailInput));
    passwordInput.addEventListener("blur", () => validateInput(passwordInput));

    // Cek ulang kalau submit
    document.getElementById("registerForm").addEventListener("submit", (e) => {
        validateInput(emailInput);
        validateInput(passwordInput);

        // Stop submit kalau ada field yang masih kosong
        if (emailInput.value.trim() === "" || passwordInput.value.trim() === "") {
            e.preventDefault();
            alert("Pastikan email dan password sudah terisi ya!");
        }
    });
</script>
<!-- Footer -->

</body>
<?php include "layout/footer.html"?>
</html>