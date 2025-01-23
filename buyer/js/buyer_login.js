document.addEventListener("DOMContentLoaded", function () {
    // Select the form and input fields
    const form = document.querySelector("form");
    const usernameInput = document.getElementById("username");
    const passwordInput = document.getElementById("password");

    // Add an event listener to handle form submission
    form.addEventListener("submit", function (event) {
        if (!validateForm()) {
            event.preventDefault(); // Stop form submission if validation fails
        }
    });
});

function validateForm() {
    let valid = true; // Flag to track form validity
    let errorMessage = ""; // String to store error messages

    // Trim and get the values from input fields
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();

    // Validate username
    if (username === "") {
        valid = false;
        errorMessage += "Username is required.\n";
    }

    // Validate password
    if (password === "") {
        valid = false;
        errorMessage += "Password is required.\n";
    }

    // If the form is invalid, display errors
    if (!valid) {
        alert(errorMessage); // Show errors in an alert dialog
    }

    return valid; // Return the validity status
}
