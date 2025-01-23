<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Care Registration</title>
</head>
<body>
<?php include '../control/employee_reg_control.php'; ?>
<h2>Register as Customer Care</h2>
 
<!-- Employee Registration Section -->
<h3>Employee Registration</h3>
<form action="../control/employee_reg_control.php" method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend><strong>Employee Information</strong></legend>
        <table>
            <tr>
                <td><label for="empUsername">Username:</label></td>
                <td><input type="text" id="empUsername" name="username" ></td>
            </tr>
            <tr>
                <td><label for="empPassword">Password:</label></td>
                <td><input type="password" id="empPassword" name="password" ></td>
            </tr>
            <tr>
                <td><label for="empEmail">Email:</label></td>
                <td><input type="email" id="empEmail" name="email" ></td>
            </tr>
            <tr>
                <td><label for="empPhone">Phone Number:</label></td>
                <td><input type="tel" id="empPhone" name="phone" ></td>
            </tr>
            <tr>
                <td><label for="empFullName">Full Name:</label></td>
                <td><input type="text" id="empFullName" name="fullName" ></td>
            </tr>
            <tr>
                <td><label for="empWorkShift">Work Shift:</label></td>
                <td><input type="text" id="empWorkShift" name="workShift" ></td>
            </tr>
            <tr>
                <td><label for="empCV">CV:</label></td>
                <td><input type="file" id="empCV" name="cv" accept=".pdf,.doc,.docx" ></td>
            </tr>
            <tr>
                <td><label for="empAge">Age:</label></td>
                <td><input type="number" id="empAge" name="age" ></td>
            </tr>
        </table>
    </fieldset>
 
    <button type="submit">Register as Employee</button>
</form>
<a href="../../layout/view/login.php">Go to login</a>
 
<a href="../../layout/view/homepage.php">Go to Home</a>
 
</body>
</html>