
function checkUname() {
    var uname = document.getElementById("delUsername").value;
    if (uname.trim() === "") {
        document.getElementById("error").innerHTML = "Username is required.";
        return false;
    } else {
        document.getElementById("error").innerHTML = "";
        return true;
    }
}

function validatePassword() {
    var pass = document.getElementById("delPassword").value;
    if (pass.length < 6 || !/[a-z]/.test(pass)) {
        document.getElementById("passError").innerHTML = "Password must be at least 6 characters long and contain at least one lowercase letter.";
        return false;
    } else {
        document.getElementById("passError").innerHTML = "";
        return true;
    }
}

function validation() {
    var isValid = true;
    isValid = checkUname() && isValid;
    isValid = validatePassword() && isValid;

    // Additional validation checks
    const email = document.getElementById('delEmail').value;
    const phone = document.getElementById('delPhone').value;
    const fullName = document.getElementById('delFullName').value;
    const age = document.getElementById('delAge').value;
    const vehicleYes = document.getElementById('vehicleYes').checked;
    const vehicleNo = document.getElementById('vehicleNo').checked;


    if (!/^0[0-9]{9,}$/.test(phone)) {
        document.getElementById("phoneError").innerHTML = "Phone number must start with 0 and be at least 10 digits long.";
        isValid = false;
    } else {
        document.getElementById("phoneError").innerHTML = "";
    }

  
    if (age === '' || isNaN(age) || age < 18) {
        document.getElementById("ageError").innerHTML = "Age must be a number and at least 18.";
        isValid = false;
    } else {
        document.getElementById("ageError").innerHTML = "";
    }

    if (!vehicleYes && !vehicleNo) {
        document.getElementById("vehicleError").innerHTML = "Please select whether you have a vehicle.";
        isValid = false;
    } else {
        document.getElementById("vehicleError").innerHTML = "";
    }

    return isValid;
}
