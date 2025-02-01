<?php
include '../model/admindb.php';

$mydb = new mydb();
$connobject = $mydb->openCon();

// Check if a search request is made
if (isset($_GET['DeliveryUsername'])) {
    $username = trim($_GET['DeliveryUsername']); // Get the username from the form

    if (!empty($username)) {
        $result = $mydb->searchDeliveryman("deliveryman", $username, $connobject);

        if ($result && $result->num_rows > 0) {
            echo "<h3>Search Results:</h3>";
            echo "<table border='1' cellspacing='0' cellpadding='5'>
                    <tr>
                        <th>Delivery Username</th>
                        <th>Email</th>
                        <th>Full Name</th>
                        <th>Phone</th>
                        <th>Vehicle</th>
                        <th>CV</th>
                        <th>Age</th>
                        <th>Actions</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['DeliveryUsername']) . "</td>
                        <td>" . htmlspecialchars($row['Email']) . "</td>
                        <td>" . htmlspecialchars($row['Fullname']) . "</td>
                        <td>" . htmlspecialchars($row['Phone']) . "</td>
                        <td>" . htmlspecialchars($row['Vehicle']) . "</td>
                        <td><a href='" . htmlspecialchars($row['CV']) . "' target='_blank'>View CV</a></td>
                        <td>" . htmlspecialchars($row['Age']) . "</td>
                        <td>
                            <a href='../view/update_deliveryman.php?DeliveryUsername=" . urlencode($row['DeliveryUsername']) . "'>Update</a> |
                            <a href='../control/delete_deliveryman.php?DeliveryUsername=" . urlencode($row['DeliveryUsername']) . "'>Delete</a>
                        </td>
                     </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No delivery person found with username: " . htmlspecialchars($username) . "</p>";
        }
    } else {
        echo "<p>Please enter a valid username to search.</p>";
    }
} 
// Check if "View All" request is made
elseif (isset($_GET['viewAll'])) {
    $result = $mydb->showAllDeliveryPersons('deliveryman', $connobject);

    if ($result && $result->num_rows > 0) {
        echo "<h3>All Delivery Personnel:</h3>";
        echo "<table border='1' cellspacing='0' cellpadding='5'>
                <tr>
                    <th>Delivery Username</th>
                    <th>Email</th>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th>Vehicle</th>
                    <th>CV</th>
                    <th>Age</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['DeliveryUsername']) . "</td>
                    <td>" . htmlspecialchars($row['Email']) . "</td>
                    <td>" . htmlspecialchars($row['Fullname']) . "</td>
                    <td>" . htmlspecialchars($row['Phone']) . "</td>
                    <td>" . htmlspecialchars($row['Vehicle']) . "</td>
                    <td><a href='" . htmlspecialchars($row['CV']) . "' target='_blank'>View CV</a></td>
                    <td>" . htmlspecialchars($row['Age']) . "</td>
                 </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No delivery personnel found in the database.</p>";
    }
} else {
    echo "<p>Invalid request. Please use the search or view all options.</p>";
}

// Close the connection
$connobject->close();
?>
