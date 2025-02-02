<?php
// Start session and include control file
session_start();
include('../control/buy_product_control.php');

// Redirect to login if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../../layout/view/login.php");
    exit;
}

// Get the buyer's username from the session
$buyerUsername = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Products</title>
    <script src="../js/cart.js"></script>
    <link rel="stylesheet" href="../css/buyer_profile.css">
</head>
<body>
    <div class="navbar">
    <a href="buyer_profile.php">Profile</a>
        <a href="edit_profile.php">Edit Profile</a>
        <a href="buy_product.php">Buy Products</a>
        <a href="manage_balance.php">Manage Balance</a>
        <a href="order_history.php">Order History</a>
        <a class="logout-button" href="../../layout/view/login.php">LogOut</a>
    </div>

    <div class="main-content">
        <h1>Welcome, <?php echo htmlspecialchars($buyerUsername); ?>!</h1>

        <!-- Product Search -->
        <form method="get">
            <input type="text" name="search" placeholder="Search Products" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit">Search</button>
        </form>

        <!-- Refresh Button -->
        <form method="get">
            <button type="submit">Refresh</button>
        </form>

        <!-- Display Available Products -->
        <h2>Products Available</h2>
        <?php if (!empty($products)): ?>
            <table border="1">
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity Available</th>
                    <th>Picture</th>
                    <th>Quantity to Buy</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['PID']); ?></td>
                        <td><?php echo htmlspecialchars($product['PName']); ?></td>
                        <td><?php echo htmlspecialchars($product['Price']); ?></td>
                        <td id="quantity-<?php echo $product['PID']; ?>"><?php echo htmlspecialchars($product['Quantity']); ?></td>
                        <td>
                            <?php if ($product['Picture']): ?>
                                <img src="../../images/<?php echo htmlspecialchars($product['Picture']); ?>" width="100">
                            <?php else: ?>
                                No Image
                            <?php endif; ?>
                        </td>
                        <td>
                            <input type="number" id="quantity-input-<?php echo $product['PID']; ?>" min="0" max="<?php echo $product['Quantity']; ?>">
                        </td>
                        <td>
                            <button type="button" onclick="addToCart(<?php echo $product['PID']; ?>)">Add to Cart</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No products available.</p>
        <?php endif; ?>

        <!-- Display Cart Products -->
        <h2>Products in Your Cart</h2>
        <div id="cart-products">
            <?php if (!empty($cartProducts)): ?>
                <table border="1">
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($cartProducts as $pid => $cartProduct): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($pid); ?></td>
                            <td><?php echo htmlspecialchars($cartProduct['PName']); ?></td>
                            <td><?php echo htmlspecialchars($cartProduct['Price']); ?></td>
                            <td id="cart-quantity-<?php echo $pid; ?>"><?php echo htmlspecialchars($cartProduct['Quantity']); ?></td>
                            <td><?php echo htmlspecialchars($cartProduct['TotalPrice']); ?></td>
                            <td>
                                <button type="button" onclick="deleteFromCart(<?php echo $pid; ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="4"><strong>Total Cost</strong></td>
                        <td colspan="2"><strong id="total-cost"></strong></td>
                    </tr>
                </table>
            <?php else: ?>
                <p>No products in your cart.</p>
            <?php endif; ?>
        </div>

        <button type="button" id="place-order-button" onclick="placeOrder()">Place Order</button>

        <h3><a href="../../layout/view/login.php">LogOut</a></h3>

        <h3> <button onclick="location.href='buyer_profile.php'">Go Back</button> </h3>
    </div>
</body>
</html>
