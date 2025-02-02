document.addEventListener("DOMContentLoaded", function() {
    // Get form and input elements
    const form = document.querySelector('form');
    const emailField = document.getElementById("email");
    const passwordField = document.getElementById("password");
    const fullNameField = document.getElementById("fullName");
    const phoneField = document.getElementById("phone");
    const dateOfBirthField = document.getElementById("dateofbirth");

    // Get error display elements
    const emailError = document.getElementById("EmailError");
    const passwordError = document.getElementById("PasswordError");
    const fullNameError = document.getElementById("FullnameError");
    const phoneError = document.getElementById("PhoneError");
    const dobError = document.getElementById("DOBError");

    // Function to clear previous error messages
    function clearErrors() {
        emailError.textContent = '';
        passwordError.textContent = '';
        fullNameError.textContent = '';
        phoneError.textContent = '';
        dobError.textContent = '';
    }

    // Validation function
    function validateForm() {
        clearErrors();  // Clear any existing error messages
        let isValid = true;

        // Email validation (checks for valid email format)
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(emailField.value)) {
            emailError.textContent = "Please enter a valid email address.";
            isValid = false;
        }

        // Password validation (must be at least 6 characters)
        if (passwordField.value.length < 6) {
            passwordError.textContent = "Password must be at least 6 characters long.";
            isValid = false;
        }

        // Full Name validation (cannot be empty)
        if (fullNameField.value.trim() === "") {
            fullNameError.textContent = "Full Name is required.";
            isValid = false;
        }

        // Phone number validation (must contain exactly 10 digits)
        const phonePattern = /^[0-9]{11}$/;
        if (!phonePattern.test(phoneField.value)) {
            phoneError.textContent = "Phone number must be 11 digits.";
            isValid = false;
        }

        // Date of Birth validation (must be a past date)
        const dob = new Date(dateOfBirthField.value);
        const today = new Date();
        if (dob >= today) {
            dobError.textContent = "Date of Birth must be a date in the past.";
            isValid = false;
        }

        return isValid;
    }

    // Attach the validation function to form submission
    form.addEventListener("submit", function(event) {
        if (!validateForm()) {
            event.preventDefault();  // Prevent form submission if validation fails
        }
    });
});
