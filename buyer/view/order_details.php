<?php
// Start session and include control file
session_start();
include('../control/order_details_control.php');

// Redirect to login if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../../layout/view/login.php");
    exit;
}

// Get the order ID from the query string
$oid = $_GET['oid'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="../css/buyer_profile.css">
</head>
<body>
    <div class="navbar">
    <a href="buyer_profile.php">Profile</a>
        <a href="edit_profile.php">Edit Profile</a>
        <a href="buy_product.php">Buy Products</a>
        <a href="manage_balance.php">Manage Balance</a>
        <a href="order_history.php">Order History</a>
    </div>

    <div class="main-content">
        <h1>Order Details for Order ID: <?php echo htmlspecialchars($oid); ?></h1>

        <?php if (!empty($orderDetails)): ?>
            <table border="1">
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Seller Username</th>
                </tr>
                <?php foreach ($orderDetails as $detail): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($detail['pid']); ?></td>
                        <td><?php echo htmlspecialchars($detail['PName']); ?></td>
                        <td><?php echo htmlspecialchars($detail['price']); ?></td>
                        <td><?php echo htmlspecialchars($detail['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($detail['TotalPrice']); ?></td>
                        <td><?php echo htmlspecialchars($detail['seller_username']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No details found for this order.</p>
        <?php endif; ?>

        <button onclick="location.href='order_history.php'">Go Back to Order History</button>
    </div>
</body>
</html>
