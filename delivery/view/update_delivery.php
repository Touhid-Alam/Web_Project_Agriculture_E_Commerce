<?php
session_start();
include('../control/update_delivery_control.php');

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../../layout/view/login.php");
    exit;
}

// Fetch delivery details from session
$delivery = isset($_SESSION['delivery']) ? $_SESSION['delivery'] : null;
$error = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : null;
unset($_SESSION['error_message']); // Clear the error message after fetching it
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Delivery Profile</title>
    <link rel="stylesheet" type="text/css" href="../css/deliver_profile.css">
    <script src="../js/update_delivery.js"></script>
</head>
<body>

    <div class="navbar">
        <a href="delivery_profile.php">Profile</a>
        <a href="delivery_orders.php">Orders</a>
        <a href="../../layout/view/login.php">Logout</a>
    </div>

    <div class="main-content">
        <h1>Update Delivery Profile</h1>

        <?php if ($error): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="post" action="../control/update_delivery_control.php" class="update-form">
            <input type="hidden" name="delivery_id" value="<?php echo htmlspecialchars($delivery['DeliveryUsername']); ?>">
            <table class="update-table">
                <tr>
                    <td><label for="fullName">Full Name:</label></td>
                    <td><input type="text" name="fullName" value="<?php echo htmlspecialchars($delivery['Fullname']); ?>"></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="text" name="email" value="<?php echo htmlspecialchars($delivery['Email']); ?>"></td>
                </tr>
                <tr>
                    <td><label for="phone">Phone:</label></td>
                    <td><input type="text" name="phone" value="<?php echo htmlspecialchars($delivery['Phone']); ?>"></td>
                </tr>
                <tr>
                    <td><label for="vehicle">Vehicle:</label></td>
                    <td><input type="text" name="vehicle" value="<?php echo htmlspecialchars($delivery['Vehicle']); ?>"></td>
                </tr>
                <tr>
                    <td><label for="age">Age:</label></td>
                    <td><input type="text" name="age" value="<?php echo htmlspecialchars($delivery['Age']); ?>"></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit" name="updateDelivery">Update</button></td>
                </tr>
            </table>
        </form>

        <a href="delivery_profile.php">Back to Profile</a>
    </div>

</body>
</html>
