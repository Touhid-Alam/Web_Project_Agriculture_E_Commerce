<?php
include '../model/admindb.php';

// Check if the 'EmployeeUsername' parameter is set in the URL
if (isset($_GET['EmployeeUsername'])) {
    $usernameToDelete = $_GET['EmployeeUsername']; // Get the username to delete

    // Create a database connection
    $mydb = new mydb();
    $connobject = $mydb->openCon();

    // Attempt to delete the employee
    if (!empty($usernameToDelete)) {
        $deleteSuccess = $mydb->deleteEmployee("employee", $usernameToDelete, $connobject);

        if ($deleteSuccess) {
            echo "<p>Employee with username '<strong>" . htmlspecialchars($usernameToDelete) . "</strong>' has been deleted successfully.</p>";
        } else {
            echo "<p>Error: Could not delete employee with username '<strong>" . htmlspecialchars($usernameToDelete) . "</strong>'.</p>";
        }
    } else {
        echo "<p>Error: No username provided for deletion.</p>";
    }

    // Close the connection
    $connobject->close();
} else {
    echo "<p>No employee selected for deletion.</p>";
}

echo '<a href="../view/employee_info.php">Go Back</a>';
?>
