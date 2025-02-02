<?php
session_start();
include '../model/admindb.php';

if (isset($_GET['EmployeeUsername'])) {
    $EmployeeUsername = trim($_GET['EmployeeUsername']);
    
    // Create a database connection
    $mydb = new mydb();
    $connobject = $mydb->openCon();

    // Fetch employee data
    $result = $mydb->searchEmployee("employee", $EmployeeUsername, $connobject);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No employee found!";
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
    <title>Update Employee Information</title>
</head>
<body>

    <div class="main-content">
    
    <fieldset>
        <h1>Employee Details</h1>
        <table border="1">
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr><td>Employee Username:</td><td><?php echo htmlspecialchars($row['EmployeeUsername']); ?></td></tr>
            <tr><td>Email:</td><td><?php echo htmlspecialchars($row['Email']); ?></td></tr>
            <tr><td>Full Name:</td><td><?php echo htmlspecialchars($row['Fullname']); ?></td></tr>
            <tr><td>Phone:</td><td><?php echo htmlspecialchars($row['Phone']); ?></td></tr>
            <tr><td>Work Shift:</td><td><?php echo htmlspecialchars($row['WorkShift']); ?></td></tr>
            <tr><td>Age:</td><td><?php echo htmlspecialchars($row['Age']); ?></td></tr>
            <tr><td>CV:</td><td><a href="<?php echo htmlspecialchars($row['CV']); ?>" target="_blank">View CV</a></td></tr>
        </table>
    </fieldset>
    <a href="../view/employee_info.php">Back to Employee List</a>
    </div>

    <div class="navbar">
        <a href="../view/admin_dashboard.php">Admin</a>
        <a href="../view/seller_info.php">Seller Info</a>
        <a href="../view/buyer_info.php">Buyer Info</a>
        <a href="../view/employee_info.php">Employee Info</a>
        <a href="../view/delivery_info.php">Delivery Man Info</a>
        <a href="../../layout/view/login.php">Logout</a>
    </div>


<div="main-content">
<fieldset>
<script src="../adminJS/employee_update.js"></script>
        <h1>Update Employee Information</h1>
        <form action="../control/update_employee.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="EmployeeUsername" value="<?php echo htmlspecialchars($row['EmployeeUsername']); ?>">
            
            <table>
                <tr>
                    <td><label for="empPassword">Password:</label></td>
                    <td><input type="password" id="empPassword" name="password"></td>
                    <td><p id="PasswordError" class="error"></p></td>
                </tr>
                <tr>
                    <td><label for="empEmail">Email:</label></td>
                    <td><input type="email" id="empEmail" name="email"></td>
                    <td><p id="EmailError" class="error"></p></td>
                </tr>
                <tr>
                    <td><label for="empFullName">Full Name:</label></td>
                    <td><input type="text" id="empFullName" name="fullName"></td>
                    <td><p id="FullnameError" class="error"></p></td>
                </tr>
                <tr>
                    <td><label for="empPhone">Phone Number:</label></td>
                    <td><input type="tel" id="empPhone" name="phone"></td>
                    <td><p id="PhoneError" class="error"></p></td>
                </tr>
                <tr>
                    <td><label for="empWorkShift">Work Shift:</label></td>
                    <td><input type="text" id="empWorkShift" name="workShift"></td>
                    <td><p id="ShiftError" class="error"></p></td>
                </tr>
                <tr>
                    <td><label for="empCV">CV:</label></td>
                    <td><input type="file" id="empCV" name="empCV" accept=".pdf,.doc,.docx"></td>
                    <td><p id="EmpCVError" class="error"></p></td>
                </tr>
                <tr>
                    <td><label for="empAge">Age:</label></td>
                    <td><input type="number" id="empAge" name="age"></td>
                    <td><p id="EmpAgeError" class="error"></p></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit" name="update">Update Employee</button></td>
                </tr>
            </table>
        </form>
    </fieldset>
   
</div>
   
    

</body>
</html>
