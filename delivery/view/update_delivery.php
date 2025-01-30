<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header("Location: delivery_login.php");
    exit;
}

if (!isset($_SESSION['delivery'])) {
    header("Location: ../control/update_delivery_control.php?delivery_id=" . $_GET['delivery_id']);
    exit;
}

$delivery = $_SESSION['delivery'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Delivery Profile</title>
    <link rel="stylesheet" type="text/css" href="../css/deliver_profile.css">
</head>
<body>
    <div class="navbar">
        <a href="delivery_profile.php">Profile</a>
        <a href="delivery_orders.php">Orders</a>
        <a href="delivery_logout.php">Logout</a>
    </div>

    <div class="main-content">
        <h2>Update Delivery Profile</h2>
        <form action="../control/update_delivery_control.php" method="POST" class="update-form">
            <input type="hidden" name="delivery_id" value="<?php echo htmlspecialchars($delivery['DeliveryUsername']); ?>">
            <div class="profile-item">
                <label for="fullName"><strong>Full Name:</strong></label>
                <input type="text" id="fullName" name="fullName" value="<?php echo htmlspecialchars($delivery['Fullname']); ?>" required>
            </div>
            <div class="profile-item">
                <label for="email"><strong>Email:</strong></label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($delivery['Email']); ?>" required>
            </div>
            <div class="profile-item">
                <label for="phone"><strong>Phone:</strong></label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($delivery['Phone']); ?>" required>
            </div>
            <div class="profile-item">
                <label for="vehicle"><strong>Vehicle:</strong></label>
                <input type="text" id="vehicle" name="vehicle" value="<?php echo htmlspecialchars($delivery['Vehicle']); ?>" required>
            </div>
            <div class="profile-item">
                <label for="age"><strong>Age:</strong></label>
                <input type="text" id="age" name="age" value="<?php echo htmlspecialchars($delivery['Age']); ?>" required>
            </div>
            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>
