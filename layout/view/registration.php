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
</head>
<body>
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
    <button onclick="window.location.href='homepage.php'">Back to Home</button>
</body>
</html>
