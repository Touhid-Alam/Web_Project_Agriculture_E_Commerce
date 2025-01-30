<?php
session_start();

// Ensure the user is logged in as admin
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit;
}

$completedOrders = isset($_SESSION['completedOrders']) ? $_SESSION['completedOrders'] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed Orders</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_profile.css">
</head>
<body>
    <div class="navbar">
        <a href="admin_profile.php">Profile</a>
        <a href="admin_orders.php">Orders</a>
        <a href="completed_orders.php">Completed Orders</a>
        <a href="admin_logout.php">Logout</a>
    </div>

    <div class="main-content">
        <h1>Completed Orders</h1>
        <?php if (!empty($completedOrders)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Buyer Username</th>
                        <th>Total Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($completedOrders as $orderId): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($orderId); ?></td>
                            <!-- Add other order details here if needed -->
                            <td>BuyerUsername</td>
                            <td>TotalPrice</td>
                            <td>Completed</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No completed orders found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
