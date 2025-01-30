<?php
session_start();
include('../control/seller_profile_edit_control.php');
if (!isset($_SESSION['username'])) {
    header("Location: ../../layout/view/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Seller Profile</title>
    <link rel="stylesheet" href="../css/view_profile.css">
</head>
<body>

<div class="navbar">
<a href="seller_profile.php">View Dashboard</a>
    <a href="add_product.php">Add New Product</a>
    <a href="seller_balance_account.php">Manage Your Balance Account</a>
    <a href="view_profile.php">View Profile</a>
    <a href="seller_profile_edit.php">Edit Profile</a>
    <a href="product_history.php">View Product History</a>
    <a href="../control/seller_session_destroy.php">Logout</a>
</div>

<div class="main-content">
    <h1>View Profile</h1>

    <fieldset>
        <legend><strong>Account Information</strong></legend>
        <table>
            <tr>
                <td>Email:</td>
                <td><?php echo htmlspecialchars($seller['Email']); ?></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><?php echo htmlspecialchars($seller['Password']); ?></td>
            </tr>
        </table>
    </fieldset>

    <fieldset>
        <legend><strong>Business Information</strong></legend>
        <table>
            <tr>
                <td>Business Name:</td>
                <td><?php echo htmlspecialchars($seller['BusinessName']); ?></td>
            </tr>
            <tr>
                <td>Product Type:</td>
                <td><?php echo htmlspecialchars($seller['ProductType']); ?></td>
            </tr>
        </table>
    </fieldset>

    <fieldset>
        <legend><strong>Contact Information</strong></legend>
        <table>
            <tr>
                <td>Full Name:</td>
                <td><?php echo htmlspecialchars($seller['Fullname']); ?></td>
            </tr>
            <tr>
                <td>Phone:</td>
                <td><?php echo htmlspecialchars($seller['Phone']); ?></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><?php echo htmlspecialchars($seller['Address']); ?></td>
            </tr>
            <tr>
                <td>District:</td>
                <td><?php echo htmlspecialchars($seller['District']); ?></td>
            </tr>
        </table>
    </fieldset>

    <fieldset>
        <legend><strong>Identification</strong></legend>
        <table>
            <tr>
                <td>NID:</td>
                <td>
                    <a href="../../images<?php echo htmlspecialchars($seller['NID']); ?>" target="_blank">View NID</a>
                </td>
            </tr>
        </table>
    </fieldset>
</div>

</body>
</html>
