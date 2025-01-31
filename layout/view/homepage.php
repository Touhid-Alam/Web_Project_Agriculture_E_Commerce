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
    <link rel="stylesheet" href="../css/homepage.css">
    <script src="../js/hom.js" defer></script>
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
    <div class="container">
        <h1>Welcome to the Agriculture E-Commerce System</h1>
        <p>Empowering farmers and consumers through a seamless digital marketplace.</p>

        <div class="info-section">
            <h2>About Our Platform</h2>
            <p>
                The <strong>Agriculture E-Commerce System</strong> is designed to connect farmers, buyers, and suppliers in a single, 
                efficient online platform. Our goal is to promote fair trade, reduce wastage, and enhance accessibility of 
                fresh agricultural products.
            </p>
            <p>
                Whether you are a farmer looking to sell your produce or a consumer searching for fresh and organic goods, 
                our platform offers a secure, transparent, and efficient shopping experience.
            </p>
        </div>

        <div class="features">
            <h2>Key Features</h2>
            <ul>
                <li>🌱 Direct Farmer-to-Buyer Transactions</li>
                <li>🚚 Efficient Delivery System</li>
                <li>💰 Fair Pricing with No Middlemen</li>
                <li>🔍 Easy Product Search and Filters</li>
                <li>🛒 Secure Payment Options</li>
            </ul>
        </div>

        <div id="load-more-content"></div>
    </div>

</body>
</html>
