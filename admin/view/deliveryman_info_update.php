<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Man Information</title>
</head>
<body>
    <h1>Update Delivery Man Information</h1>
    <form action="deliveryman_update.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend><strong>Delivery Man Information</strong></legend>
            <table>
                <tr>
                    <td><label for="delUsername">Username:</label></td>
                    <td>
                        <input type="text" id="delUsername" name="username">
                        <span id="error" class="error-message"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="delPassword">Password:</label></td>
                    <td>
                        <input type="password" id="delPassword" name="password">
                        <span id="passError" class="error-message"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="delEmail">Email:</label></td>
                    <td>
                        <input type="email" id="delEmail" name="email">
                        <span id="emailError" class="error-message"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="delPhone">Phone Number:</label></td>
                    <td>
                        <input type="tel" id="delPhone" name="phone">
                        <span id="phoneError" class="error-message"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="delFullName">Full Name:</label></td>
                    <td>
                        <input type="text" id="delFullName" name="fullName">
                        <span id="fullNameError" class="error-message"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="idProof">CV:</label></td>
                    <td><input type="file" id="idProof" name="idProof"></td>
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
                        <input type="number" id="delAge" name="age">
                        <span id="ageError" class="error-message"></span>
                    </td>
                </tr>
            </table>
        </fieldset>
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
