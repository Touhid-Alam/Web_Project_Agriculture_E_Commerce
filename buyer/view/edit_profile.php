<?php
session_start();
include('../control/buyer_edit_control.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buyer Profile</title>
    
</head>
<body>

<h1>Edit Profile</h1>

<form action="../control/buyer_edit_control.php" method="post" enctype="multipart/form-data" onsubmit="return validateBuyerForm()">
    <fieldset>
        <legend><strong>Account Information</strong></legend>
        <table>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" name="email" id="email" value="<?php echo htmlspecialchars($buyer['email'] ?? ''); ?>"></td>
                <td><p id="emailError"></p></td>
            </tr>
            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" name="password" id="password" value="<?php echo htmlspecialchars($buyer['password'] ?? ''); ?>"></td>
                <td><p id="passwordError"></p></td>
            </tr>
        </table>
    </fieldset>

    <fieldset>
        <legend><strong>Personal Information</strong></legend>
        <table>
            <tr>
                <td><label for="fullName">Full Name:</label></td>
                <td><input type="text" name="fullName" id="fullName" value="<?php echo htmlspecialchars($buyer['fullName'] ?? ''); ?>"></td>
                <td><p id="fullNameError"></p></td>
            </tr>
            <tr>
                <td><label for="phone">Phone:</label></td>
                <td><input type="tel" name="phone" id="phone" value="<?php echo htmlspecialchars($buyer['phone'] ?? ''); ?>"></td>
                <td><p id="phoneError"></p></td>
            </tr>
            <tr>
                <td><label for="dateOfBirth">Date of Birth:</label></td>
                <td><input type="date" name="dateOfBirth" id="dateOfBirth" value="<?php echo htmlspecialchars($buyer['dateOfBirth'] ?? ''); ?>"></td>
                <td><p id="dateOfBirthError"></p></td>
            </tr>
        </table>
    </fieldset>

    <button type="submit">Update Profile</button>
</form>

<button onclick="location.href='buyer_profile.php'">Go Back</button>

</body>
</html>
