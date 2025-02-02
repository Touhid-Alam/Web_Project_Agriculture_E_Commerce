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
    <link rel="stylesheet" href="../css/info.css">
</head>
<body>

<div class="main-content">
    <
<fieldset>
    <h1>Delivery Man Details</h1>
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
<a href="../view/delivery_info.php">Back to Delivery Man List</a>
</div>

<div class="navbar">
        <a href="../view/admin_dashboard.php">Admin</a>
        <a href="../view/seller_info.php">Seller Info</a>
        <a href="../view/buyer_info.php">Buyer Info</a>
        <a href="../view/employee_info.php">Employee Info</a>
        <a href="../view/delivery_info.php">Delivery Man Info</a>
        <a href="../../layout/view/login.php">Logout</a>
    </div>


<div class="main-content">
<fieldset>
<script src="../adminjs/delivery_update.js"></script>

    <h1>Update Delivery Man Information</h1>
    <form action="../control/update_deliveryman.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="DeliveryUsername" value="<?php echo htmlspecialchars($row['DeliveryUsername']); ?>">
        
        <table>
            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" id="password" name="Password" ></td>
                <td><p id="PasswordError"class="error"></p></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" name="Email" ></td>
                <td><p id="EmailError"class="error"></p></td>
            </tr>
            <tr>
                <td><label for="fullname">Full Name:</label></td>
                <td><input type="text" id="fullname" name="Fullname" ></td>
                <td><p id="FullnameError"class="error"></p></td>    
            </tr>
            <tr>
                <td><label for="Phone">Phone Number:</label></td>
                <td><input type="tel" id="Phone" name="Phone" ></td>
                <td><p id="PhoneError"class="error"></p><td>
            </tr>
            <tr>
                <td><label for="Age">Age:</label></td>
                <td><input type="number" id="Age" name="Age" ></td>
                <td><p id="AgeError"class="error"></p></td>
                
            </tr>
            <tr>
                <td><label for="Vehicle">Do you have a vehicle?</label></td>
                <td>
                    <input type="radio" id="vehicleYes" name="Vehicle" value="yes" >
                    <label for="vehicleYes">Yes</label>
                    <input type="radio" id="vehicleNo" name="Vehicle" value="no" >
                    <label for="vehicleNo">No</label>
                </td>
                <td><p id="VehicleError"class="error"></p></td>
            </tr>
            <tr>
                <td><label for="CV">CV:</label></td>
                <td><input type="file" id="CV" name="CV" accept=".pdf,.doc,.docx"></td>
                <td><p id="CVError"class="error"></p></td>
            </tr>
            
            <tr>
                <td colspan="2"><button type="submit" name="update">Update Delivery Man</button></td>
            </tr>
        </table>
    </form>
</fieldset>
</div>



</body>
</html>
