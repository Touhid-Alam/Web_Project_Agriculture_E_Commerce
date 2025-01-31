<?php
session_start();
include '../model/admindb.php';

if (isset($_GET['SellerUsername'])) {
    $username = trim($_GET['SellerUsername']);
    
    // Create a database connection
    $mydb = new mydb();
    $connobject = $mydb->openCon();

    // Fetch seller data
    $result = $mydb->searchSeller("seller", $username, $connobject);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No seller found!";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Seller Information</title>
</head>
<body>

    <h2>Update Seller Information</h2>
    
    <fieldset>
        <legend>Seller Details</legend>
        <table border="1">
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr><td>Seller Username:</td><td><?php echo htmlspecialchars($row['SellerUsername']); ?></td></tr>
            <tr><td>Email:</td><td><?php echo htmlspecialchars($row['Email']); ?></td></tr>
            <tr><td>Business Name:</td><td><?php echo htmlspecialchars($row['BusinessName']); ?></td></tr>
            <tr><td>Product Type:</td><td><?php echo htmlspecialchars($row['ProductType']); ?></td></tr>
            <tr><td>Full Name:</td><td><?php echo htmlspecialchars($row['Fullname']); ?></td></tr>
            <tr><td>Phone:</td><td><?php echo htmlspecialchars($row['Phone']); ?></td></tr>
            <tr><td>Address:</td><td><?php echo htmlspecialchars($row['Address']); ?></td></tr>
            <tr><td>District:</td><td><?php echo htmlspecialchars($row['District']); ?></td></tr>
            <tr><td>NID:</td><td><a href="<?php echo htmlspecialchars($row['NID']); ?>" target="_blank">View ID Proof</a></td></tr>
        </table>
    </fieldset>

    <fieldset>
        <legend>Update Seller Information</legend>
        <form action="../control/update_seller.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="SellerUsername" value="<?php echo htmlspecialchars($row['SellerUsername']); ?>">
            
            <table>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" id="password" name="Password"></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" id="email" name="Email"></td>
                </tr>
                <tr>
                    <td><label for="businessName">Business Name:</label></td>
                    <td><input type="text" id="businessName" name="BusinessName"></td>
                </tr>
                <tr>
                    <td><label for="productType">Product Type:</label></td>
                    <td>
                        <select id="productType" name="ProductType">
                            <option value="Fresh Produce">Fresh Produce</option>
                            <option value="Organic Products">Organic Products</option>
                            <option value="Dairy Products">Dairy Products</option>
                            <option value="Processed Goods">Processed Goods</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="fullName">Full Name:</label></td>
                    <td><input type="text" id="fullName" name="Fullname"></td>
                </tr>
                <tr>
                    <td><label for="phone">Phone Number:</label></td>
                    <td><input type="tel" id="phone" name="Phone"></td>
                </tr>
                <tr>
                    <td><label for="address">Address:</label></td>
                    <td><input type="text" id="address" name="Address"></td>
                </tr>
                <tr>
                    <td><label for="districts">District:</label></td>
                    <td>
                        <select id="districts" name="District">
                            <option value="DHAKA">DHAKA</option>
                            <option value="CHITTAGONG">CHITTAGONG</option>
                            <option value="SYLHET">SYLHET</option>
                            <option value="RAJSHAHI">RAJSHAHI</option>
                            <option value="BARISHAL">BARISHAL</option>
                            <option value="KHULNA">KHULNA</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="idProof">ID Proof:</label></td>
                    <td><input type="file" id="idProof" name="idProof"></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit" name="update">Update Seller</button></td>
                </tr>
            </table>
        </form>
    </fieldset>

    <br>
    <a href="../view/seller_info.php">Back to Seller List</a>

</body>
</html>
