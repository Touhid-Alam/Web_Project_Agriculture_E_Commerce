document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    form.addEventListener('submit', function(event) {
        let errors = [];

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // Username validation
        if (username.trim() === '') {
            errors.push("Username is required.");
        }

        // Password validation
        if (password.trim() === '') {
            errors.push("Password is required.");
        }

        if (errors.length > 0) {
            event.preventDefault();
            alert(errors.join("\n"));
        }
    });
});
