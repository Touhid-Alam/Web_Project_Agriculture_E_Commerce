<?php
session_start();
include('../control/product_history_control.php');

// Redirect to login if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../view/seller_login.php");
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
</head>
<body>

    <h1>Product History for <?php echo htmlspecialchars($sellerUsername); ?></h1>

    <!-- Search and Sort Options -->
    <form method="get">
        <input type="text" name="search" placeholder="Search by Product Name" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <select name="sort">
            <option value="asc" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'asc' ? 'selected' : ''; ?>>Sort by Name (A-Z)</option>
            <option value="desc" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'desc' ? 'selected' : ''; ?>>Sort by Name (Z-A)</option>
        </select>
        <button type="submit">Search and Sort</button>
    </form>

    <!-- Refresh Button -->
    <form method="get">
        <button type="submit">Refresh</button>
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

    <button onclick="location.href='seller_profile.php'">Go Back to Profile</button>

</body>
</html>
