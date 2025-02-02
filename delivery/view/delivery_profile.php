<?php
session_start();
include('../control/delivery_profile_control.php');

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: delivery_login.php");
    exit;
}

$deliveryDetails = $_SESSION['deliveryDetails'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Profile</title>
    <link rel="stylesheet" type="text/css" href="../css/deliver_profile.css">
</head>
<body>
    <div class="navbar">
        <a href="delivery_profile.php">Profile</a>
        <a href="delivery_orders.php">Orders</a>
        <a href="../../layout/view/login.php">Logout</a>
        
    </div>

    <div class="main-content">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>

        <?php if (!empty($deliveryDetails)): ?>
            <h2>Your Profile</h2>
            <div class="profile-card">
                <div class="profile-item">
                    <strong>Full Name:</strong>
                    <span><?php echo htmlspecialchars($deliveryDetails['Fullname']); ?></span>
                </div>
                <div class="profile-item">
                    <strong>Email:</strong>
                    <span><?php echo htmlspecialchars($deliveryDetails['Email']); ?></span>
                </div>
                <div class="profile-item">
                    <strong>Phone:</strong>
                    <span><?php echo htmlspecialchars($deliveryDetails['Phone']); ?></span>
                </div>
                <div class="profile-item">
                    <strong>Vehicle:</strong>
                    <span><?php echo htmlspecialchars($deliveryDetails['Vehicle']); ?></span>
                </div>
                <div class="profile-item">
                    <strong>Age:</strong>
                    <span><?php echo htmlspecialchars($deliveryDetails['Age']); ?></span>
                </div>
            </div>
            <form action="update_delivery.php" method="GET">
                <input type="hidden" name="delivery_id" value="<?php echo htmlspecialchars($deliveryDetails['DeliveryUsername']); ?>">
                <button type="submit">Update Profile</button>
            </form>
        <?php else: ?>
            <p>Delivery details not found.</p>
        <?php endif; ?>
    </div>
    <script src="../js/delivery_profile.js"></script>
</body>
</html>
