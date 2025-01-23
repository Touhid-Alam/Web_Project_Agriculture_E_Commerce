<?php
include '../model/admindb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);


    
    $mydb = new mydb();
    $connobject = $mydb->openCon();

    
    $result = $mydb->viewAdmin("admin", $username, $connobject);

    // Check if the admin exists
    if ($result->num_rows > 0) {
        
        $adminDetails = $result->fetch_assoc();

        echo "<h3>Admin Information</h3>";
        echo "<table border='1' cellspacing='0' cellpadding='5'>";
        echo "<tr><th>Field</th><th>Details</th></tr>";
        echo "<tr><td>Username</td><td>" . ($adminDetails['AdminUsername']) . "</td></tr>";
        echo "<tr><td>Email</td><td>" . ($adminDetails['Email']) . "</td></tr>";
        echo "<tr><td>Full Name</td><td>" .($adminDetails['Fullname']) . "</td></tr>";
        echo "<tr><td>ID Proof</td><td><a href='" .($adminDetails['NID']) . "' target='_blank'>View ID Proof</a></td></tr>";
        echo "</table>";
    } else {
        echo "No admin found with the username: " . ($username);
    }

   
    $connobject->close();
}
?>
