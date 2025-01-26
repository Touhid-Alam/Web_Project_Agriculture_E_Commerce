document.addEventListener('DOMContentLoaded', function() {
    loadProducts();

    document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault();
        loadProducts(document.getElementById('searchInput').value);
    });

    document.getElementById('refreshButton').addEventListener('click', function() {
        document.getElementById('searchInput').value = '';
        loadProducts();
    });
});

function loadProducts(searchTerm = '') {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `../control/seller_profile_control.php?search=${encodeURIComponent(searchTerm)}`, true);
    xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById('productList').innerHTML = this.responseText;
            attachDeleteHandlers();
        }
    };
    xhr.send();
}

function attachDeleteHandlers() {
    // Select all elements with the class 'deleteProduct'
    document.querySelectorAll('.deleteProduct').forEach(function(button) {
        // Add a click event listener to each delete button
        button.addEventListener('click', function() {
            // Get the product ID from the data-pid attribute of the button
            const pid = this.getAttribute('data-pid');
            // Call the deleteProduct function with the product ID
            deleteProduct(pid);
        });
    });
}

function deleteProduct(pid) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', `../control/product_delete_control.php`, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status === 200) {
            loadProducts();
        }
    };
    xhr.send(`pid=${pid}`);
}
