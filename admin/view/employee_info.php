<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/info.css">
    <title>Employee Information</title>
</head>
<body>
<div class="main-content">
    <h1>Employee Information</h1>
    <!-- Search Form -->
    <form action="../view/employee_info.php" method="GET">
        <label for="EmployeeUsername">Search by Employee Username:</label>
        <input type="text" id="EmployeeUsername" name="EmployeeUsername">
        <button type="submit">Search</button>
    </form>
   
    <div class="navbar">
        <a href="../view/admin_dashboard.php">Admin</a>
        <a href="../view/seller_info.php">Seller Info</a>
        <a href="../view/buyer_info.php">Buyer Info</a>
        <a href="../view/employee_info.php">Employee Info</a>
        <a href="../view/delivery_info.php">Delivery Man Info</a>
        <a href="../../layout/view/login.php">Logout</a>
    </div>

    <!-- View All Employees -->
    <form action="../view/employee_info.php" method="GET">
        <button type="submit" name="viewAll" value="true">View All Employees</button>
    </form>
    
    <?php
    include('../control/employee_info_control.php');
    ?>
    
    
</div>

</body>
</html>
