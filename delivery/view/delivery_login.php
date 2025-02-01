<?php
session_start(); // Start session to retrieve session messages
// On each page where you want to clear session
if (isset($_SESSION['username'])) {
    session_unset();  // Unset session variables
    session_destroy();  // Destroy session
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Login - Agriculture E-Commerce System</title>
    <link rel="stylesheet" type="text/css" href="../css/deliver_login.css">
    <script src="../js/delivery_login.js"></script>
</head>
<body>
    <h1>Delivery Login to Agriculture E-Commerce System</h1>

    <?php
    // Display success or error message if available
    if (isset($_SESSION['registration_success'])) {
        echo $_SESSION['registration_success'];
        unset($_SESSION['registration_success']); // Clear the session message after displaying it
    }

    if (isset($_SESSION['error_message'])) {
        echo $_SESSION['error_message'];
        unset($_SESSION['error_message']); // Clear the error message after displaying it
    }
    ?>

    <form id="loginForm" action="../control/delivery_login_control.php" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="username">Username:</label></td>
                <td><input type="text" id="username" name="username" required></td>
            </tr>
            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" id="password" name="password" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <button type="submit">Login</button>
                </td>
            </tr>
        </table>
    </form>
    <p class="center-text">Don't have a Delivery account? <a href="delivery.php" class="register-link">Register here</a></p>
    <br>
    <button class="back-to-home" onclick="location.href='delivery_home.php'">Back to Home</button>
</body>
</html>
