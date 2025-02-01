<?php
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

 $adminDetails = $result->fetch_assoc();

 echo "<h3>Admin Information</h3>";
 echo "<table border='1' cellspacing='0' cellpadding='5'>";
 echo "<tr><th>Field</th><th>Details</th></tr>";
 echo "<tr><td>Username</td><td>" . ($adminDetails['AdminUsername']) . "</td></tr>";
 echo "<tr><td>Email</td><td>" . ($adminDetails['Email']) . "</td></tr>";
 echo "<tr><td>Full Name</td><td>" .($adminDetails['Fullname']) . "</td></tr>";
 echo "<tr><td>ID Proof</td><td><a href='" .($adminDetails['NID']) . "' target='_blank'>View ID Proof</a></td></tr>";
 echo "</table>";
 echo '<button onclick="window.location.href=\'../view/admin_update.php\';">Edit</button>';


// Close the database connection
$connobject->close();

// Include the HTML page to display the admin profile

?>








