<?php
include '../model/admindb.php';

$mydb = new mydb();
$connobject = $mydb->openCon();

// Check if a search request is made
if (isset($_GET['SellerUsername'])) {
    $username = trim($_GET['SellerUsername']); // Get the username from the form

    if (!empty($username)) {
        $result = $mydb->searchSeller("seller", $username, $connobject);

        if ($result && $result->num_rows > 0) {
            echo "<h3>Search Results:</h3>";
            echo "<table border='1' cellspacing='0' cellpadding='5'>
                    <tr>
                        <th>Seller Username</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Business Name</th>
                        <th>Product Type</th>
                        <th>Full Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>District</th>
                        <th>NID</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['SellerUsername']) . "</td>
                        <td>" . htmlspecialchars($row['Email']) . "</td>
                        <td>" . htmlspecialchars($row['Password']) . "</td>
                        <td>" . htmlspecialchars($row['BusinessName']) . "</td>
                        <td>" . htmlspecialchars($row['ProductType']) . "</td>
                        <td>" . htmlspecialchars($row['Fullname']) . "</td>
                        <td>" . htmlspecialchars($row['Phone']) . "</td>
                        <td>" . htmlspecialchars($row['Address']) . "</td>
                        <td>" . htmlspecialchars($row['District']) . "</td>
                         <td><a href='" .htmlspecialchars($row['NID']) . "' target='_blank'>View ID Proof</a></td>
                        <td>
                            <a href='update_seller.php?SellerUsername=" . urlencode($row['SellerUsername']) . "'>Update</a> | 
                            <a href='delete_seller.php?SellerUsername=" . urlencode($row['SellerUsername']) . "' onclick='return confirm(\"Are you sure you want to delete this seller?\");'>Delete</a>
                        </td>
                         </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No seller found with username: " . htmlspecialchars($username) . "</p>";
        }
    } else {
        echo "<p>Please enter a valid username to search.</p>";
    }
} 
// Check if "View All" request is made
elseif (isset($_GET['viewAll'])) {
    $result = $mydb->showAllseller('seller', $connobject);

    if ($result && $result->num_rows > 0) {
        echo "<h3>All Sellers:</h3>";
        echo "<table border='1' cellspacing='0' cellpadding='5'>
                <tr>
                    <th>Seller Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Business Name</th>
                    <th>Product Type</th>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>District</th>
                    <th>NID</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['SellerUsername']) . "</td>
                    <td>" . htmlspecialchars($row['Email']) . "</td>
                    <td>" . htmlspecialchars($row['Password']) . "</td>
                    <td>" . htmlspecialchars($row['BusinessName']) . "</td>
                    <td>" . htmlspecialchars($row['ProductType']) . "</td>
                    <td>" . htmlspecialchars($row['Fullname']) . "</td>
                    <td>" . htmlspecialchars($row['Phone']) . "</td>
                    <td>" . htmlspecialchars($row['Address']) . "</td>
                    <td>" . htmlspecialchars($row['District']) . "</td>
                    <td><a href='" .htmlspecialchars($row['NID']) . "' target='_blank'>View ID Proof</a></td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No sellers found in the database.</p>";
    }
} else {
    echo "<p>Invalid request. Please use the search or view all options.</p>";
}

// Close the connection
$connobject->close();
?>
