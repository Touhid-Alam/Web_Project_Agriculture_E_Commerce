document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('profileForm');
    form.addEventListener('submit', function(event) {
        let errors = [];

        const phone = document.getElementById('phone').value;

        // Phone number validation
        if (!/^0[0-9]{9,}$/.test(phone)) {
            errors.push("Phone number must start with 0 and be at least 10 digits long.");
        }

        if (errors.length > 0) {
            event.preventDefault();
            alert(errors.join("\n"));
        }
    });
});
