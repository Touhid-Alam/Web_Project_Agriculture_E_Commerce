<?php
session_start();
include('../control/view_product_control.php');
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
    <h1>Product Details</h1>

    <?php if ($product): ?>
        <table>
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

    <button onclick="location.href='buyer_profile.php'">Go Back</button>
</body>
</html>
