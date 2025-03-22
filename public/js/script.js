document.getElementById("readMoreBtn").addEventListener("click", function() {
    var moreText = document.getElementById("moreText");
    if (moreText.classList.contains("hidden")) {
        moreText.classList.remove("hidden");
        this.textContent = "Lebih sedikit";
    } else {
        moreText.classList.add("hidden");
        this.textContent = "Lebih banyak";
    }

});

let lastScrollTop = 0;

window.addEventListener("scroll", function () {
    let navbar = document.getElementById("navbar");
    let currentScroll = window.scrollY;

    if (currentScroll > lastScrollTop) {
        // Jika discroll ke bawah, tambahkan efek blur dan transparansi
        navbar.classList.add("bg-white/30", "backdrop-blur-md", "shadow-lg");
        navbar.classList.remove("bg-white");
    } else if (currentScroll === 0) {
        // Jika kembali ke atas, tetap putih
        navbar.classList.remove("bg-gray/30", "backdrop-blur-md", "shadow-lg");
        navbar.classList.add("bg-white");
    }

    lastScrollTop = currentScroll;
});

    




