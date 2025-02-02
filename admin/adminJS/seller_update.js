document.addEventListener("DOMContentLoaded", function() {
    // Get form and input elements
    const form = document.querySelector('form');
    const passwordField = document.getElementById("password");
    const emailField = document.getElementById("email");
    const businessNameField = document.getElementById("businessName");
    const productTypeField = document.getElementById("productType");
    const fullNameField = document.getElementById("fullName");
    const phoneField = document.getElementById("phone");
    const addressField = document.getElementById("address");
    const districtField = document.getElementById("districts");
    const idProofField = document.getElementById("idProof");

    // Get error display elements
    const passwordError = document.getElementById("PasswordError");
    const emailError = document.getElementById("EmailError");
    const businessNameError = document.getElementById("BusinessNameError");
    const productTypeError = document.getElementById("ProductTypeError");
    const fullNameError = document.getElementById("FullnameError");
    const phoneError = document.getElementById("PhoneError");
    const addressError = document.getElementById("AddressError");
    const nidError = document.getElementById("NIDError");

    // Function to clear previous error messages
    function clearErrors() {
        passwordError.textContent = '';
        emailError.textContent = '';
        businessNameError.textContent = '';
        productTypeError.textContent = '';
        fullNameError.textContent = '';
        phoneError.textContent = '';
        addressError.textContent = '';
        nidError.textContent = '';
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

        // Business Name validation (cannot be empty)
        if (businessNameField.value.trim() === "") {
            businessNameError.textContent = "Business Name is required.";
            isValid = false;
        }

        // Product Type validation (cannot be empty)
        if (productTypeField.value.trim() === "") {
            productTypeError.textContent = "Product Type is required.";
            isValid = false;
        }

        // Full Name validation (cannot be empty)
        if (fullNameField.value.trim() === "") {
            fullNameError.textContent = "Full Name is required.";
            isValid = false;
        }

        // Phone validation (valid phone number, should be 10 digits)
        const phonePattern = /^[0-9]{11}$/;
        if (!phonePattern.test(phoneField.value)) {
            phoneError.textContent = "Phone number must be 11 digits.";
            isValid = false;
        }

        // Address validation (cannot be empty)
        if (addressField.value.trim() === "") {
            addressError.textContent = "Address is required.";
            isValid = false;
        }

        // District validation (must be selected)
        if (districtField.value.trim() === "") {
            nidError.textContent = "Please select a district.";
            isValid = false;
        }

        // ID Proof validation (must be uploaded)
        if (idProofField.files.length === 0) {
            nidError.textContent = "Please upload an ID proof.";
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
