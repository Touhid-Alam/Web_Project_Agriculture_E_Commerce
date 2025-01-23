<?php
session_start();
include('../control/product_add_control.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <script src="../js/product_add_validation.js"></script>
</head>
<body>

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
<button onclick="location.href='seller_profile.php'">Go Back</button>

</body>
</html>
