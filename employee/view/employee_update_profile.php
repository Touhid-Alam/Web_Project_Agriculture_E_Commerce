<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
 
if (!isset($_SESSION['username'])) {
    header("Location: employee_login.php");
    exit;
}
 
if (!isset($_SESSION['employeeDetails'])) {
    header("Location: ../control/employee_profile_control.php");
    exit;
}
 
$employeeDetails = $_SESSION['employeeDetails'];
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="../css/employee_profile.css">
</head>
<body>
    <div class="navbar">
        <a href="employee_profile.php">Profile</a>
        <a href="employee_orders.php">Orders</a>
        <div class="logout-container">
            <form action="../../layout/view/login.php" method="POST">
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>
    </div>
 
    <div class="main-content">
        <h2>Update Profile</h2>
        <form action="../control/employee_update_profile_control.php" method="POST" class="update-form">
            <div class="profile-item">
                <label for="fullname"><strong>Full Name:</strong></label>
                <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($employeeDetails['Fullname']); ?>" required>
            </div>
            <div class="profile-item">
                <label for="email"><strong>Email:</strong></label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($employeeDetails['Email']); ?>" required>
            </div>
            <div class="profile-item">
                <label for="phone"><strong>Phone:</strong></label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($employeeDetails['Phone']); ?>" required>
            </div>
            <div class="profile-item">
                <label for="workshift"><strong>Work Shift:</strong></label>
                <input type="text" id="workshift" name="workshift" value="<?php echo htmlspecialchars($employeeDetails['WorkShift']); ?>" required readonly>
            </div>
            <button type="submit">Save Changes</button>
        </form>
 
        <h3>Available Shifts</h3>
        <table class="shift-table">
            <thead>
                <tr>
                    <th>Shift Name</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <tr data-shift-id="1" data-shift-name="Morning Shift">
                    <td>Morning Shift</td>
                    <td>5 AM - 10 AM</td>
                </tr>
                <tr data-shift-id="2" data-shift-name="Afternoon Shift">
                    <td>Afternoon Shift</td>
                    <td>4 PM - 8 PM</td>
                </tr>
                <tr data-shift-id="3" data-shift-name="Night Shift">
                    <td>Night Shift</td>
                    <td>10 PM - 4 AM</td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="../js/employee_update_profile_validation.js"></script>
</body>
</html>