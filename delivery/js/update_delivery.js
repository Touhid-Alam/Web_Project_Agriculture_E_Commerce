function toggleButtonText(orderId) {
    var checkbox = document.getElementById('status_' + orderId);
    var button = document.getElementById('button_' + orderId);
    var hiddenStatus = document.getElementById('hidden_status_' + orderId);
    if (checkbox.checked) {
        button.textContent = 'Complete';
        hiddenStatus.value = 'completed';
    } else {
        button.textContent = 'Update Status';
        hiddenStatus.value = 'pending';
    }
}

function updateStatus(orderId) {
    var status = document.getElementById('hidden_status_' + orderId).value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Handle response if needed
        }
    };
    xhttp.open("POST", "../control/delivery_orders_control.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("order_id=" + orderId + "&status=" + status + "&action=update_status");
}

function submitOrder(orderId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Remove the row from the table
            var row = document.getElementById('order_row_' + orderId);
            if (row) {
                row.parentNode.removeChild(row);
            }
        }
    };
    xhttp.open("POST", "../control/update_delivery_control.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("order_id=" + orderId + "&action=submit_order");
}

document.addEventListener("DOMContentLoaded", function() {
    const updateForm = document.querySelector(".update-form");
    updateForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the default form submission

        const fullName = document.getElementById("fullName").value.trim();
        const email = document.getElementById("email").value.trim();
        const phone = document.getElementById("phone").value.trim();
        const vehicle = document.getElementById("vehicle").value.trim();
        const age = document.getElementById("age").value.trim();

        if (fullName === "" || email === "" || phone === "" || vehicle === "" || age === "") {
            alert("Please fill in all fields.");
            return;
        }

        if (!validateEmail(email)) {
            alert("Please enter a valid email address.");
            return;
        }

        if (phone.length !== 10 || isNaN(phone)) {
            alert("Phone number must be exactly 10 digits.");
            return;
        }

        const ageNumber = parseInt(age, 10);
        if (isNaN(ageNumber) || ageNumber < 18) {
            alert("Age must be a number and at least 18.");
            return;
        }

        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert("Profile updated successfully.");
            }
        };

        xhr.open("POST", updateForm.action, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        const data = `fullName=${encodeURIComponent(fullName)}&email=${encodeURIComponent(email)}&phone=${encodeURIComponent(phone)}&vehicle=${encodeURIComponent(vehicle)}&age=${encodeURIComponent(age)}`;
        xhr.send(data);
    });

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});
