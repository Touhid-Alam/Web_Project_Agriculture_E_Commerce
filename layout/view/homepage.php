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
    <title>Home - Agriculture E-Commerce System</title>
</head>
<body>
    <h1>Welcome to the Agriculture E-Commerce System</h1>
    <p>Select an option below:</p>
    <br>

    <table>
        <tr>
            <td><button onclick="location.href='about_us.php'">About Us</button></td>
        </tr>
        <tr>
            <td><button onclick="location.href='login.php'">Login</button></td>
        </tr>
        <tr>
            <td><button onclick="location.href='registration.php'">Registration</button></td>
        </tr>
        <tr>
            <td><button onclick="location.href='contact_us.php'">Contact Us</button></td>
        </tr>
    </table>
</body>
</html>
