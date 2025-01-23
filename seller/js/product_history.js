function searchAndSort() {
    const searchTerm = document.getElementById('search-term').value;
    const sortOrder = document.getElementById('sort-order').value;

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `../control/product_history_control.php?search=${searchTerm}&sort=${sortOrder}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const productHistory = JSON.parse(xhr.responseText);
            let html = '<table border="1"><tr><th>Order ID</th><th>Buyer Username</th><th>Product ID</th><th>Product Name</th><th>Price</th><th>Quantity</th><th>Total Price</th></tr>';
            if (productHistory.length > 0) {
                productHistory.forEach(history => {
                    html += `<tr>
                                <td>${history.order_id}</td>
                                <td>${history.BuyerUsername}</td>
                                <td>${history.pid}</td>
                                <td>${history.PName}</td>
                                <td>${history.price}</td>
                                <td>${history.quantity}</td>
                                <td>${history.TotalPrice}</td>
                             </tr>`;
                });
            } else {
                html += '<tr><td colspan="7">No product history found.</td></tr>';
            }
            html += '</table>';
            document.getElementById('product-history').innerHTML = html;
        }
    };
    xhr.send();
}

// Load initial product history on page load
document.addEventListener('DOMContentLoaded', function() {
    searchAndSort();
});
