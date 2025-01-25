<?php
session_start();
include('../control/delivery_profile_control.php');

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
    <title>Delivery Profile</title>
    <link rel="stylesheet" type="text/css" href="../css/deliver_profile.css">
    <script src="../js/delivery_profile.js"></script>
</head>
<body>

    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>

    <h2>Delivery Profiles</h2>
    <form method="get">
        <input type="text" name="search" placeholder="Enter search term" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <button type="submit">Search</button>
    </form>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    
    <!-- Refresh Button -->
    <form method="get">
        <button type="submit">Refresh</button>
    </form>

    <form method="post">
        <button type="submit" name="toggleTable">Deliveryman List</button>
    </form>

    <?php if (!empty($deliveries)): ?>
        <table >
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Vehicle</th>
                    <th>CV</th>
                    <th>Age</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($deliveries as $delivery): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($delivery['DeliveryUsername']); ?></td>
                        <td><?php echo htmlspecialchars($delivery['Fullname']); ?></td>
                        <td><?php echo htmlspecialchars($delivery['Email']); ?></td>
                        <td><?php echo htmlspecialchars($delivery['Phone']); ?></td>
                        <td><?php echo htmlspecialchars($delivery['Vehicle']); ?></td>
                        <td><?php echo !empty($delivery['CV']) ? '<a href="../../' . htmlspecialchars($delivery['CV']) . '" target="_blank">View CV</a>' : 'No CV'; ?></td>
                        <td><?php echo htmlspecialchars($delivery['Age']); ?></td>
                        <td>
                            <a href="update_delivery.php?delivery_id=<?php echo htmlspecialchars($delivery['DeliveryUsername']); ?>">Update</a>
                        </td>
                        <td>
                            <a href="delete_delivery.php?delivery_id=<?php echo htmlspecialchars($delivery['DeliveryUsername']); ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($showTable): ?>
        <p>No delivery profiles found.</p>
    <?php endif; ?>

    <h2>Pending Orders</h2>
    <?php if (!empty($pendingOrders)): ?>
        <form method="post">
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
                        <tr>
                            <td><?php echo htmlspecialchars($order['OID']); ?></td>
                            <td><?php echo htmlspecialchars($order['BuyerUsername']); ?></td>
                            <td><?php echo htmlspecialchars($order['TotalPrice']); ?></td>
                            <td>
                                <input type="checkbox" name="status" <?php echo isset($order['status']) && $order['status'] === 'completed' ? 'checked' : ''; ?>>
                                <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['OID']); ?>">
                                <button type="submit">Update Status</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    <?php else: ?>
        <p>No pending orders found.</p>
    <?php endif; ?>

    <a href="../control/delivery_session_destroy.php">Logout</a>

</body>
</html>
