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
    <title>Update Buyer Information</title>
</head>
<body>

    <h2>Update Buyer Information</h2>
    
    <fieldset>
        <legend>Buyer Details</legend>
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

    <fieldset>
    <legend>Update Buyer Information</legend>
    <form action="../control/update_buyer.php" method="POST">
        <input type="hidden" name="BuyerUsername" value="<?php echo htmlspecialchars($row['BuyerUsername']); ?>">

        <table>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" name="Email" ></td>
            </tr>
            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" id="password" name="Password"></td>
            </tr>
            <tr>
                <td><label for="fullName">Full Name:</label></td>
                <td><input type="text" id="fullName" name="Fullname"></td>
            </tr>
            <tr>
                <td><label for="phone">Phone Number:</label></td>
                <td><input type="tel" id="phone" name="Phone" ></td>
            </tr>
            <tr>
                <td><label for="dateofbirth">Date of Birth:</label></td>
                <td><input type="date" id="dateofbirth" name="DateOfBirth"></td>
            </tr>
            <tr>
                <td><button type="submit" name="update">Update Buyer</button></td>
            </tr>
        </table>
    </form>
</fieldset>


    <br>
    <a href="../view/buyer_info.php">Back to Buyer List</a>

</body>
</html>
