<?php
session_start();
include('../control/seller_account_control.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Details</title>
</head>
<body>
    <h1>Account Details</h1>

    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

    <?php if (!empty($accountDetails)): ?>
        <table>
            <thead>
                <tr>
                    <th>Account ID</th>
                    <th>Username</th>
                    <th>User Type</th>
                    <th>Total Balance</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars($accountDetails['AccountID']); ?></td>
                    <td><?php echo htmlspecialchars($accountDetails['username']); ?></td>
                    <td><?php echo htmlspecialchars($accountDetails['usertype']); ?></td>
                    <td><?php echo htmlspecialchars($accountDetails['totalbalance']); ?></td>
                </tr>
            </tbody>
        </table>
    <?php else: ?>
        <p>No account details found.</p>
    <?php endif; ?>

    <button onclick="location.href='edit_balance.php'">Edit Account Details</button>
    <br>
    <button onclick="location.href='seller_profile.php'">Go Back</button>
</body>
</html>
