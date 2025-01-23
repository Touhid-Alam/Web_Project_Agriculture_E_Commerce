document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");

    form.addEventListener("submit", function(event) {
        if (!validation()) {
            event.preventDefault();
        }
    });
});
function validateUsername() {
    var adminUserName = document.getElementById("adminUserName").value.trim();
    const username = /^[a-zA-Z0-9]*$/;
    
    if (adminUserName.length < 4) {
        document.getElementById("usernameError").innerHTML =
            "Username must be at least 4 characters long.";
        return false;
    }
    else if (adminUserName.includes(" ")) {
        document.getElementById("usernameError").innerHTML =
            "Spaces are not allowed in the username.";

        return false;
    } else if (!username.test(adminUserName)) {
        document.getElementById("usernameError").innerHTML =
            "Username should only contain alphabets and numbers.";
        return false;
    } else {
        document.getElementById("usernameError").innerHTML = "";
        return true;
    }
}
function validatePassword(){
    var adminPassword = document.getElementById("adminPassword").value;

    if (
        adminPassword === "" ||
        !/[0-9]/.test(adminPassword) ||
        !/[A-Z]/.test(adminPassword) ||
        adminPassword.length < 8
    ) {
        document.getElementById("passwordError").innerHTML =
            "Password must be at least 8 characters long, contain at least one numeric character, and one uppercase letter.";
        return false;
    } else {
        document.getElementById("passwordError").innerHTML = "";
        return true;
    }
}
function validation() {
   
    return validateUsername()&& validatePassword();
}