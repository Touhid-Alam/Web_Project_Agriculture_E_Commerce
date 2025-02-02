<?php
include '../model/admindb.php';


$mydb = new mydb();
$connobject = $mydb->openCon();

// Check if "View All" request is made
if (isset($_GET['viewAll'])) {
    $result = $mydb->showAllOrders('orders', $connobject); // New function to fetch orders

    if ($result && $result->num_rows > 0) {
        echo "<h3>All Orders:</h3>";
        echo "<table border='1' cellspacing='0' cellpadding='5'>
                <tr>
                    <th>OID</th>
                    <th>Buyer Username</th>
                    <th>Total Price ($)</th>
                    <th>Delivery Username</th>
                    <th>Status</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['OID']) . "</td>
                    <td>" . htmlspecialchars($row['BuyerUsername']) . "</td>
                    <td>" . htmlspecialchars($row['TotalPrice']) . "</td>
                    <td>" . htmlspecialchars($row['DeliveryUsername']) . "</td>
                    <td>" . htmlspecialchars($row['Status']) . "</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No orders found in the database.</p>";
    }
} else {
    echo "<p>Invalid request. Please use the 'View All' option.</p>";
}

// Close the connection
$connobject->close();
?>
