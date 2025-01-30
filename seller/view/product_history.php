<?php
session_start();
include('../control/product_history_control.php');

// Redirect to login if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../../layout/view/login.php");
    exit;
}

// Get the seller's username from the session
$sellerUsername = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product History</title>
    <link rel="stylesheet" href="../css/product_history.css">
</head>
<body>

<div class="navbar">
<a href="seller_profile.php">View Dashboard</a>
    <a href="add_product.php">Add New Product</a>
    <a href="seller_balance_account.php">Manage Your Balance Account</a>
    <a href="view_profile.php">View Profile</a>
    <a href="seller_profile_edit.php">Edit Profile</a>
    <a href="product_history.php">View Product History</a>
    <a href="../control/seller_session_destroy.php">Logout</a>
</div>

<div class="main-content">
    <h1>Product History for <?php echo htmlspecialchars($sellerUsername); ?></h1>

    <!-- Search and Refresh Options -->
    <form method="get" class="search-refresh-form">
        <input type="text" name="search" placeholder="Search by Product Name" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <button type="submit">Search</button>
        <button type="submit" name="refresh">Refresh</button>
    </form>

    <div id="product-history">
        <table border="1">
            <tr>
                <th>Order ID</th>
                <th>Buyer Username</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
            <?php if (!empty($productHistory)): ?>
                <?php foreach ($productHistory as $history): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($history['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($history['BuyerUsername']); ?></td>
                        <td><?php echo htmlspecialchars($history['pid']); ?></td>
                        <td><?php echo htmlspecialchars($history['PName']); ?></td>
                        <td><?php echo htmlspecialchars($history['price']); ?></td>
                        <td><?php echo htmlspecialchars($history['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($history['TotalPrice']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No product history found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</div>

</body>
</html>
