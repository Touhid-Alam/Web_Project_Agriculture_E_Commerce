<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Registration</title>
    <link rel="stylesheet" type="text/css" href="../css/buyer_reg.css">
</head>
<body>

<h2>Register as a Buyer</h2>

<?php
session_start();
if (isset($_SESSION['registration_error'])) {
    echo $_SESSION['registration_error'];
    unset($_SESSION['registration_error']);
}
session_unset();
session_destroy();
?>

<form action="../control/buyer_control.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
    <fieldset>
        <legend><strong>Account Information</strong></legend>
        <table>
            <tr>
                <td><label for="username">Username:</label></td>
                <td><input type="text" id="username" name="username"></td>
                <td><p id="usernameError"></p></td>
            </tr>
            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" id="password" name="password"></td>
                <td><p id="passwordError"></p></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" name="email"></td>
                <td><p id="emailError"></p></td>
            </tr>
        </table>
    </fieldset>

    <fieldset>
        <legend><strong>Personal Information</strong></legend>
        <table>
            <tr>
                <td><label for="fullName">Full Name:</label></td>
                <td><input type="text" id="fullName" name="fullName"></td>
                <td><p id="fullNameError"></p></td>
            </tr>
            <tr>
                <td><label for="phone">Phone Number:</label></td>
                <td><input type="tel" id="phone" name="phone"></td>
                <td><p id="phoneError"></p></td>
            </tr>
            <tr>
                <td><label for="dateofbirth">Date of Birth:</label></td>
                <td><input type="date" id="dateofbirth" name="dateofbirth"></td>
                <td><p id="dobError"></p></td>
            </tr>
        </table>
    </fieldset>

    <button type="submit">Register as Buyer</button>
</form>

<div class="nav-links">
    <a href="../../layout/view/login.php">Go to login</a>
    <a href="../../layout/view/homepage.php">Go to Home</a>
    <a href="../../layout/view/registration.php">Go Back</a>
</div>

<script src="../js/buyer_reg.js"></script>

</body>
</html>
