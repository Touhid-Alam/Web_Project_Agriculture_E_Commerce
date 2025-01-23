function validateLogin() {
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    let usertype = document.getElementById("usertype").value;
    let isValid = true;

    if (username === "") {
        document.getElementById("usernameError").innerText = "Username is required";
        isValid = false;
    } else {
        document.getElementById("usernameError").innerText = "";
    }

    if (password === "") {
        document.getElementById("passwordError").innerText = "Password is required";
        isValid = false;
    } else {
        document.getElementById("passwordError").innerText = "";
    }

    if (usertype === "") {
        document.getElementById("usertypeError").innerText = "User type is required";
        isValid = false;
    } else {
        document.getElementById("usertypeError").innerText = "";
    }

    return isValid;
}
