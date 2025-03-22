let slideIndex = 0;
	const slides = document.querySelectorAll(".slide");
	const dots = document.querySelectorAll(".dot");

	function showSlides(n) {
		slides.forEach((slide, index) => {
			slide.classList.add("hidden");
			dots[index].classList.remove("bg-white");
			dots[index].classList.add("bg-gray-400");
		});

		slides[n].classList.remove("hidden");
		dots[n].classList.add("bg-white");
		dots[n].classList.remove("bg-gray-400");
	}

	function nextSlide() {
		slideIndex = (slideIndex + 1) % slides.length;
		showSlides(slideIndex);
	}

	function prevSlide() {
		slideIndex = (slideIndex - 1 + slides.length) % slides.length;
		showSlides(slideIndex);
	}

	document.querySelector(".next").addEventListener("click", nextSlide);
	document.querySelector(".prev").addEventListener("click", prevSlide);
	dots.forEach((dot, index) => dot.addEventListener("click", () => showSlides(slideIndex = index)));

	setInterval(nextSlide, 4000); // Auto-slide setiap 4 detik
	showSlides(slideIndex);
