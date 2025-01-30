<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Person Registration</title>
    <link rel="stylesheet" type="text/css" href="../css/delivery_registration.css">
</head>
<body>

<h2>Register as Delivery Person</h2>

<?php include '../control/delivery_reg_control.php'; ?>

<form action="../control/delivery_reg_control.php" method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend><strong>Delivery Person Information</strong></legend>
        <table>
            <tr>
                <td><label for="delUsername">Username:</label></td>
                <td><input type="text" id="delUsername" name="username"></td>
                <td><p id="usernameError"></p></td>
            </tr>
            <tr>
                <td><label for="delPassword">Password:</label></td>
                <td><input type="password" id="delPassword" name="password"></td>
                <td><p id="passwordError"></p></td>
            </tr>
            <tr>
                <td><label for="delEmail">Email:</label></td>
                <td><input type="email" id="delEmail" name="email"></td>
                <td><p id="emailError"></p></td>
            </tr>
            <tr>
                <td><label for="delPhone">Phone Number:</label></td>
                <td><input type="tel" id="delPhone" name="phone"></td>
                <td><p id="phoneError"></p></td>
            </tr>
            <tr>
                <td><label for="delFullName">Full Name:</label></td>
                <td><input type="text" id="delFullName" name="fullName"></td>
                <td><p id="fullNameError"></p></td>
            </tr>
            <tr>
                <td><label for="idProof">Cv :</label></td>
                <td><input type="file" id="idProof" name="idProof"></td>
            </tr>
            <tr>
                <td><label for="delVehicle">Do you have a vehicle?</label></td>
                <td>
                    <input type="radio" id="vehicleYes" name="vehicle" value="yes">
                    <label for="vehicleYes">Yes</label>
                    <input type="radio" id="vehicleNo" name="vehicle" value="no">
                    <label for="vehicleNo">No</label>
                </td>
                <td><p id="vehicleError"></p></td>
            </tr>
            <tr>
                <td><label for="delAge">Age:</label></td>
                <td><input type="number" id="delAge" name="age"></td>
                <td><p id="ageError"></p></td>
            </tr>
        </table>
    </fieldset>
 
    <button type="submit" class="register-button">Register as Delivery Person</button>
</form>
<div class="nav-links">
    <a href="../../layout/view/login.php">Go to login</a>
    <a href="../../layout/view/homepage.php">Go to Home</a>
    <a href="../../layout/view/registration.php">Go Back</a>
</div>
<script src="../js/delivery_reg.js"></script>
</body>
</html>