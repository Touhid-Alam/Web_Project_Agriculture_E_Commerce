<?php
// Start session and include control file
session_start();
include('../control/buyer_edit_control.php');

// Redirect to login if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Get the buyer's username from the session
$buyerUsername = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
        <h1>Edit Profile</h1>
        <form method="post">
            <div class="profile-item">
                <label for="fullName">Full Name:</label>
                <input type="text" id="fullName" name="fullName" value="<?php echo htmlspecialchars($buyer['fullName'] ?? ''); ?>" >
            </div>
            <div class="profile-item">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($buyer['email'] ?? ''); ?>" >
            </div>
            <div class="profile-item">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($buyer['phone'] ?? ''); ?>" >
            </div>
            <div class="profile-item">
                <label for="dateOfBirth">Date of Birth:</label>
                <input type="date" id="dateOfBirth" name="dateOfBirth" value="<?php echo htmlspecialchars($buyer['dateOfBirth'] ?? ''); ?>" >
            </div>
            <div class="profile-item">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($buyer['password'] ?? ''); ?>" >
            </div>
            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>
