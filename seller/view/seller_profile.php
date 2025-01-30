<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Profile</title>
    <link rel="stylesheet" href="../css/seller_profile.css">
</head>
<body>

<div class="navbar">
<a href="seller_profile.php">View Dashboard</a>
    <a href="add_product.php">Add New Product</a>
    <a href="seller_balance_account.php">Manage Your Balance Account</a>
    <a href="seller_profile_edit.php">Manage Your Profile</a>
    <a href="product_history.php">View Product History</a>
    <a href="../control/seller_session_destroy.php">Logout</a>
</div>

<div class="main-content">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>

    <h2>Your Products</h2>
    <form id="searchForm">
        <input type="text" name="search" id="searchInput" placeholder="Enter product name to search">
        <button type="submit">Search</button>
    </form>

    <!-- Refresh Button -->
    <button id="refreshButton">Refresh</button>

    <div id="productList">
        <!-- Product list will be loaded here via AJAX -->
    </div>
</div>

<script src="../js/seller_profile.js"></script>
</body>
</html>
