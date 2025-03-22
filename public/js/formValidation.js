document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("laporanForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Mencegah pengiriman form jika ada error

        let isValid = true;

        function validateField(id, errorId) {
            const field = document.getElementById(id);
            const errorMessage = document.getElementById(errorId);
            if (!field.value.trim()) {
                errorMessage.classList.remove("hidden");
                isValid = false;
            } else {
                errorMessage.classList.add("hidden");
            }
        }

        validateField("judul", "error-judul");
        validateField("isi", "error-isi");
        validateField("tanggal", "error-tanggal");
        validateField("lokasi", "error-lokasi");
        validateField("instansi", "error-instansi");
        validateField("kategori", "error-kategori");

        // Validasi radio button (Anonim/Rahasia)
        const anonim = document.getElementById("anonim");
        const rahasia = document.getElementById("rahasia");
        const errorPrivacy = document.getElementById("error-privacy");

        if (!anonim.checked && !rahasia.checked) {
            errorPrivacy.classList.remove("hidden");
            isValid = false;
        } else {
            errorPrivacy.classList.add("hidden");
        }

        if (isValid) {
            alert("Laporan berhasil dikirim!");
            event.target.submit(); // Kirim form jika valid
        }
    });

    // Menghilangkan pesan error saat mulai mengetik
    function addInputListener(id, errorId) {
        document.getElementById(id).addEventListener("input", function () {
            document.getElementById(errorId).classList.add("hidden");
        });
    }

    addInputListener("judul", "error-judul");
    addInputListener("isi", "error-isi");
    addInputListener("tanggal", "error-tanggal");
    addInputListener("lokasi", "error-lokasi");
    addInputListener("instansi", "error-instansi");
    addInputListener("kategori", "error-kategori");

    document.getElementById("anonim").addEventListener("change", function () {
        document.getElementById("error-privacy").classList.add("hidden");
    });
    document.getElementById("rahasia").addEventListener("change", function () {
        document.getElementById("error-privacy").classList.add("hidden");
    });
});
