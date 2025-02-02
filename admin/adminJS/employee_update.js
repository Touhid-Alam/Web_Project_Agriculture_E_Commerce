document.addEventListener("DOMContentLoaded", function() {
    // Get form and input elements
    const form = document.querySelector('form');
    const passwordField = document.getElementById("empPassword");
    const emailField = document.getElementById("empEmail");
    const fullNameField = document.getElementById("empFullName");
    const phoneField = document.getElementById("empPhone");
    const workShiftField = document.getElementById("empWorkShift");
    const cvField = document.getElementById("empCV");
    const ageField = document.getElementById("empAge");

    // Get error display elements
    const passwordError = document.getElementById("PasswordError");
    const emailError = document.getElementById("EmailError");
    const fullNameError = document.getElementById("FullnameError");
    const phoneError = document.getElementById("PhoneError");
    const shiftError = document.getElementById("ShiftError");
    const empCVError = document.getElementById("EmpCVError");
    const empAgeError = document.getElementById("EmpAgeError");

    // Function to clear previous error messages
    function clearErrors() {
        passwordError.textContent = '';
        emailError.textContent = '';
        fullNameError.textContent = '';
        phoneError.textContent = '';
        shiftError.textContent = '';
        empCVError.textContent = '';
        empAgeError.textContent = '';
    }

    // Validation function
    function validateForm() {
        clearErrors();  // Clear any existing error messages
        let isValid = true;

        // Password validation (at least 6 characters)
        if (passwordField.value.length < 6) {
            passwordError.textContent = "Password must be at least 6 characters long.";
            isValid = false;
        }

        // Email validation (valid email format)
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(emailField.value)) {
            emailError.textContent = "Please enter a valid email address.";
            isValid = false;
        }

        // Full Name validation (cannot be empty)
        if (fullNameField.value.trim() === "") {
            fullNameError.textContent = "Full Name is required.";
            isValid = false;
        }

        // Phone number validation (must be 10 digits)
        const phonePattern = /^[0-9]{11}$/;
        if (!phonePattern.test(phoneField.value)) {
            phoneError.textContent = "Phone number must be 11 digits.";
            isValid = false;
        }

        // Work Shift validation (cannot be empty)
        if (workShiftField.value.trim() === "") {
            shiftError.textContent = "Work shift is required.";
            isValid = false;
        }
        if (cvField.files.length === 0) {
            cvError.textContent = "Please upload your CV.";
            isValid = false;
        }

        
        // Age validation (must be at least 18 years old)
        if (ageField.value < 18 || ageField.value === "") {
            empAgeError.textContent = "Age must be at least 18 years old.";
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
