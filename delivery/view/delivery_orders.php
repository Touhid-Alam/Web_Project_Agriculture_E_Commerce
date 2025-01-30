<?php
session_start();
include('../control/delivery_orders_control.php');

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: delivery_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Orders</title>
    <link rel="stylesheet" type="text/css" href="../css/deliver_profile.css">
    <script src="../js/update_delivery.js"></script>
</head>
<body>
    <div class="navbar">
        <a href="delivery_profile.php">Profile</a>
        <a href="delivery_orders.php">Orders</a>
        <div class="logout-container">
            <form action="../control/delivery_logout.php" method="POST">
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <h1>Pending Orders</h1>
        <?php if (!empty($pendingOrders)): ?>
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
                    <?php foreach ($pendingOrders as $order): ?>
                        <tr id="order_row_<?php echo $order['OID']; ?>">
                            <td><?php echo htmlspecialchars($order['OID']); ?></td>
                            <td><?php echo htmlspecialchars($order['BuyerUsername']); ?></td>
                            <td><?php echo htmlspecialchars($order['TotalPrice']); ?></td>
                            <td>
                                <input type="checkbox" name="status_<?php echo $order['OID']; ?>" id="status_<?php echo $order['OID']; ?>" <?php echo isset($order['status']) && $order['status'] === 'completed' ? 'checked' : ''; ?> onchange="toggleButtonText(<?php echo $order['OID']; ?>)">
                                <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['OID']); ?>">
                                <input type="hidden" name="status" id="hidden_status_<?php echo $order['OID']; ?>" value="<?php echo isset($order['status']) && $order['status'] === 'completed' ? 'completed' : 'pending'; ?>">
                                <button type="button" id="button_<?php echo $order['OID']; ?>" onclick="updateStatus(<?php echo $order['OID']; ?>)"><?php echo isset($order['status']) && $order['status'] === 'completed' ? 'Complete' : 'Update Status'; ?></button>
                                <button type="button" onclick="submitOrder(<?php echo $order['OID']; ?>)">Submit</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No pending orders found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
