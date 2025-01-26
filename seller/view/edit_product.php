<?php
session_start();
include('../control/product_edit_control.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <script src="../js/product_edit_validation.js"></script>
</head>
<body>
    <h1>Edit Product</h1>

    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateProductForm()">
        <label for="PID">Product ID</label>
        <input type="text" name="PID" id="PID" value="<?php echo $product['PID']; ?>" readonly>
        <br><br>

        <label for="PName">Product Name</label>
        <input type="text" name="PName" id="PName" value="<?php echo $product['PName']; ?>">
        <p id="PNameError"></p><br>

        <label for="Price">Price</label>
        <input type="number" name="Price" id="Price" value="<?php echo $product['Price']; ?>">
        <p id="PriceError"></p><br>

        <label for="Quantity">Quantity</label>
        <input type="number" name="Quantity" id="Quantity" value="<?php echo $product['Quantity']; ?>">
        <p id="QuantityError"></p><br>

        <label for="Details">Details</label>
        <textarea name="Details" id="Details" rows="5" cols="40"><?php echo $product['Details']; ?></textarea>
        <p id="DetailsError"></p><br>

        <label for="Picture">Product Image</label>
        <input type="file" name="Picture" id="Picture">
        <p id="PictureError"></p><br>

        <label>Current Image:</label>
        <?php if ($product['Picture']): ?>
            <img src="../../images/<?php echo htmlspecialchars($product['Picture']); ?>" alt="Product Image" width="100">
        <?php else: ?>
            No image uploaded.
        <?php endif; ?>
        <br><br>

        <button type="submit">Update Product</button>
    </form>

    <button onclick="location.href='seller_profile.php'">Go Back</button>
</body>
</html>
