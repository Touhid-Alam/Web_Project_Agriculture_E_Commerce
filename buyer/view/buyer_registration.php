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
if (isset($_SESSION['registration_success'])) {
    echo$_SESSION['registration_success'];
    unset($_SESSION['registration_success']);
}
?>

<form id="registrationForm" action="../control/buyer_control.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
    <fieldset>
        <legend><strong>Buyer Information</strong></legend>
        <table>
            <tr>
                <td><label for="fullName">Full Name:</label></td>
                <td>
                    <input type="text" id="fullName" name="fullName">
                    <span id="fullNameError"></span>
                </td>
            </tr>
            <tr>
                <td><label for="username">Username:</label></td>
                <td>
                    <input type="text" id="username" name="username">
                    <span id="usernameError"></span>
                </td>
            </tr>
            <tr>
                <td><label for="password">Password:</label></td>
                <td>
                    <input type="password" id="password" name="password">
                    <span id="passwordError"></span>
                </td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td>
                    <input type="email" id="email" name="email">
                    <span id="emailError"></span>
                </td>
            </tr>
            <tr>
                <td><label for="phone">Phone Number:</label></td>
                <td>
                    <input type="tel" id="phone" name="phone">
                    <span id="phoneError"></span>
                </td>
            </tr>
            <tr>
                <td><label for="dateofbirth">Date of Birth:</label></td>
                <td>
                    <input type="date" id="dateofbirth" name="dateofbirth">
                    <span id="dobError"></span>
                </td>
            </tr>
        </table>
    </fieldset>
    <button type="submit">Register as Buyer</button>
</form>

<a href="../../layout/view/login.php">Go to login</a>
<a href="../../layout/view/homepage.php">Go to home</a>

<script src="../js/buyer_reg.js"></script>

</body>
</html>
