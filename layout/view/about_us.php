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
    <title>About Us - Agriculture E-Commerce System</title>
    <link rel="stylesheet" href="../css/homepage.css">
</head>
<body>
    <div class="navbar">
        <a href="homepage.php">Home</a>
        <a href="about_us.php">About Us</a>
        <a href="contact_us.php">Contact Us</a>
        <a href="login.php" class="login">Login</a>
        <a href="registration.php" class="registration">Registration</a>
    </div>

    <div class="container">
        <h1>About Us</h1>
        <p>Welcome to the Agriculture E-Commerce System. We are dedicated to connecting farmers and consumers directly.</p>
        <button onclick="window.location.href='homepage.php'">Back to Home</button>
    </div>
</body>
</html>
