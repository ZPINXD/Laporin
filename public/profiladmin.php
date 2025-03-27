<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiil Admin</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-gray-100">

<?php include "layout/navbaradmin.html"?>
<div id="content" class="flex-1 p-6 transition-all md:ml-64 flex flex-col justify-center items-center">
    <h2 class="text-3xl font-bold text-green-700 mb-6">Daftar Admin</h2>
    <div class="w-full max-w-5xl overflow-x-auto bg-white shadow-lg ">
        <table class="w-full text-sm text-left border border-green-700 ">
            <thead class="bg-green-700 text-white text-base rounded-t-lg">
                <tr>
                    <th class="px-6 py-4">User ID</th>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-20 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody id="adminTableBody" class="bg-white divide-y divide-green-200">
            </tbody>
        </table>
    </div>
</div>

<script>
    // Load data admin saat halaman dibuka
    function loadAdminData() {
        fetch("prosesloadadmin.php")
            .then(response => response.text())
            .then(data => {
                document.getElementById("adminTableBody").innerHTML = data;
                addEventListeners();
            })
            .catch(error => console.error("Error loading data:", error));
    }

    // Event listener untuk tombol edit dan delete
    function addEventListeners() {
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function () {
                let adminId = this.getAttribute("data-id");
                if (confirm("Apakah Anda yakin ingin menghapus admin ini?")) {
                    deleteAdmin(adminId);
                }
            });
        });

        document.querySelectorAll(".edit-btn").forEach(button => {
            button.addEventListener("click", function () {
                let adminId = this.getAttribute("data-id");
                alert("Fitur edit untuk admin ID " + adminId + " belum diimplementasikan.");
            });
        });
    }

    // Fungsi untuk menghapus admin
    function deleteAdmin(adminId) {
        fetch("delete_admin.php?id=" + adminId, { method: "GET" })
            .then(response => response.text())
            .then(data => {
                alert(data);
                loadAdminData();
            })
            .catch(error => console.error("Error deleting data:", error));
    }

    // Load data admin pertama kali
    loadAdminData();
</script>
</body>
</html>
