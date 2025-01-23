document.getElementById('registrationForm').addEventListener('submit', function(event) {
    if (!validateForm()) {
        event.preventDefault();
    }
});

function checkUsername() {
    var username = document.getElementById("username").value;
    if (username.trim() === "") {
        document.getElementById("usernameError").innerHTML = "Username is required.";
        return false;
    } else {
        document.getElementById("usernameError").innerHTML = "";
        return true;
    }
}

function validatePassword() {
    var password = document.getElementById("password").value;
    if (password.length < 6 || !/[@#$&]/.test(password)) {
        document.getElementById("passwordError").innerHTML = "Password must be at least 6 characters long and contain at least one special character (@, #, $, &).";
        return false;
    } else {
        document.getElementById("passwordError").innerHTML = "";
        return true;
    }
}

function validateEmail() {
    var email = document.getElementById("email").value;
    if (!/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/.test(email)) {
        document.getElementById("emailError").innerHTML = "Invalid email format.";
        return false;
    } else {
        document.getElementById("emailError").innerHTML = "";
        return true;
    }
}

function validatePhone() {
    var phone = document.getElementById("phone").value;
    if (!/^\d{1,11}$/.test(phone)) {
        document.getElementById("phoneError").innerHTML = "Phone number must be numeric and no more than 11 digits.";
        return false;
    } else {
        document.getElementById("phoneError").innerHTML = "";
        return true;
    }
}

function validateFullName() {
    var fullName = document.getElementById("fullName").value;
    if (fullName.trim() === "" || /\d/.test(fullName)) {
        document.getElementById("fullNameError").innerHTML = "Full name is required and should not contain numbers.";
        return false;
    } else {
        document.getElementById("fullNameError").innerHTML = "";
        return true;
    }
}

function validateDateOfBirth() {
    var dateOfBirth = document.getElementById("dateofbirth").value;
    if (dateOfBirth === "" || isNaN(Date.parse(dateOfBirth))) {
        document.getElementById("dobError").innerHTML = "Please enter a valid date.";
        return false;
    } else {
        document.getElementById("dobError").innerHTML = "";
        return true;
    }
}

function validateForm() {
    var isValid = true;
    isValid = checkUsername() && isValid;
    isValid = validatePassword() && isValid;
    isValid = validateEmail() && isValid;
    isValid = validatePhone() && isValid;
    isValid = validateFullName() && isValid;
    isValid = validateDateOfBirth() && isValid;
    return isValid;
}
