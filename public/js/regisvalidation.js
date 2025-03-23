document.addEventListener("DOMContentLoaded", function () {
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm_password");
    const submitButton = document.querySelector("button[type='submit']");
    const passwordError = document.getElementById("password-error");

    function validatePassword() {
        const passwordValue = password.value;
        const confirmPasswordValue = confirmPassword.value;
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        if (!passwordRegex.test(passwordValue)) {
            passwordError.textContent = "⚠️ Password harus minimal 8 karakter dan mengandung huruf besar, huruf kecil, angka, serta karakter khusus.";
            passwordError.classList.remove("hidden");
            submitButton.disabled = true;
        } else if (passwordValue !== confirmPasswordValue) {
            passwordError.textContent = "⚠️ Password dan konfirmasi password tidak sama!";
            passwordError.classList.remove("hidden");
            submitButton.disabled = true;
        } else {
            passwordError.classList.add("hidden");
            submitButton.disabled = false;
        }
    }

    password.addEventListener("input", validatePassword);
    confirmPassword.addEventListener("input", validatePassword);
});
