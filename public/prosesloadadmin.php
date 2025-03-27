<?php
include_once("database.php");

$sql = "SELECT * FROM admin";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr class='hover:bg-green-50 transition-all'>";
        echo "<td class='px-6 py-4'>" . $row["id_admin"] . "</td>";
        echo "<td class='px-6 py-4'>" . htmlspecialchars($row["nama"]) . "</td>";
        echo "<td class='px-6 py-4'>" . htmlspecialchars($row["email"]) . "</td>";
        echo "<td class='px-6 py-4 flex space-x-2'>";

        // Tombol Edit yang langsung mengarah ke ubahadmin.php
        echo "<a href='ubahadmin.php?id=" . $row["id_admin"] . "' class='bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-yellow-600 transition-all'>Edit</a>";

        // Tombol Hapus tetap menggunakan class delete-btn untuk JavaScript
        echo "<button class='bg-red-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-600 transition-all delete-btn' data-id='" . $row["id_admin"] . "'>Hapus</button>";

        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4' class='text-center py-4'>Tidak ada data admin</td></tr>";
}

$conn->close();
?>
