<?php 
session_start();
include '../model/admindb.php';

if (isset($_GET['DeliveryUsername'])) {
    $DeliveryUsername = trim($_GET['DeliveryUsername']);
    
    // Create a database connection
    $mydb = new mydb();
    $connobject = $mydb->openCon();

    // Fetch delivery man data
    $result = $mydb->searchDeliveryman("deliveryman", $DeliveryUsername, $connobject);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No delivery man found!";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Delivery Man Information</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
</head>
<body>

<h2>Update Delivery Man Information</h2>

<fieldset>
    <legend>Delivery Man Details</legend>
    <table border="1">
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
        <tr><td>DeliveryUsername:</td><td><?php echo htmlspecialchars($row['DeliveryUsername']); ?></td></tr>
        <tr><td>Email:</td><td><?php echo htmlspecialchars($row['Email']); ?></td></tr>
        <tr><td>Full Name:</td><td><?php echo htmlspecialchars($row['Fullname']); ?></td></tr>
        <tr><td>Phone:</td><td><?php echo htmlspecialchars($row['Phone']); ?></td></tr>
        <tr><td>Age:</td><td><?php echo htmlspecialchars($row['Age']); ?></td></tr>
        <tr><td>Vehicle:</td><td><?php echo htmlspecialchars($row['Vehicle']); ?></td></tr>
        <tr><td>CV:</td><td><a href="<?php echo htmlspecialchars($row['CV']); ?>" target="_blank">View CV</a></td></tr>
    </table>
</fieldset>

<fieldset>
    <legend>Update Delivery Man Information</legend>
    <form action="../control/update_deliveryman.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="DeliveryUsername" value="<?php echo htmlspecialchars($row['DeliveryUsername']); ?>">
        
        <table>
            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" id="password" name="Password" ></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" name="Email" ></td>
            </tr>
            <tr>
                <td><label for="fullname">Full Name:</label></td>
                <td><input type="text" id="fullname" name="Fullname" ></td>
            </tr>
            <tr>
                <td><label for="Phone">Phone Number:</label></td>
                <td><input type="tel" id="Phone" name="Phone" ></td>
            </tr>
            <tr>
                <td><label for="Age">Age:</label></td>
                <td><input type="number" id="Age" name="Age" ></td>
            </tr>
            <tr>
                <td><label for="Vehicle">Do you have a vehicle?</label></td>
                <td>
                    <input type="radio" id="vehicleYes" name="Vehicle" value="yes" >
                    <label for="vehicleYes">Yes</label>
                    <input type="radio" id="vehicleNo" name="Vehicle" value="no" >
                    <label for="vehicleNo">No</label>
                </td>
            </tr>
            <tr>
                <td><label for="CV">CV:</label></td>
                <td><input type="file" id="CV" name="CV" accept=".pdf,.doc,.docx"></td>
            </tr>
            
            <tr>
                <td colspan="2"><button type="submit" name="update">Update Delivery Man</button></td>
            </tr>
        </table>
    </form>
</fieldset>

<br>
<a href="../view/delivery_info.php">Back to Delivery Man List</a>

</body>
</html>
