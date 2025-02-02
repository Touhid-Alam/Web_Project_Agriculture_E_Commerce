document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const passwordField = document.getElementById("password");
    const emailField = document.getElementById("email");
    const fullNameField = document.getElementById("fullname");
    const nidField = document.getElementById("NID");

    const passwordError = document.getElementById("PasswordlError");
    const emailError = document.getElementById("EmailError");
    const fullNameError = document.getElementById("FullnameError");
    const nidError = document.getElementById("NIDlError");

    function clearErrors() {
        passwordError.textContent = "";
        emailError.textContent = "";
        fullNameError.textContent = "";
        nidError.textContent = "";
    }

    function validateForm() {
        clearErrors();
        let isValid = true;

        // Password validation (must be at least 6 characters)
        if (passwordField.value.length < 6) {
            passwordError.textContent = "Password must be at least 6 characters.";
            isValid = false;
        }

        // Email validation
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(emailField.value)) {
            emailError.textContent = "Enter a valid email address.";
            isValid = false;
        }

        // Full Name validation (cannot be empty)
        if (fullNameField.value.trim() === "") {
            fullNameError.textContent = "Full Name is required.";
            isValid = false;
        }

        // NID file validation
        if (nidField.files.length === 0) {
            nidError.textContent = "NID file is required.";
            isValid = false;
        }

        return isValid;
    }

    form.addEventListener("submit", function (event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
});
