<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Profile</title>
</head>
<body>

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

<button onclick="location.href='add_product.php'">Add New Product</button>
    <br>
    <button onclick="location.href='seller_balance_account.php'">Manage Your Balance Account</button>
    <br>
    <button onclick="location.href='seller_profile_edit.php'">Manage Your Profile</button>
    <br>
    <button onclick="location.href='product_history.php'">View Product History</button>
    <br>
<button onclick="location.href='../control/seller_session_destroy.php'">Logout</button>

<script src="../js/seller_profile.js"></script>
</body>
</html>
