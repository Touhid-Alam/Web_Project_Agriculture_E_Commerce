<?php
session_start();
include('../control/product_view_control.php');
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
    <title>View Product</title>
    <link rel="stylesheet" href="../css/view_product.css">
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
    <h1>Product Details</h1>

    <?php if ($product): ?>
        <table>
            <tr>
                <td>Product ID:</td>
                <td><?php echo htmlspecialchars($product['PID']); ?></td>
            </tr>
            <tr>
                <td>Product Name:</td>
                <td><?php echo htmlspecialchars($product['PName']); ?></td>
            </tr>
            <tr>
                <td>Price:</td>
                <td><?php echo htmlspecialchars($product['Price']); ?></td>
            </tr>
            <tr>
                <td>Quantity:</td>
                <td><?php echo htmlspecialchars($product['Quantity']); ?></td>
            </tr>
            <tr>
                <td>Details:</td>
                <td><?php echo htmlspecialchars($product['Details']); ?></td>
            </tr>
            <tr>
                <td>Product Image:</td>
                <td>
                    <?php if ($product['Picture']): ?>
                        <img src="../../images/<?php echo htmlspecialchars($product['Picture']); ?>" alt="Product Image" width="100">
                    <?php else: ?>
                        No image uploaded.
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    <?php else: ?>
        <p>Product not found or unavailable.</p>
    <?php endif; ?>
</div>

</body>
</html>
