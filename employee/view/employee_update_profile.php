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
            <form action="../control/employee_logout.php" method="POST">
                <button type="submit" class="logout-button">Logout</button>
            </form>
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
            <div class="profile-item">
                <table id="workshift-table">
                    <tr>
                        <th>Available Work Shifts</th>
                    </tr>
                    <tr>
                        <td class="workshift-option" data-shift="8-4">8 AM - 4 PM</td>
                    </tr>
                    <tr>
                        <td class="workshift-option" data-shift="5-10">5 PM - 10 PM</td>
                    </tr>
                    <!-- Add more shifts as needed -->
                </table>
            </div>
            <button type="submit">Save Changes</button>
        </form>
    </div>
    <script src="../js/employee_update_profile_validation.js"></script>
    <script src="../js/employee_update_profile_ajax.js"></script>
</body>
</html>
