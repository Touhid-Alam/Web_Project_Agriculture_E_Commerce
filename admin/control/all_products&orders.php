<?php
include '../model/admindb.php';


$mydb = new mydb();
$connobject = $mydb->openCon();

// Check if "View All" request is made
if (isset($_GET['viewAllp'])) {
    $result = $mydb->showAllProducts('product', $connobject); // Assuming your method is named showAllProducts

    if ($result && $result->num_rows > 0) {
        echo "<h3>All Products:</h3>";
        echo "<table border='1' cellspacing='0' cellpadding='5'>
                <tr>
                    <th>PID</th>
                    <th>Seller Username</th>
                    <th>Product Name</th>
                    <th>Price ($)</th>
                    <th>Quantity</th>
                    <th>Picture</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['PID']) . "</td>
                    <td>" . htmlspecialchars($row['SellerUsername']) . "</td>
                    <td>" . htmlspecialchars($row['PName']) . "</td>
                    <td>" . htmlspecialchars($row['Price']) . "</td>
                    <td>" . htmlspecialchars($row['Quantity']) . "</td>
                    <td><img src='../uploads/" . htmlspecialchars($row['Picture']) . "' width='50' height='50' alt='Product Image'></td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No products found in the database.</p>";
    }
} 
else if (isset($_GET['viewAllo'])) {
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
