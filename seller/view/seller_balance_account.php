<?php
session_start();
include('../control/seller_account_control.php');
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
    <title>Account Details</title>
    <link rel="stylesheet" href="../css/seller_balance_account.css">
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
    <h1>Account Details</h1>

    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

    <?php if (!empty($accountDetails)): ?>
        <div class="account-info">
            <div class="info-row">
                <span class="info-label">Account ID:</span>
                <span class="info-value"><?php echo htmlspecialchars($accountDetails['AccountID']); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Username:</span>
                <span class="info-value"><?php echo htmlspecialchars($accountDetails['username']); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">User Type:</span>
                <span class="info-value"><?php echo htmlspecialchars($accountDetails['usertype']); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Total Balance:</span>
                <span class="info-value"><?php echo htmlspecialchars($accountDetails['totalbalance']); ?></span>
            </div>
        </div>
    <?php else: ?>
        <p>No account details found.</p>
    <?php endif; ?>

    <button onclick="location.href='edit_balance.php'">Edit Account Details</button>
    <br>
    <button onclick="location.href='seller_profile.php'">Go Back</button>
</div>

</body>
</html>
