<?php
session_start();
include('../control/manage_balance_control.php');
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
    <title>Manage Balance</title>
    <link rel="stylesheet" href="../css/edit_balance.css">
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
    <h1>Manage Your Balance</h1>
    <h2>Current Balance: <?php echo htmlspecialchars($balance); ?> BDT</h2>

    <!-- Form for adding balance -->
    <h3>Add Balance</h3>
    <form method="post" action="">
        <label for="add_amount">Amount to Add</label>
        <input type="number" name="add_amount" id="add_amount" required>
        <button type="submit" name="add_balance">Add Balance</button>
    </form>

    <!-- Form for withdrawing balance -->
    <h3>Withdraw Balance</h3>
    <form method="post" action="">
        <label for="withdraw_amount">Amount to Withdraw</label>
        <input type="number" name="withdraw_amount" id="withdraw_amount" required>
        <button type="submit" name="withdraw_balance">Withdraw Balance</button>
        <p style="color: red;"><?php echo $withdrawError; ?></p>
    </form>
</div>

</body>
</html>
