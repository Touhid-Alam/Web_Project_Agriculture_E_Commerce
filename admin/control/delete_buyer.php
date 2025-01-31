<?php
include '../model/admindb.php';

// Check if the 'BuyerUsername' parameter is set in the URL
if (isset($_GET['BuyerUsername'])) {
    $usernameToDelete = $_GET['BuyerUsername']; // Get the username to delete

    // Create a database connection
    $mydb = new mydb();
    $connobject = $mydb->openCon();

    // Attempt to delete the buyer
    if (!empty($usernameToDelete)) {
        $deleteSuccess = $mydb->deleteBuyer("buyer", $usernameToDelete, $connobject);

        if ($deleteSuccess) {
            echo "<p>Buyer with username '<strong>" . htmlspecialchars($usernameToDelete) . "</strong>' has been deleted successfully.</p>";
        } else {
            echo "<p>Error: Could not delete buyer with username '<strong>" . htmlspecialchars($usernameToDelete) . "</strong>'.</p>";
        }
    } else {
        echo "<p>Error: No username provided for deletion.</p>";
    }

    // Close the connection
    $connobject->close();
} else {
    echo "<p>No buyer selected for deletion.</p>";
}

echo '<a href="../view/buyer_info.php">Go Back</a>';
?>
