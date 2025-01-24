<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Agriculture E-Commerce System</title>
    <script src="../js/login_validation.js"></script>
</head>
<body>
    <h1>Login</h1>
    <?php
    session_start();
    if (isset($_SESSION['login_error'])) {
        echo  $_SESSION['login_error'];
        unset($_SESSION['login_error']);
    }
    ?>
    <form action="../control/login_control.php" method="POST" onsubmit="return validateLogin()">
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
                <td><label for="usertype">User Type:</label></td>
                <td>
                    <select id="usertype" name="usertype">
                        <option value="">Select user type</option>
                        <option value="admin">Admin</option>
                        <option value="buyer">Buyer</option>
                        <option value="seller">Seller</option>
                        <option value="employee">Employee</option>
                        <option value="delivery">Delivery Person</option>
                    </select>
                </td>
                <td><p id="usertypeError"></p></td>
            </tr>
        </table>
        <button type="submit">Login</button>
    </form>

    <a href="registration.php">New user? Register here</a>
    <br>
    
    <button onclick="window.location.href='homepage.php'">Back to Home</button>

</body>
</html>
