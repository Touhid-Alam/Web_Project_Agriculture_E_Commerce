<?php
session_start();
include('../control/seller_profile_control.php');
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
<form method="get">
    <input type="text" name="search" placeholder="Enter product name to search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
    <button type="submit">Search</button>
</form>

<!-- Refresh Button -->
<form method="get">
    <button type="submit" name="search" value="">Refresh</button>
</form>
   
<?php if (!empty($products)): ?>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Picture</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['PName']); ?></td>
                    <td><?php echo htmlspecialchars($product['Price']); ?></td>
                    <td><?php echo htmlspecialchars($product['Quantity']); ?></td>
                    <td><img src="../../images/<?php echo htmlspecialchars($product['Picture']); ?>" width="100"></td>
                    <td>
                        <a href="view_product.php?pid=<?php echo $product['PID']; ?>">View</a> |
                        <a href="edit_product.php?pid=<?php echo $product['PID']; ?>">Edit</a> |
                        <a href="../control/product_delete_control.php?pid=<?php echo $product['PID']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No products found.</p>
<?php endif; ?>
<button onclick="location.href='add_product.php'">Add New Product</button>
    <br>
    <button onclick="location.href='seller_balance_account.php'">Manage Your Balance Account</button>
    <br>
    <button onclick="location.href='seller_profile_edit.php'">Manage Your Profile</button>
    <br>
    <button onclick="location.href='product_history.php'">View Product History</button>
    <br>
<button onclick="location.href='../control/seller_session_destroy.php'">Logout</button>

</body>
</html>
