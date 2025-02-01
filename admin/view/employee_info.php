<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Information</title>
</head>
<body>
    <h1>Employee Information</h1>
    <!-- Search Form -->
    <form action="../view/employee_info.php" method="GET">
        <label for="EmployeeUsername">Search by Employee Username:</label>
        <input type="text" id="EmployeeUsername" name="EmployeeUsername">
        <button type="submit">Search</button>
    </form>
   
    <hr>

    <!-- View All Employees -->
    <form action="../view/employee_info.php" method="GET">
        <button type="submit" name="viewAll" value="true">View All Employees</button>
    </form>
    
    <?php
    include('../control/employee_info_control.php');
    ?>
    
    <a href="../view/admin_dashboard.php">BACK</a>
</body>
</html>
