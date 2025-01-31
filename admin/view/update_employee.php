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
    <title>Update Employee Information</title>
</head>
<body>

    <h2>Update Employee Information</h2>
    
    <fieldset>
        <legend>Employee Details</legend>
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

    <fieldset>
        <legend>Update Employee Information</legend>
        <form action="../control/update_employee.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="EmployeeUsername" value="<?php echo htmlspecialchars($row['EmployeeUsername']); ?>">
            
            <table>
                <tr>
                    <td><label for="empPassword">Password:</label></td>
                    <td><input type="password" id="empPassword" name="password"></td>
                </tr>
                <tr>
                    <td><label for="empEmail">Email:</label></td>
                    <td><input type="email" id="empEmail" name="email"></td>
                </tr>
                <tr>
                    <td><label for="empFullName">Full Name:</label></td>
                    <td><input type="text" id="empFullName" name="fullName"></td>
                </tr>
                <tr>
                    <td><label for="empPhone">Phone Number:</label></td>
                    <td><input type="tel" id="empPhone" name="phone"></td>
                </tr>
                <tr>
                    <td><label for="empWorkShift">Work Shift:</label></td>
                    <td><input type="text" id="empWorkShift" name="workShift"></td>
                </tr>
                <tr>
                    <td><label for="empCV">CV:</label></td>
                    <td><input type="file" id="empCV" name="cv" accept=".pdf,.doc,.docx"></td>
                </tr>
                <tr>
                    <td><label for="empAge">Age:</label></td>
                    <td><input type="number" id="empAge" name="age"></td>
                </tr>
                
                <tr>
                    <td colspan="2"><button type="submit" name="update">Update Employee</button></td>
                </tr>
            </table>
        </form>
    </fieldset>

    <br>
    <a href="../view/employee_info.php">Back to Employee List</a>

</body>
</html>
