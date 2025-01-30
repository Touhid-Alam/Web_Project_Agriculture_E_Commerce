document.addEventListener('DOMContentLoaded', function() {
    loadProducts();

    document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault();
        loadProducts(document.getElementById('searchInput').value);
    });

    document.getElementById('refreshButton').addEventListener('click', function(event) {
        event.preventDefault();
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
    document.querySelectorAll('.deleteProduct').forEach(function(button) {
        button.addEventListener('click', function() {
            const pid = this.getAttribute('data-pid');
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
