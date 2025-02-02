<?php
// Start session and include control file
session_start();
include('../control/order_history_control.php');

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
    <title>Order History</title>
    <link rel="stylesheet" href="../css/buyer_profile.css">
</head>
<body>
    <div class="navbar">
        <a href="buyer_profile.php">Profile</a>
        <a href="edit_profile.php">Edit Profile</a>
        <a href="buy_product.php">Buy Products</a>
        <a href="manage_balance.php">Manage Balance</a>
        <a href="order_history.php">Order History</a>
        <div class="logout-container">
            <a class="logout-button" href="../../layout/view/login.php">LogOut</a>
        </div>
    </div>

    <div class="main-content">
        <h1>Order History for <?php echo htmlspecialchars($buyerUsername); ?></h1>
        <!-- Display Order History -->
        <?php if (!empty($orders)): ?>
            <table border="1">
                <tr>
                    <th>Order ID</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['OID']); ?></td>
                        <td><?php echo htmlspecialchars($order['TotalPrice']); ?></td>
                        <td><?php echo htmlspecialchars($order['Status']); ?></td>
                        <td><a href="order_details.php?oid=<?php echo htmlspecialchars($order['OID']); ?>">View Details</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No orders found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
