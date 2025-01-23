
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Information</title>
</head>
<body>
    <h1>Seller Information</h1>
    <!-- Search Form -->
    <form action="../view/seller_info.php" method="GET">
        <label for="SellerUsername">Search by Seller Username:</label>
        <input type="text" id="SellerUsername" name="SellerUsername">
        <button type="submit">Search</button>
    </form>
   
    <hr>

    <!-- View All Sellers -->
    <form action="../view/seller_info.php" method="GET">
        <button type="submit" name="viewAll" value="true">View All Sellers</button>
    </form>
    <?php
    include('../control/seller_info_control.php');
    ?>
<a href="../view/admin_dashboard.php">BACK</a>
</body>
</html>
