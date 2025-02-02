<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header("Location:../../layout/view/login.php");
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
    <title>Employee Profile</title>
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
    </div>

    <div class="main-content">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>

        <?php if (!empty($employeeDetails)): ?>
            <h2>Your Profile</h2>
            <div class="profile-card">
                <div class="profile-item">
                    <strong>Full Name:</strong>
                    <span><?php echo htmlspecialchars($employeeDetails['Fullname']); ?></span>
                </div>
                <div class="profile-item">
                    <strong>Email:</strong>
                    <span><?php echo htmlspecialchars($employeeDetails['Email']); ?></span>
                </div>
                <div class="profile-item">
                    <strong>Phone:</strong>
                    <span><?php echo htmlspecialchars($employeeDetails['Phone']); ?></span>
                </div>
                <div class="profile-item">
                    <strong>Work Shift:</strong>
                    <span><?php echo htmlspecialchars($employeeDetails['WorkShift']); ?></span>
                </div>
            </div>
            <form action="employee_update_profile.php" method="GET">
                <button type="submit">Update Profile</button>
            </form>
        <?php else: ?>
            <p>Employee details not found.</p>
        <?php endif; ?>
    </div>
    
</body>
</html>
