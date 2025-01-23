<?php
session_start();
include('../control/manage_balance_control.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Balance</title>
</head>
<body>

<h1>Manage Your Balance</h1>
<h2>Current Balance: <?php echo htmlspecialchars($balance); ?> BDT</h2>

<!-- Form for adding balance -->
<h3>Add Balance</h3>
<form method="post" action="">
    <label for="add_amount">Amount to Add</label>
    <input type="number" name="add_amount" id="add_amount" required>
    <button type="submit" name="add_balance">Add Balance</button>
</form>

<!-- Form for withdrawing balance -->
<h3>Withdraw Balance</h3>
<form method="post" action="">
    <label for="withdraw_amount">Amount to Withdraw</label>
    <input type="number" name="withdraw_amount" id="withdraw_amount" required>
    <button type="submit" name="withdraw_balance">Withdraw Balance</button>
</form>

<button onclick="location.href='seller_profile.php'">Go Back to Profile</button>

</body>
</html>
