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
    <title>Contact Us - Agriculture E-Commerce System</title>
</head>
<body>
    <h1>Contact Us</h1>
    <p>If you have any questions, feel free to reach out to us at support@agriculture-ecommerce.com.</p>
    <button onclick="window.location.href='homepage.php'">Back to Home</button>
</body>
</html>
