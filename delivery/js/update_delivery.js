document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        const fullName = form.fullName.value.trim();
        const email = form.email.value.trim();
        const phone = form.phone.value.trim();
        const vehicle = form.vehicle.value.trim();
        const age = form.age.value.trim();

        if (!fullName || !email || !phone || !vehicle || !age) {
            alert('All fields are required.');
            event.preventDefault();
        } else if (!validateEmail(email)) {
            alert('Invalid email format.');
            event.preventDefault();
        } else if (!validatePhone(phone)) {
            alert('Phone number must be exactly 10 digits.');
            event.preventDefault();
        } else if (parseInt(age) < 18) {
            alert('Age must be at least 18.');
            event.preventDefault();
        }
    });

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function validatePhone(phone) {
        return /^\d{10}$/.test(phone);
    }
});
