document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"][name="status"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const orderId = this.id.split('_')[1];
            const button = document.getElementById('button_' + orderId);
            if (this.checked) {
                button.textContent = 'Complete';
            } else {
                button.textContent = 'Update Status';
            }
        });
    });

    const buttons = document.querySelectorAll('button[id^="button_"]');
    buttons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            if (this.textContent === 'Complete') {
                event.preventDefault();
                const orderId = this.id.split('_')[1];
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '../control/delivery_orders_control.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        alert('Order status sent to admin.');
                        const row = document.getElementById('order_row_' + orderId);
                        if (row) {
                            row.parentNode.removeChild(row);
                        }
                    }
                };
                xhr.send('order_id=' + orderId + '&action=notify_admin');
            }
        });
    });
});
