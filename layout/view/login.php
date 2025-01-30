<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Agriculture E-Commerce System</title>
    <link rel="stylesheet" href="../css/login.css">
    <script src="../js/login_validation.js"></script>
</head>
<body>
    <div class="container">
        <h1>Login Here</h1>
        <?php
        session_start();
        if (isset($_SESSION['username'])) {
            session_unset();
            session_destroy();
        }
        if (isset($_SESSION['login_error'])) {
            echo '<p class="error">' . $_SESSION['login_error'] . '</p>';
            unset($_SESSION['login_error']);
        }
        if (isset($_SESSION['registration_success'])) {
            echo '<p class="success">' . $_SESSION['registration_success'] . '</p>';
            unset($_SESSION['registration_success']);
        }
        ?>
        <form action="../control/login_control.php" method="POST" onsubmit="return validateLogin()">
            <table>
                <tr>
                    <td><label for="username">Username:</label></td>
                    <td><input type="text" id="username" name="username"></td>
                </tr>
                <tr>
                    <td colspan="2"><p id="usernameError" class="error"></p></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" id="password" name="password"></td>
                </tr>
                <tr>
                    <td colspan="2"><p id="passwordError" class="error"></p></td>
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
                </tr>
                <tr>
                    <td colspan="2"><p id="usertypeError" class="error"></p></td>
                </tr>
            </table>
            <button type="submit">Login</button>
        </form>

        <a href="homepage.php" class="home-button">Back to Home</a>
        <a href="registration.php" class="register">New user? Register here</a>
    </div>
</body>
</html>
