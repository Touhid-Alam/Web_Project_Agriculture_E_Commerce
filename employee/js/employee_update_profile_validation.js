document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector(".update-form");

    form.addEventListener("submit", function(event) {
        const fullname = document.getElementById("fullname").value.trim();
        const email = document.getElementById("email").value.trim();
        const phone = document.getElementById("phone").value.trim();
        const workshift = document.getElementById("workshift").value.trim();

        if (!fullname || !email || !phone || !workshift) {
            alert("All fields are required.");
            event.preventDefault();
            return;
        }

        if (!validateFullname(fullname)) {
            alert("Full name must contain only letters.");
            event.preventDefault();
            return;
        }

        if (!validateEmail(email)) {
            alert("Please enter a valid email address.");
            event.preventDefault();
            return;
        }

        if (!validatePhone(phone)) {
            alert("Please enter a valid phone number. It must start with 0 and be at least 10 digits long.");
            event.preventDefault();
            return;
        }
    });

    function validateFullname(fullname) {
        const re = /^[A-Za-z\s]+$/;
        return re.test(fullname);
    }

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function validatePhone(phone) {
        const re = /^0\d{9,}$/;
        return re.test(phone);
    }
});
