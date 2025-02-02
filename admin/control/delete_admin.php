<?php
include '../model/admindb.php';

// Check if the 'AdminUsername' parameter is set in the URL
if (isset($_GET['AdminUsername'])) {
    $usernameToDelete = $_GET['AdminUsername']; // Get the admin username to delete

    // Create a database connection
    $mydb = new mydb();
    $connobject = $mydb->openCon();

    // Attempt to delete the admin
    if (!empty($usernameToDelete)) {
        $deleteSuccess = $mydb->deleteAdmin("admin", $usernameToDelete, $connobject);

        if ($deleteSuccess) {
            echo "<p>Admin with username '<strong>" . htmlspecialchars($usernameToDelete) . "</strong>' has been deleted successfully.</p>";
        } else {
            echo "<p>Error: Could not delete admin with username '<strong>" . htmlspecialchars($usernameToDelete) . "</strong>'.</p>";
        }
    } else {
        echo "<p>Error: No username provided for deletion.</p>";
    }

    // Close the connection
    $connobject->close();
} else {
    echo "<p>No admin selected for deletion.</p>";
}

echo '<a href="../view/admin_info.php">Go Back</a>';
?>
