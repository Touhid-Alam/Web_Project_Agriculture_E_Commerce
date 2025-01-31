<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['username'])) {
    header("Location:../../layout/view/login.php"); // Redirect to login page if not logged in
    
}
$adminUsername = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>

<div style="text-align: right;">
    <a href="../view/admin_profile.php">Admin Profile</a>
</div>

<h1>Welcome, <?php echo $adminUsername; ?></h1>

<nav>
    <ul>
        <li><a href="../view/admin_view.php">View Admin Info</a></li>
        <li><a href="../../layout/view/login.php">Logout</a></li>
    </ul>
</nav>

<section>
    <h2>Dashboard Features</h2>
    <p>Here you can manage admins, view reports, and perform other administrative tasks.</p>
    <ul>
        <li><a href="../view/seller_info.php">Seller Info</a></li>
        <li><a href="../view/buyer_info.php">Buyer Info</a></li>
        <li><a href="../view/employee_info.php">Employe Info</a></li>
        <li><a href="../view/delivery_info.php">Delivery Man Info</a></li>
    </ul>
</section>

</body>
</html>
