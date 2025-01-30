<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['username'])) {
    header("Location:../../layout/view/login.php"); // Redirect to login page if not logged in
}
$adminUsername = $_SESSION['username'];

// Fetch completed orders from session
$completedOrders = isset($_SESSION['completedOrders']) ? $_SESSION['completedOrders'] : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>

<div style="text-align: right;">
    <a href="../view/admin_profile.php">Admin Profile</a>
</div>

<h1>Welcome, <?php echo $adminUsername; ?></h1>

<nav>
    <ul>
        <li><a href="../view/admin_view.php">View Admin Info</a></li>
        <li><a href="../view/admin_update.php">Update Admin Info</a></li>
        <li><a href="../../layout/view/login.php">Logout</a></li>
    </ul>
</nav>

<section>
    <h2>Dashboard Features</h2>
    <p>Here you can manage admins, view reports, and perform other administrative tasks.</p>
    <ul>
        <li><a href="../view/seller_info.php">Seller Info</a></li>
        <li><a href="../view/admin_update.php">Buyer Info</a></li>
        <li><a href="../view/admin_home.php">Employe Info</a></li>
        <li><a href="../view/seller_info.php">Delivery Man Info</a></li>
    </ul>
</section>

<section>
    <h2>Completed Orders</h2>
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
                <?php foreach ($completedOrders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['OID']); ?></td>
                        <td><?php echo htmlspecialchars($order['BuyerUsername']); ?></td>
                        <td><?php echo htmlspecialchars($order['TotalPrice']); ?></td>
                        <td>Completed</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No completed orders found.</p>
    <?php endif; ?>
</section>

</body>
</html>
