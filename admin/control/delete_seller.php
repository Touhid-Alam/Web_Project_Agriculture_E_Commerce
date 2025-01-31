<?php
include '../model/admindb.php';

// Check if the 'SellerUsername' parameter is set in the URL
if (isset($_GET['SellerUsername'])) {
    $usernameToDelete = $_GET['SellerUsername']; // Get the username to delete

    // Create a database connection
    $mydb = new mydb();
    $connobject = $mydb->openCon();

    // Attempt to delete the seller
    if (!empty($usernameToDelete)) {
        $deleteSuccess = $mydb->deleteSeller("seller", $usernameToDelete, $connobject);

        if ($deleteSuccess) {
            echo "<p>Seller with username '<strong>" . htmlspecialchars($usernameToDelete) . "</strong>' has been deleted successfully.</p>";
        } else {
            echo "<p>Error: Could not delete seller with username '<strong>" . htmlspecialchars($usernameToDelete) . "</strong>'.</p>";
        }
    } else {
        echo "<p>Error: No username provided for deletion.</p>";
    }

    // Close the connection
    $connobject->close();
} else {
    echo "<p>No seller selected for deletion.</p>";
}

echo '<a href="../view/seller_info.php">Go Back</a>';
?>
