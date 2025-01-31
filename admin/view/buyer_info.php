<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Information</title>
</head>
<body>
    <h1>Buyer Information</h1>
    <!-- Search Form -->
    <form action="../view/buyer_info.php" method="GET">
        <label for="BuyerUsername">Search by Buyer Username:</label>
        <input type="text" id="BuyerUsername" name="BuyerUsername">
        <button type="submit">Search</button>
    </form>
   
    <hr>

    <!-- View All Buyers -->
    <form action="../view/buyer_info.php" method="GET">
        <button type="submit" name="viewAll" value="true">View All Buyers</button>
    </form>
    <?php
    include('../control/buyer_info_control.php');
    ?>
<a href="../view/admin_dashboard.php">BACK</a>
</body>
</html>
