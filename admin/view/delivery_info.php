<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Information</title>
</head>
<body>
    <h1>Delivery Information</h1>
    <!-- Search Form -->
    <form action="../view/delivery_info.php" method="GET">
        <label for="DeliveryUsername">Search by Deliveryman:</label>
        <input type="text" id="DeliveryUsername" name="DeliveryUsername">
        <button type="submit">Search</button>
    </form>
   
    <hr>

    <!-- View All Sellers -->
    <form action="../view/delivery_info.php" method="GET">
        <button type="submit" name="viewAll" value="true">View All Delivery Man</button>
    </form>
    <?php
    include('../control/delivery_info_control.php');
    ?>
<a href="../view/admin_dashboard.php">BACK</a>
</body>
</html>