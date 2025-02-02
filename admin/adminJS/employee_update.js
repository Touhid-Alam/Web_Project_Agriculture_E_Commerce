document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("employeeForm");

    const passwordField = document.getElementById("empPassword");
    const emailField = document.getElementById("empEmail");
    const fullNameField = document.getElementById("empFullName");
    const phoneField = document.getElementById("empPhone");
    const workShiftField = document.getElementById("empWorkShift");
    const cvField = document.getElementById("empCV");
    const ageField = document.getElementById("empAge");

    const passwordError = document.getElementById("PasswordError");
    const emailError = document.getElementById("EmailError");
    const fullNameError = document.getElementById("FullnameError");
    const phoneError = document.getElementById("PhoneError");
    const shiftError = document.getElementById("ShiftError");
    const empCVError = document.getElementById("EmpCVError");
    const empAgeError = document.getElementById("EmpAgeError");

    function clearErrors() {
        passwordError.textContent = '';
        emailError.textContent = '';
        fullNameError.textContent = '';
        phoneError.textContent = '';
        shiftError.textContent = '';
        empCVError.textContent = '';
        empAgeError.textContent = '';
    }

    function validateForm() {
        clearErrors();
        let isValid = true;

        if (passwordField.value.length < 6) {
            passwordError.textContent = "Password must be at least 6 characters long.";
            isValid = false;
        }

        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(emailField.value)) {
            emailError.textContent = "Please enter a valid email address.";
            isValid = false;
        }

        if (fullNameField.value.trim() === "") {
            fullNameError.textContent = "Full Name is required.";
            isValid = false;
        }

        const phonePattern = /^[0-9]{10}$/;
        if (!phonePattern.test(phoneField.value)) {
            phoneError.textContent = "Phone number must be 10 digits.";
            isValid = false;
        }

        if (workShiftField.value.trim() === "") {
            shiftError.textContent = "Work shift is required.";
            isValid = false;
        }

        if (cvField.files.length === 0) {
            empCVError.textContent = "Please upload a CV.";
            isValid = false;
        }

        if (ageField.value < 18 || ageField.value === "") {
            empAgeError.textContent = "Age must be at least 18 years old.";
            isValid = false;
        }

        return isValid;
    }

    form.addEventListener("submit", function (event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission
        }
    });
});
