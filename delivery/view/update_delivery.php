<?php
session_start();
include('../control/update_delivery_control.php');

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: delivery_login.php");
    exit;
}
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

    <h1>Update Delivery Profile</h1>

    <?php if (isset($error)): ?>
    <?php echo htmlspecialchars($error); ?>
    <?php endif; ?>

    <form method="post" action="../control/update_delivery_control.php">
        <input type="hidden" name="delivery_id" value="<?php echo htmlspecialchars($delivery['DeliveryUsername']); ?>">
        <label for="fullName">Full Name:</label>
        <input type="text" name="fullName" value="<?php echo htmlspecialchars($delivery['Fullname']); ?>">
        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($delivery['Email']); ?>">
        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($delivery['Phone']); ?>">
        <label for="vehicle">Vehicle:</label>
        <input type="text" name="vehicle" value="<?php echo htmlspecialchars($delivery['Vehicle']); ?>">
        <label for="age">Age:</label>
        <input type="text" name="age" value="<?php echo htmlspecialchars($delivery['Age']); ?>">
        <button type="submit" name="updateDelivery">Update</button>
    </form>

    <a href="delivery_profile.php">Back to Profile</a>

</body>
</html>
