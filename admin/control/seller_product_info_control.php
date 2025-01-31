<?php
session_start();
include '../model/admindb.php';

if (!isset($_GET['SellerUsername'])) {
    echo "<p>Seller Username not provided.</p>";
    exit;
}

$sellerUsername = trim($_GET['SellerUsername']);
$mydb = new mydb();
$connobject = $mydb->openCon();

// Fetch products of this seller
$result = $mydb->getSellerProducts($sellerUsername, $connobject);

if ($result && $result->num_rows > 0) {
    echo "<h2>Products of Seller: " . htmlspecialchars($sellerUsername) . "</h2>";
    echo "<table border='1' cellspacing='0' cellpadding='5'>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Picture</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['PName']) . "</td>
                <td>" . htmlspecialchars($row['Price']) . "</td>
                <td>" . htmlspecialchars($row['Quantity']) . "</td>
                <td><img src='../../images/" . htmlspecialchars($row['Picture']) . "' width='100'></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No products found for this seller.</p>";
}

$connobject->close();
?>
