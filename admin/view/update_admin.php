<?php
session_start();
include '../model/admindb.php';

if (isset($_GET['AdminUsername'])) {
    $AdminUsername = trim($_GET['AdminUsername']);
    
    // Create a database connection
    $mydb = new mydb();
    $connobject = $mydb->openCon();

    // Fetch admin data
    $result = $mydb->searchAdmin("admin", $AdminUsername, $connobject);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No admin found!";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Admin Information</title>
    <link rel="stylesheet" href="../css/info.css">
</head>
<body>

<div class="main-content">
    <fieldset>
        <h1>Admin Details</h1>
        <table border="1">
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr><td>Admin Username:</td><td><?php echo htmlspecialchars($row['AdminUsername']); ?></td></tr>
            <tr><td>Email:</td><td><?php echo htmlspecialchars($row['Email']); ?></td></tr>
            <tr><td>Full Name:</td><td><?php echo htmlspecialchars($row['Fullname']); ?></td></tr>
            <tr><td>ID:</td><td><a href="<?php echo htmlspecialchars($row['NID']); ?>" target="_blank">View ID Proof</a></td></tr>
        </table>
    </fieldset>
    <a href="../view/admin_info.php">Back to Admin List</a>
</div>

<div class="navbar">
    <a href="../view/admin_dashboard.php">Admin</a>
    <a href="../../layout/view/login.php">Logout</a>
</div>

<div class="main-content">
    <fieldset>
    <script src="../adminJS/admin_update.js"></script>
        <h1>Update Admin Information</h1>
        <form action="../control/update_admin.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="AdminUsername" value="<?php echo htmlspecialchars($row['AdminUsername']); ?>">
            
            <table>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" id="password" name="Password" ></td>
                    <td><p id="PasswordlError"class="error"></p></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" id="email" name="Email" ></td>
                    <td><p id="EmailError"class="error"></p></td>
                </tr>
                <tr>
                    <td><label for="fullname">Full Name:</label></td>
                    <td><input type="text" id="fullname" name="Fullname" ></td>
                    <td><p id="FullnameError"class="error"></p></td>
                </tr>
                <tr>
                    <td><label for="NID">NID Proof:</label></td>
                    <td><input type="file" id="NID" name="NID" accept=".jpg,.jpeg,.png,.pdf"></td>
                    <td><p id="NIDlError"class="error"></p></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit" name="update">Update Admin</button></td>
                </tr>
            </table>
        </form>
    </fieldset>
</div>

</body>
</html>
