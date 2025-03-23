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

    




