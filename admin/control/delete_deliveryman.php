<?php
include '../model/admindb.php';

// Check if the 'DeliverymanUsername' parameter is set in the URL
if (isset($_GET['DeliveryUsername'])) {
    $DeliveryUsername = $_GET['DeliveryUsername']; // Get the username to delete

    // Create a database connection
    $mydb = new mydb();
    $connobject = $mydb->openCon();

    // Attempt to delete the deliveryman
    if (!empty($DeliveryUsername)) {
        $deleteSuccess = $mydb->deleteDeliveryman("deliveryman", $DeliveryUsername, $connobject);

        if ($deleteSuccess) {
            echo "<p>Deliveryman with username '<strong>" . htmlspecialchars($DeliveryUsername) . "</strong>' has been deleted successfully.</p>";
        } else {
            echo "<p>Error: Could not delete deliveryman with username '<strong>" . htmlspecialchars($DeliveryUsername) . "</strong>'.</p>";
        }
    } else {
        echo "<p>Error: No username provided for deletion.</p>";
    }

    // Close the connection
    $connobject->close();
} else {
    echo "<p>No deliveryman selected for deletion.</p>";
}

echo '<a href="../view/delivery_info.php">Go Back</a>';
?>
