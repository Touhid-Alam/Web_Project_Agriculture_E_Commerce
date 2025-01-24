<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('../model/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: employee_login.php");
    exit;
}

$db = new mydb();
$conn = $db->openCon();

$employeeDetails = $db->getEmployeeProfile($_SESSION['username'], $conn);
$pendingOrders = $db->getPendingOrders($conn);
$deliverymen = [];
if (!empty($pendingOrders)) {
    $deliverymen = $db->getAllDeliveries($conn);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Profile</title>
    <script>
        function toggleProfile() {
            var profileDiv = document.getElementById('profileDetails');
            if (profileDiv.hidden) {
                profileDiv.hidden = false;
            } else {
                profileDiv.hidden = true;
            }
        }
    </script>
</head>
<body>

    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>

    <button onclick="toggleProfile()">Your Profile</button>

    <div id="profileDetails" hidden>
        <?php if (!empty($employeeDetails)): ?>
            <h2>Your Profile</h2>
            <table>
                <tr>
                    <td><strong>Full Name:</strong></td>
                    <td><?php echo htmlspecialchars($employeeDetails['Fullname']); ?></td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td><?php echo htmlspecialchars($employeeDetails['Email']); ?></td>
                </tr>
                <tr>
                    <td><strong>Phone:</strong></td>
                    <td><?php echo htmlspecialchars($employeeDetails['Phone']); ?></td>
                </tr>
                <tr>
                    <td><strong>Work Shift:</strong></td>
                    <td><?php echo htmlspecialchars($employeeDetails['WorkShift']); ?></td>
                </tr>
            </table>
        <?php else: ?>
            <p>Employee details not found.</p>
        <?php endif; ?>
    </div>

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

</body>
</html>
