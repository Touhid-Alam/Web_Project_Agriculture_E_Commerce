function addToCart(pid) {
    const quantityInput = document.getElementById(`quantity-input-${pid}`);
    const quantity = parseInt(quantityInput.value, 10);
    const availableQuantity = parseInt(document.getElementById(`quantity-${pid}`).innerText, 10);
    const currentCartQuantity = parseInt(document.getElementById(`cart-quantity-${pid}`)?.innerText || 0, 10);
    const totalCartQuantity = currentCartQuantity + quantity;

    if (quantity > 0) {
        if (totalCartQuantity <= availableQuantity) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../control/buy_product_control.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        updateCart(response.cartProducts);
                        document.getElementById("place-order-button").style.display = "block";
                    } else {
                        alert(response.message || "Failed to add product to cart.");
                    }
                }
            };
            xhr.send(`pid=${pid}&quantity=${quantity}&action=add_to_cart`);
        } else {
            alert("Not enough products available.");
        }
    } else {
        alert("Please enter a valid quantity.");
    }
}

function deleteFromCart(pid) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../control/buy_product_control.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                updateCart(response.cartProducts);
            } else {
                alert("Failed to delete product from cart.");
            }
        }
    };
    xhr.send(`pid=${pid}&action=delete_from_cart`);
}

function updateCart(cartProducts) {
    const cartProductsDiv = document.getElementById("cart-products");
    let cartHtml = "<table border='1'><tr><th>Product ID</th><th>Product Name</th><th>Price</th><th>Quantity</th><th>Total Price</th><th>Actions</th></tr>";
    let totalCost = 0;

    for (const pid in cartProducts) {
        const cartProduct = cartProducts[pid];
        totalCost += cartProduct.TotalPrice;
        cartHtml += `<tr>
                        <td>${pid}</td>
                        <td>${cartProduct.PName}</td>
                        <td>${cartProduct.Price}</td>
                        <td id="cart-quantity-${pid}">${cartProduct.Quantity}</td>
                        <td>${cartProduct.TotalPrice}</td>
                        <td>
                            <button type="button" onclick="deleteFromCart(${pid})">Delete</button>
                        </td>
                     </tr>`;
    }

    cartHtml += `<tr>
                    <td colspan="4"><strong>Total Cost</strong></td>
                    <td colspan="2"><strong>${totalCost}</strong></td>
                 </tr>`;
    cartHtml += "</table>";
    cartProductsDiv.innerHTML = cartHtml;

    // Ensure the "Place Order" button is displayed if there are products in the cart
    if (Object.keys(cartProducts).length > 0) {
        document.getElementById("place-order-button").style.display = "block";
    } else {
        document.getElementById("place-order-button").style.display = "none";
    }
}

function placeOrder() {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../control/buy_product_control.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert("Order placed successfully!");
                location.reload();
            } else {
                alert(response.message || "Failed to place order.");
            }
        }
    };
    xhr.send("action=place_order");
}
