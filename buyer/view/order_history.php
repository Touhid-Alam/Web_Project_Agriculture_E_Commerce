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
</head>
<body>

    <h1>Order History for <?php echo htmlspecialchars($buyerUsername); ?></h1>

    <?php if (!empty($orders)): ?>
        <table border="1">
            <tr>
                <th>Order ID</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['OID']); ?></td>
                    <td><?php echo htmlspecialchars($order['TotalPrice']); ?></td>
                    <td><?php echo htmlspecialchars($order['Status']); ?></td>
                    <td>
                        <a href="order_details.php?oid=<?php echo $order['OID']; ?>">View Details</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No orders found.</p>
    <?php endif; ?>

    <button onclick="location.href='buyer_profile.php'">Go Back to Profile</button>

</body>
</html>
