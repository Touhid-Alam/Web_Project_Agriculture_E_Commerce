<?php
// Start session and include control file
session_start();
include('../control/buyer_profile_control.php');

// Redirect to login if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
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
    <title>Buyer Profile</title>
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
        <h1>Welcome, <?php echo htmlspecialchars($buyerUsername); ?>!</h1>

        <!-- Product Search -->
        <form method="get">
            <input type="text" name="search" placeholder="Search Products" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit">Search</button>
        </form>

        <!-- Display Available Products -->
        <h2>Products Available</h2>
        <?php if (!empty($products)): ?>
            <table border="1">
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity Available</th>
                    <th>Picture</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['PID']); ?></td>
                        <td><?php echo htmlspecialchars($product['PName']); ?></td>
                        <td><?php echo htmlspecialchars($product['Price']); ?></td>
                        <td><?php echo htmlspecialchars($product['Quantity']); ?></td>
                        <td>
                            <?php if ($product['Picture']): ?>
                                <img src="../../images/<?php echo htmlspecialchars($product['Picture']); ?>" width="100">
                            <?php else: ?>
                                No Image
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="view_product.php?pid=<?php echo $product['PID']; ?>">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No products available.</p>
        <?php endif; ?>
    </div>
</body>
</html>
