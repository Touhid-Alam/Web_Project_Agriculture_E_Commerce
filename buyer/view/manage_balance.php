<?php
// Start session and include control file
session_start();
include('../control/manage_balance_control.php'); // Updated path

// Redirect to login if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Get the buyer's username from the session
$buyerUsername = $_SESSION['username'];

// Fetch account details from the control file
$accountDetails = getBuyerAccountDetails($buyerUsername);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Balance</title>
    <link rel="stylesheet" href="../css/buyer_profile.css">
</head>
<body>
    <div class="navbar">
        <a href="buyer_profile.php">Profile</a>
        <a href="edit_profile.php">Edit Profile</a>
        <a href="buy_product.php">Buy Products</a>
        <a href="manage_balance.php">Manage Balance</a>
        <a href="order_history.php">Order History</a>
        <div class="logout-container">
            <a class="logout-button" href="../../layout/view/login.php">LogOut</a>
        </div>
    </div>

    <div class="main-content">
        <h1>Manage Balance</h1>
        <!-- Balance Management Form -->
        <form method="post">
            <div class="profile-item">
                <label for="balance">Current Balance:</label>
                <input type="text" id="balance" name="balance" value="<?php echo htmlspecialchars($accountDetails['totalbalance']); ?>" readonly>
            </div>
            <div class="profile-item">
                <label for="addBalance">Add Balance:</label>
                <input type="number" id="addBalance" name="addBalance" >
            </div>
            <button type="submit">Add Balance</button>
        </form>
    </div>
</body>
</html>
