<?php
session_start();
include('../control/product_add_control.php');
if (!isset($_SESSION['username'])) {
    header("Location: ../../layout/view/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="../css/add_product.css">
    <script src="../js/product_add_validation.js"></script>
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
    <h1>Add a New Product</h1>

    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateProductForm()">
        <label for="PName">Product Name</label>
        <input type="text" name="PName" id="PName">
        <p id="PNameError"></p><br>

        <label for="Price">Price</label>
        <input type="text" name="Price" id="Price">
        <p id="PriceError"></p><br>

        <label for="Quantity">Quantity</label>
        <input type="text" name="Quantity" id="Quantity">
        <p id="QuantityError"></p><br>

        <label for="Details">Details</label>
        <textarea name="Details" id="Details" rows="5" cols="40"></textarea>
        <p id="DetailsError"></p><br>

        <label for="Picture">Product Image</label>
        <input type="file" name="Picture" id="Picture">
        <p id="PictureError"></p><br>

        <button type="submit">Add Product</button>
    </form>
</div>

</body>
</html>
