document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registrationForm');
    form.addEventListener('submit', function(event) {
        let errors = [];

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        const phone = document.getElementById('phone').value;
        const cv = document.getElementById('cv').files[0];

        // Password validation
        if (password.length < 6 || !/[a-z]/.test(password)) {
            errors.push("Password must be at least 6 characters long and contain at least one lowercase letter.");
        }

        // Phone number validation
        if (!/^0[0-9]{9,}$/.test(phone)) {
            errors.push("Phone number must start with 0 and be at least 10 digits long.");
        }

        // CV validation
        if (cv && !['pdf', 'doc', 'docx'].includes(cv.name.split('.').pop().toLowerCase())) {
            errors.push("CV must be a valid file (.pdf, .doc, .docx).");
        }

        if (errors.length > 0) {
            event.preventDefault();
            alert(errors.join("\n"));
        }
    });
});
