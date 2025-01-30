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
        <a href="employee_logout.php">Logout</a>
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
                <input type="text" id="workshift" name="workshift" value="<?php echo htmlspecialchars($employeeDetails['WorkShift']); ?>" required>
            </div>
            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>
