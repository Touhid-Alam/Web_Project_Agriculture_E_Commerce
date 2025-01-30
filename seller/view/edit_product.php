<?php
session_start();
include('../control/product_edit_control.php');
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
    <title>Edit Product</title>
    <link rel="stylesheet" href="../css/edit_product.css">
    <script src="../js/product_edit_validation.js"></script>
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
    <h1>Edit Product</h1>

    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateProductForm()">
        <label for="PID">Product ID</label>
        <input type="text" name="PID" id="PID" value="<?php echo $product['PID']; ?>" readonly>
        <br><br>

        <label for="PName">Product Name</label>
        <input type="text" name="PName" id="PName" value="<?php echo htmlspecialchars($product['PName']); ?>">
        <p id="PNameError"></p><br>

        <label for="Price">Price</label>
        <input type="number" name="Price" id="Price" value="<?php echo htmlspecialchars($product['Price']); ?>">
        <p id="PriceError"></p><br>

        <label for="Quantity">Quantity</label>
        <input type="number" name="Quantity" id="Quantity" value="<?php echo htmlspecialchars($product['Quantity']); ?>">
        <p id="QuantityError"></p><br>

        <label for="Details">Details</label>
        <textarea name="Details" id="Details" rows="5" cols="40"><?php echo htmlspecialchars($product['Details']); ?></textarea>
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
</div>

</body>
</html>
