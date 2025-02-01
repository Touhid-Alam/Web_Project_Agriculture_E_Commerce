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
    xhttp.open("POST", "../control/delivery_orders_control.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("order_id=" + orderId + "&action=submit_order");
}
