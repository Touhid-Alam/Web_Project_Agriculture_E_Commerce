<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <script src="../adminJS/admin_reg.js"></script>
    <link rel="stylesheet" href="../css/admin_reg.css">

</head>
<body>

<h2>Admin Registration</h2>

<form action="../control/admin_reg_control.php" method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend>Admin Information</legend>
        <table>
            
            <tr>
                <td><label for="adminUsername">Username:</label></td>
                <td><input type="text" id="adminUsername" name="username" required></td>
                <td><p id="usernameError"></p></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" name="email" required></td>
                <td><p id="emailError"></p></td>
            </tr>
            <tr>
                <td><label for="adminPassword">Password:</label></td>
                <td><input type="password" id="adminPassword" name="password" required></td>
                <td><p id="passwordError"></p></td>
            </tr>
            <tr>
                <td><label for="adminFullname">Full Name:</label></td>
                <td><input type="text" id="adminFullname" name="fullname" required></td>
                <td><p id="fullNameError"></p></td>
            </tr>
           
            <tr>
                <td><label for="idProof">Upload NID:</label></td>
                <td><input type="file" id="idProof" name="idProof" required></td>
            </tr>
        </table>
    </fieldset>

    <button type="submit">Register as Admin</button>
    <tr>
            <td><a href="../../layout/view/homepage.php">Go Home</a></td>
            <td><a href="../../layout/view/login.php">Go to login</a></td>
    </tr>
</form>

</body>
</html>

