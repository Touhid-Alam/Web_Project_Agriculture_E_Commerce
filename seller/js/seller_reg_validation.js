function checkUsername() {
    var username = document.getElementById("username").value;
    if (username.length < 8) {
        document.getElementById("usernameError").innerHTML = "Username must be at least 8 characters long.";
        return false;
    } else {
        document.getElementById("usernameError").innerHTML = "";
        return true;
    }
}

function validatePassword() {
    var password = document.getElementById("password").value;
    if (password.length < 8) {
        document.getElementById("passwordError").innerHTML = "Password must be at least 8 characters long.";
        return false;
    } else {
        document.getElementById("passwordError").innerHTML = "";
        return true;
    }
}

function validateEmail() {
    var email = document.getElementById("email").value;
    if (!email.endsWith("@gmail.com")) {
        document.getElementById("emailError").innerHTML = "Email must be a Gmail address.";
        return false;
    } else {
        document.getElementById("emailError").innerHTML = "";
        return true;
    }
}

function validateFullName() {
    var fullName = document.getElementById("fullName").value;
    if (/\d/.test(fullName)) {
        document.getElementById("fullNameError").innerHTML = "Full name cannot contain numbers.";
        return false;
    } else {
        document.getElementById("fullNameError").innerHTML = "";
        return true;
    }
}

function validatePhone() {
    var phone = document.getElementById("phone").value;
    if (!/^\d{11}$/.test(phone)) {
        document.getElementById("phoneError").innerHTML = "Phone number must be 11 digits.";
        return false;
    } else {
        document.getElementById("phoneError").innerHTML = "";
        return true;
    }
}

function validateAddress() {
    var address = document.getElementById("address").value;
    if (address.trim() === "") {
        document.getElementById("addressError").innerHTML = "Address cannot be empty.";
        return false;
    } else {
        document.getElementById("addressError").innerHTML = "";
        return true;
    }
}

function validateDistrict() {
    var district = document.getElementById("districts").value;
    if (district === "") {
        document.getElementById("districtError").innerHTML = "Please select a district.";
        return false;
    } else {
        document.getElementById("districtError").innerHTML = "";
        return true;
    }
}

function validateIdProof() {
    var idProof = document.getElementById("idProof").value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
    if (idProof === "") {
        document.getElementById("idProofError").innerHTML = "Please upload an ID proof.";
        return false;
    } else if (!allowedExtensions.exec(idProof)) {
        document.getElementById("idProofError").innerHTML = "Only JPG, JPEG, PNG, or PDF files are allowed.";
        return false;
    } else {
        document.getElementById("idProofError").innerHTML = "";
        return true;
    }
}

function validateProductType() {
    var productType = document.getElementById("productType").value;
    if (productType.trim() === "") {
        document.getElementById("productTypeError").innerHTML = "Product type cannot be empty.";
        return false;
    } else {
        document.getElementById("productTypeError").innerHTML = "";
        return true;
    }
}

function validation() {
    return checkUsername() && validatePassword() && validateEmail() && validateFullName() &&
           validatePhone() && validateAddress() && validateDistrict() && validateIdProof() && validateProductType();
}
