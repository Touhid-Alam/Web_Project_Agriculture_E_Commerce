document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");
    const usernameInput = document.getElementById("username");
    const passwordInput = document.getElementById("password");

    form.addEventListener("submit", function(event) {
        let valid = true;
        let errorMessage = "";

        const username = usernameInput.value.trim();
        const password = passwordInput.value.trim();

        if (username === "") {
            valid = false;
            errorMessage += "Username is required.\n";
        }

        if (password === "") {
            valid = false;
            errorMessage += "Password is required.\n";
        }

        if (!valid) {
            alert(errorMessage);
            event.preventDefault();
        }
    });
});
