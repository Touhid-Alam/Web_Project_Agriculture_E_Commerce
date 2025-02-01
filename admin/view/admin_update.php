<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Admin</title>
</head>
<body>

<h2>Update Admin Details</h2>

<form action="../control/admin_update_control.php" method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend>Update Admin Information</legend>
        <table>
            <tr>
                <td><label for="updateUsername">Username:</label></td>
                <td><input type="text" id="updateUsername" name="username" required></td>
            </tr>
            <tr>
                <td><label for="updateEmail">Email:</label></td>
                <td><input type="email" id="updateEmail" name="email" required></td>
            </tr>
            <tr>
                <td><label for="updatePassword">Password:</label></td>
                <td><input type="password" id="updatePassword" name="password" required></td>
            </tr>
            <tr>
                <td><label for="updateFullName">Full Name:</label></td>
                <td><input type="text" id="updateFullName" name="fullname" required></td>
            </tr>
            <tr>
                <td><label for="updateIDProof">ID Proof:</label></td>
                <td><input type="file" id="updateIDProof" name="idProof"></td>
            </tr>
        </table>
    </fieldset>
    <button type="submit">Update Admin</button>
</form>
<a href="../view/admin_profile.php">BACK</a>
</body>
</html>
