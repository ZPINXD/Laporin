<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-3xl">
        <h1 class="text-2xl font-bold mb-4">Register</h1>
        <div class="flex justify-between mb-4">
            <div class="w-1/2 pr-2">
                <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                <input type="text" id="nik" placeholder="Nomor Induk Kependudukan (KTP)"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
            <div class="w-1/2 pl-2">
                <label for="fullName" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" id="fullName" placeholder="Nama Lengkap"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
        </div>
        
        <div class="flex justify-between mb-4">
            <div class="w-1/2 pr-2">
                <label for="address" class="block text-sm font-medium text-gray-700">Tempat Tinggal Saat Ini</label>
                <input type="text" id="address" placeholder="Ketikan Tempat Tinggal Saat Ini"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
            <div class="w-1/2 pl-2">
                <label for="dob" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                <input type="date" id="dob"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
        </div>

        <div class="flex justify-between mb-4">
            <div class="w-1/2 pr-2">
                <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <select id="gender" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="male">Laki-Laki</option>
                    <option value="female">Perempuan</option>
                </select>
            </div>
            <div class="w-1/2 pl-2">
                <label for="phone" class="block text-sm font-medium text-gray-700">No. Telp Aktif</label>
                <input type="tel" id="phone" placeholder="Minimal 8-14 Angka"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
        </div>

        <div class="flex justify-between mb-4">
            <div class="w-1/2 pr-2">
                <label for="job" class="block text-sm font-medium text-gray-700">Pekerjaan</label>
                <select id="job" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                    <option value="">Pilih Pekerjaan</option>
                    <option value="student">Pelajar/Mahasiswa</option>
                    <option value="employed">Karyawan</option>
                </select>
            </div>
            <div class="w-1/2 pl-2">
                <label for="disability" class="block text-sm font-medium text-gray-700">Penyandang Disabilitas?</label>
                <select id="disability" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                    <option value="">Pilih Status</option>
                    <option value="yes">Ya</option>
                    <option value="no">Tidak</option>
                </select>
            </div>
        </div>

        <div class="flex justify-between mb-4">
            <div class="w-1/2 pr-2">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="username" placeholder="Username"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
            <div class="w-1/2 pl-2">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" placeholder="example@domain.com"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
        </div>

        <div class="flex justify-between mb-4">
            <div class="w-1/2 pr-2">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" placeholder="********"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                <p class="text-xs text-gray-500">Minimal 8 karakter dan harus berisi kombinasi huruf kapital, huruf kecil, angka dan karakter khusus (@$!%*?&).</p>
            </div>
            <div class="w-1/2 pl-2">
                <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Password Confirmation</label>
                <input type="password" id="confirmPassword" placeholder="********"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
        </div>

        <div class="flex items-center mb-4">
            <input type="checkbox" id="addThirdParty" class="mr-2">
            <label for="addThirdParty" class="text-sm">Apakah Anda ingin menambahkan pihak yang dapat dikonfirmasi?</label>
        </div>

        <div class="flex items-center mb-4">
            <input type="checkbox" id="terms" class="mr-2" required>
            <label for="terms" class="text-sm">Saya telah membaca dan menyetujui Syarat dan Ketentuan Layanan</label>
        </div>

        <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg">DAFTAR</button>
    </div>

</body>

</html>