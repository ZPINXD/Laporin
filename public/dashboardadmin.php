
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-gray-100">

    <?php include "layout/navbaradmin.php"?>

    <!-- Konten Utama -->
    <div id="content" class="flex-1 p-6 transition-all md:ml-64 flex flex-col justify-center items-center h-screen text-center">
    <h1 class="text-2xl font-bold transition-all">Dashboard Admin <span class="text-orange-500">Lapor.in</span></h1>
    <p  class="text-gray-700 transition-all">Selamat Datang <?= isset($_SESSION["nama"]) ? htmlspecialchars($_SESSION["nama"]) : "" ?> </p>
</div>
</body>
</html>
