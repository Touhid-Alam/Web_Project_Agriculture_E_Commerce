<?php
session_start();
include '../model/admindb.php';

// Redirect if the admin is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../view/admin_login.php");
    exit;
}
$username = $_SESSION['username'];

// Create a new database object and open connection
$mydb = new mydb();
$connobject = $mydb->openCon();

// Fetch admin details from the database
$result = $mydb->getAdminInfo("admin", $username, $connobject);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No admin found!";
        exit();
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
    
</div>

<div class="navbar">
    <a href="../view/admin_dashboard.php">Admin</a>
    <a href="../../layout/view/login.php">Logout</a>
</div>

</body>
</html>
