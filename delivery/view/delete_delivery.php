<?php
session_start();
include('../control/delete_delivery_control.php');

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
    <title>Delete Delivery Profile</title>
    <link rel="stylesheet" type="text/css" href="../css/deliver_profile.css">
</head>
<body>

    <h1>Delete Delivery Profile</h1>

    <?php if (isset($error)): ?>
        <?php echo htmlspecialchars($error); ?>
    <?php endif; ?>

    <form method="post" action="../control/delete_delivery_control.php">
        <input type="hidden" name="delivery_id" value="<?php echo htmlspecialchars($delivery['DeliveryUsername']); ?>">
        <p>Are you sure you want to delete this profile?</p>
        <button type="submit" name="deleteDelivery">Delete</button>
    </form>

    <a href="delivery_profile.php">Back to Profile</a>

</body>
</html>
