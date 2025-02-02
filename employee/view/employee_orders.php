<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header("Location: employee_login.php");
    exit;
}

$pendingOrders = $_SESSION['pendingOrders'];
$deliverymen = $_SESSION['deliverymen'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Orders</title>
    <link rel="stylesheet" href="../css/employee_profile.css">
</head>
<body>
    <div class="navbar">
        <a href="employee_profile.php">Profile</a>
        <a href="employee_orders.php">Orders</a>
        <div class="logout-container">
            <form action="../control/employee_logout.php" method="POST">
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <h2>Pending Orders</h2>
        <?php if (!empty($pendingOrders)): ?>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Buyer Username</th>
                    <th>Total Price</th>
                    <th>Assign to Delivery</th>
                </tr>
                <?php foreach ($pendingOrders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['OID']); ?></td>
                        <td><?php echo htmlspecialchars($order['BuyerUsername']); ?></td>
                        <td><?php echo htmlspecialchars($order['TotalPrice']); ?></td>
                        <td>
                            <form action="../control/employee_profile_control.php" method="POST">
                                <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['OID']); ?>">
                                <select name="DeliveryUsername">
                                    <?php foreach ($deliverymen as $deliveryman): ?>
                                        <option value="<?php echo htmlspecialchars($deliveryman['DeliveryUsername']); ?>">
                                            <?php echo htmlspecialchars($deliveryman['DeliveryUsername']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit">Assign</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No pending orders found.</p>
        <?php endif; ?>
    </div>
    <script src="../js/employee_orders_validation.js"></script>
</body>
</html>
