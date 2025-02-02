<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/info.css">
    <title>Admin Information</title>
</head>
<body>

<div class="main-content"> 

<h1>Admin Information</h1>
    <!-- Search Form -->
    <form action="../view/admin_info.php" method="GET">
        <label for="AdminUsername">Search by Admin Username:</label>
        <input type="text" id="AdminUsername" name="AdminUsername">
        <button type="submit">Search</button>
    </form>
   
    <div class="navbar">
        <a href="../view/admin_dashboard.php">Admin</a>
        <a href="../../layout/view/login.php">Logout</a>
    </div>

    <!-- View All Admins -->
    <form action="../view/admin_info.php" method="GET">
        <button type="submit" name="viewAll" value="true">View All Admins</button>
    </form>
    <?php
    include('../control/admin_info_control.php');
    ?>

</div>
</body>
</html>
