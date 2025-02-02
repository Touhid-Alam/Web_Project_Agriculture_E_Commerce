document.addEventListener("DOMContentLoaded", function () {
    // Get form and input elements
    const form = document.querySelector('form');
    const passwordField = document.getElementById("password");
    const emailField = document.getElementById("email");
    const fullNameField = document.getElementById("fullname");
    const phoneField = document.getElementById("Phone");
    const ageField = document.getElementById("Age");
    const vehicleYes = document.getElementById("vehicleYes");
    const vehicleNo = document.getElementById("vehicleNo");
    const cvField = document.getElementById("CV");

    // Get error display elements
    const passwordError = document.getElementById("PasswordError");
    const emailError = document.getElementById("EmailError");
    const fullNameError = document.getElementById("FullnameError");
    const phoneError = document.getElementById("PhoneError");
    const ageError = document.getElementById("AgeError");
    const vehicleError = document.getElementById("VehicleError");
    const cvError = document.getElementById("CVError");

    // Function to clear previous error messages
    function clearErrors() {
        passwordError.textContent = '';
        emailError.textContent = '';
        fullNameError.textContent = '';
        phoneError.textContent = '';
        ageError.textContent = '';
        vehicleError.textContent = '';
        cvError.textContent = '';
    }

    // Validation function
    function validateForm() {
        clearErrors(); // Clear any existing error messages
        let isValid = true;

        // Password validation (must be at least 6 characters)
        if (passwordField.value.trim().length < 6) {
            passwordError.textContent = "Password must be at least 6 characters long.";
            isValid = false;
        }

        // Email validation (must not be empty and must be valid format)
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (emailField.value.trim() === "") {
            emailError.textContent = "Email is required.";
            isValid = false;
        } else if (!emailPattern.test(emailField.value)) {
            emailError.textContent = "Please enter a valid email address.";
            isValid = false;
        }

        // Full Name validation (cannot be empty)
        if (fullNameField.value.trim() === "") {
            fullNameError.textContent = "Full Name is required.";
            isValid = false;
        }

        // Phone number validation (must contain exactly 11 digits)
        const phonePattern = /^[0-9]{11}$/;
        if (!phonePattern.test(phoneField.value)) {
            phoneError.textContent = "Phone number must be exactly 11 digits.";
            isValid = false;
        }

        // Age validation (must be at least 18)
        const age = parseInt(ageField.value);
        if (isNaN(age) || age < 18) {
            ageError.textContent = "Age must be 18 or older.";
            isValid = false;
        }

        // Vehicle validation (must select one option)
        if (!vehicleYes.checked && !vehicleNo.checked) {
            vehicleError.textContent = "Please select whether you have a vehicle.";
            isValid = false;
        }

        // CV validation (must be a PDF or Word file)
        if (cvField.files.length === 0) {
            cvError.textContent = "Please upload your CV.";
            isValid = false;
        }

        

        return isValid;
    }

    // Attach the validation function to form submission
    form.addEventListener("submit", function (event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
});
