<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Admin</title>
</head>
<body>

<h2>View Admin Details</h2>

<form action="../view/admin_view.php" method="POST">
    <fieldset>
        <legend>Search Admin</legend>
        <table>
            <tr>
                <td><label for="viewUsername">Username:</label></td>
                <td><input type="text" id="viewUsername" name="username" required></td>
            </tr>
        </table>
    </fieldset>
    <button type="submit">View Admin</button>
</form>
<?php
    include('../control/admin_view_control.php');
    ?>
<a href="../view/admin_dashboard.php">BACK</a>

</body>
</html>
