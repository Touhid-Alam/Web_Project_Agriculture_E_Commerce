<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Care Registration</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">

    
</head>
<body>
<?php include '../control/delivery_reg_control.php'; ?>
<h2>Register as Customer Care</h2>
<!-- Delivery Man Registration Section -->
<h3>Delivery Man Registration</h3>
<form id="registrationForm" action="../control/delivery_reg_control.php" method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend><strong>Delivery Man Information</strong></legend>
        <table>
            <tr>
                <td><label for="delUsername">Username:</label></td>
                <td>
                    <input type="text" id="delUsername" name="username" >
                    <span id="error" class="error-message"></span>
                </td>
            </tr>
            <tr>
                <td><label for="delPassword">Password:</label></td>
                <td>
                    <input type="password" id="delPassword" name="password" >
                    <span id="passError" class="error-message"></span>
                </td>
            </tr>
            <tr>
                <td><label for="delEmail">Email:</label></td>
                <td>
                    <input type="email" id="delEmail" name="email" >
                    <span id="emailError" class="error-message"></span>
                </td>
            </tr>
            <tr>
                <td><label for="delPhone">Phone Number:</label></td>
                <td>
                    <input type="tel" id="delPhone" name="phone" >
                    <span id="phoneError" class="error-message"></span>
                </td>
            </tr>
            <tr>
                <td><label for="delFullName">Full Name:</label></td>
                <td>
                    <input type="text" id="delFullName" name="fullName" >
                    <span id="fullNameError" class="error-message"></span>
                </td>
            </tr>
            <tr>
                <td><label for="idProof">Cv :</label></td>
                <td><input type="file" id="idProof" name="idProof" ></td>
            </tr>
            <tr>
                <td><label for="delVehicle">Do you have a vehicle?</label></td>
                <td>
                    <input type="radio" id="vehicleYes" name="vehicle" value="yes">
                    <label for="vehicleYes">Yes</label>
                    <input type="radio" id="vehicleNo" name="vehicle" value="no">
                    <label for="vehicleNo">No</label>
                    <span id="vehicleError" class="error-message"></span>
                </td>
            </tr>
            <tr>
                <td><label for="delAge">Age:</label></td>
                <td>
                    <input type="number" id="delAge" name="age" >
                    <span id="ageError" class="error-message"></span>
                </td>
            </tr>
        </table>
    </fieldset>
 
    <button type="submit" class="register-button">Register as Delivery Man</button>
</form>
<div class="center-buttons">
    <a href="../../layout/view/login.php" class="login-button">Go to login</a>
    <a href="../../layout/view/homepage.php" class="back-button">Go to Home</a>
</div>
<script src="../js/delivery_reg.js"></script>
</body>
</html>