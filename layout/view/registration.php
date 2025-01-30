<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Agriculture E-Commerce System</title>
    <link rel="stylesheet" href="../css/registration.css">
</head>
<body>

    <!-- Navigation Bar -->
    <div class="navbar">
        <a href="homepage.php">Home</a>
        <a href="about_us.php">About Us</a>
        <a href="contact_us.php">Contact Us</a>
        <a href="login.php" class="login">Login</a>
        <a href="registration.php" class="registration">Registration</a>
    </div>

    <!-- Main Content -->
    <h1>Registration</h1>
    <p>Select an option below:</p>
    <br>

    <table>
        <tr>
            <td><button onclick="location.href='../../buyer/view/buyer_registration.php'">Buyer Registration</button></td>
        </tr>
        <tr>
            <td><button onclick="location.href='../../seller/view/seller_registration.php'">Seller Registration</button></td>
        </tr>
        <tr>
            <td><button onclick="location.href='../../employee/view/employee.php'">Employee Registration</button></td>
        </tr>
        <tr>
            <td><button onclick="location.href='../../delivery/view/delivery.php'">Delivery Person Registration</button></td>
        </tr>
        <tr>
            <td><button onclick="location.href='../../admin/view/admin_reg.php'">Admin Registration</button></td>
        </tr>
    </table>

    <br>
    <a href="homepage.php" class="home-button">Back to Home</a>
</body>
</html>
