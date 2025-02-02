document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("adminRegistrationForm");

    const usernameField = document.getElementById("adminUsername");
    const emailField = document.getElementById("email");
    const passwordField = document.getElementById("adminPassword");
    const fullnameField = document.getElementById("adminFullname");
    const idProofField = document.getElementById("idProof");

    const usernameError = document.getElementById("usernameError");
    const emailError = document.getElementById("emailError");
    const passwordError = document.getElementById("passwordError");
    const fullNameError = document.getElementById("fullNameError");
    const idProofError = document.getElementById("idProofError");

    // Function to clear all error messages
    function clearErrors() {
        usernameError.textContent = '';
        emailError.textContent = '';
        passwordError.textContent = '';
        fullNameError.textContent = '';
        idProofError.textContent = '';
    }

    // Form validation function
    function validateForm() {
        clearErrors();
        let isValid = true;

        // Username validation (cannot be empty)
        if (usernameField.value.trim() === "") {
            usernameError.textContent = "Username is required.";
            isValid = false;
        }

        // Email validation (valid email format)
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(emailField.value)) {
            emailError.textContent = "Please enter a valid email address.";
            isValid = false;
        }

        // Password validation (at least 6 characters)
        if (passwordField.value.length < 6) {
            passwordError.textContent = "Password must be at least 6 characters long.";
            isValid = false;
        }

        // Full Name validation (cannot be empty)
        if (fullnameField.value.trim() === "") {
            fullNameError.textContent = "Full Name is required.";
            isValid = false;
        }

        // ID Proof validation (file must be uploaded)
        if (idProofField.files.length === 0) {
            idProofError.textContent = "Please upload your NID proof.";
            isValid = false;
        }

        return isValid;
    }

    // Attach the validation function to form submission
    form.addEventListener("submit", function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
});
