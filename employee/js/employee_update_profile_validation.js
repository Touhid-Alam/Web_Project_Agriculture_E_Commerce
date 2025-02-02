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
 
    const workshiftSelect = document.getElementById("workshift-select");
    const workshiftInput = document.getElementById("workshift");
 
    workshiftSelect.addEventListener("change", function() {
        const selectedShift = workshiftSelect.value;
        if (selectedShift) {
            fetchWorkShift(selectedShift);
        }
    });
 
    const shiftTable = document.querySelector(".shift-table");
 
    shiftTable.addEventListener("click", function(event) {
        const target = event.target;
        if (target.tagName === "TD" || target.tagName === "TR") {
            const row = target.closest("tr");
            const shiftId = row.getAttribute("data-shift-id");
            const shiftName = row.getAttribute("data-shift-name");
 
            if (shiftId && shiftName) {
                const workshiftInput = document.getElementById("workshift");
                workshiftInput.value = shiftId;
                alert(`Selected Shift: ${shiftName}`);
            }
        }
    });
 
    function fetchWorkShift(shiftId) {
        fetch(`../control/get_workshift.php?shiftId=${shiftId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    workshiftInput.value = data.workshift;
                } else {
                    alert("Failed to fetch work shift.");
                }
            })
            .catch(error => {
                console.error("Error fetching work shift:", error);
                alert("An error occurred while fetching the work shift.");
            });
    }
 
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