function validateEmail() {
    var email = document.getElementById("Email").value;
    const emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
    if (!emailRegex.test(email)) {
        document.getElementById("EmailError").innerHTML = "Email must be a Gmail address.";
        return false;
    } else {
        document.getElementById("EmailError").innerHTML = "";
        return true;
    }
}

function validateBusinessName() {
    var businessName = document.getElementById("BusinessName").value;
    if (businessName.trim() === "") {
        document.getElementById("BusinessNameError").innerHTML = "Business name cannot be empty.";
        return false;
    } else {
        document.getElementById("BusinessNameError").innerHTML = "";
        return true;
    }
}

function validateProductType() {
    var productType = document.getElementById("ProductType").value;
    if (productType.trim() === "") {
        document.getElementById("ProductTypeError").innerHTML = "Product type cannot be empty.";
        return false;
    } else {
        document.getElementById("ProductTypeError").innerHTML = "";
        return true;
    }
}

function validateFullName() {
    var fullName = document.getElementById("Fullname").value;
    if (fullName.trim() === "" || /\d/.test(fullName)) {
        document.getElementById("FullnameError").innerHTML = "Full name cannot be empty or contain numbers.";
        return false;
    } else {
        document.getElementById("FullnameError").innerHTML = "";
        return true;
    }
}

function validatePhone() {
    var phone = document.getElementById("Phone").value;
    if (!/^\d{11}$/.test(phone)) {
        document.getElementById("PhoneError").innerHTML = "Phone number must be 11 digits.";
        return false;
    } else {
        document.getElementById("PhoneError").innerHTML = "";
        return true;
    }
}

function validateAddress() {
    var address = document.getElementById("Address").value;
    if (address.trim() === "") {
        document.getElementById("AddressError").innerHTML = "Address cannot be empty.";
        return false;
    } else {
        document.getElementById("AddressError").innerHTML = "";
        return true;
    }
}

function validateDistrict() {
    var district = document.getElementById("District").value;
    if (district.trim() === "") {
        document.getElementById("DistrictError").innerHTML = "District cannot be empty.";
        return false;
    } else {
        document.getElementById("DistrictError").innerHTML = "";
        return true;
    }
}

function validatePassword() {
    var password = document.getElementById("Password").value;
    if (password.length < 8) {
        document.getElementById("PasswordError").innerHTML = "Password must be at least 8 characters long.";
        return false;
    } else {
        document.getElementById("PasswordError").innerHTML = "";
        return true;
    }
}

function validateNID() {
    var NID = document.getElementById("NID").value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
    if (NID !== "" && !allowedExtensions.exec(NID)) {
        document.getElementById("NIDError").innerHTML = "Only JPG, JPEG, PNG, or PDF files are allowed.";
        return false;
    } else {
        document.getElementById("NIDError").innerHTML = "";
        return true;
    }
}

function validateProfileForm() {
    return validateEmail() && validateBusinessName() && validateProductType() && validateFullName() &&
           validatePhone() && validateAddress() && validateDistrict() && validatePassword() && validateNID();
}
