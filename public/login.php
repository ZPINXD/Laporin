<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<body >
<?php include "layout/navbar.html"?>

<!-- LOGIN -->

<div class="flex justify-center items-center h-screen ">
        <div class="w-96 p-6 shadow-lg bg-white rounded-md">
            <h1 class="text-3xl block text-center font-semibold"><i class="fa-solid fa-user"></i> Login</h1>
            <hr class="mt-3">
            <form action="proseslogin.php" method="POST">
            <div class="mt-3">
                <label for="email" class="block text-base mb-2">Email</label>
                <input type="text" name="email" class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-gray-600" placeholder="Masukkan Email..." />
            </div>
            <div class="mt-3">
                <label for="password" class="block text-base mb-2">Password</label>
                <input type="password" id= "password" name="password" class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-gray-600" placeholder="Masukkan Password..." />
            </div>
            
            <div class="mt-3 text-gray-500" >
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
           
            <div class="mt-5">
            <?php
            if (isset($_SESSION['login_message'])) {
            echo "<p style='color: red;'>" . $_SESSION['login_message'] . "</p>";
            unset($_SESSION['login_message']); // Hapus pesan setelah ditampilkan
            }
            ?>
                <button type="submit" class="border-2 bg-orange-600 hover:bg-orange-700 text-white py-1 w-full rounded-md  font-semibold"><i class="fa-solid fa-right-to-bracket"></i>&nbsp;&nbsp;Login</button>
            </div>
            </form>
        </div>
    </div>
    
    <!-- Footer -->
    
</body>
<?php include "layout/footer.html"?>
</html>