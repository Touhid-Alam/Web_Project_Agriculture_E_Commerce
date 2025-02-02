<?php
session_start();
include '../model/admindb.php';

if (isset($_GET['BuyerUsername'])) {
    $username = trim($_GET['BuyerUsername']);
    
    // Create a database connection
    $mydb = new mydb();
    $connobject = $mydb->openCon();

    // Fetch buyer data
    $result = $mydb->searchBuyer("buyer", $username, $connobject);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No buyer found!";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/info.css">
    <title>Update Buyer Information</title>
</head>
<body>
<div class="main-content">
        
    <fieldset>
        <h1>Buyer Details</h1>
        <table border="1">
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr><td>Buyer Username:</td><td><?php echo htmlspecialchars($row['BuyerUsername']); ?></td></tr>
            <tr><td>Email:</td><td><?php echo htmlspecialchars($row['Email']); ?></td></tr>
            <tr><td>Full Name:</td><td><?php echo htmlspecialchars($row['Fullname']); ?></td></tr>
            <tr><td>Phone:</td><td><?php echo htmlspecialchars($row['Phone']); ?></td></tr>
            <tr><td>Date of Birth:</td><td><?php echo htmlspecialchars($row['DateOfBirth']); ?></td></tr>
        </table>
    </fieldset>
    <a href="../view/buyer_info.php">Back to Buyer List</a>
</div>

<div class="navbar">
        <a href="../view/admin_dashboard.php">Admin</a>
        <a href="../view/seller_info.php">Seller Info</a>
        <a href="../view/buyer_info.php">Buyer Info</a>
        <a href="../view/employee_info.php">Employee Info</a>
        <a href="../view/delivery_info.php">Delivery</a>
        <a href="../../layout/view/login.php">Logout</a>
    </div>
  
<div class="main-content">
    <fieldset>
    <script src="../adminJS/buyer_update.js"></script>
    <h1>Update Buyer Information</h1>
    <form action="../control/update_buyer.php" method="POST">
        <input type="hidden" name="BuyerUsername" value="<?php echo htmlspecialchars($row['BuyerUsername']); ?>">

        <table>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" name="Email" ></td>
                <td><p id="EmailError"class="error"></p></td>
            </tr>
            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" id="password" name="Password"></td>
                <td><p id="PasswordError"class="error"></p></td>
            </tr>
            <tr>
                <td><label for="fullName">Full Name:</label></td>
                <td><input type="text" id="fullName" name="Fullname"></td>
                <td><p id="FullnameError"class="error"></p></td>
            </tr>
            <tr>
                <td><label for="phone">Phone Number:</label></td>
                <td><input type="tel" id="phone" name="Phone" ></td>
                <td><p id="PhoneError"class="error"></p></td>
            </tr>
            <tr>
                <td><label for="dateofbirth">Date of Birth:</label></td>
                <td><input type="date" id="dateofbirth" name="DateOfBirth"></td>
                <td><p id="DOBError" class="error"></p></td>
            </tr>
            <tr>
            <tr>
                    <td colspan="2"><button type="submit" name="update">Update Buyer</button></td>
                </tr>
            </tr>
        </table>
    </form>
</fieldset>
</div>

   
    

</body>
</html>
