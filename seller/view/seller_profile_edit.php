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
    <title>Edit Seller Profile</title>
    <link rel="stylesheet" href="../css/seller_profile_edit.css">
    <script src="../js/seller_profile_edit_validation.js"></script>
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
    <h1>Edit Profile</h1>

    <form action="../control/seller_profile_edit_control.php" method="post" enctype="multipart/form-data" onsubmit="return validateProfileForm()">
        <fieldset>
            <legend><strong>Account Information</strong></legend>
            <table>
                <tr>
                    <td><label for="Email">Email:</label></td>
                    <td><input type="email" name="Email" id="Email" value="<?php echo htmlspecialchars($seller['Email']); ?>"></td>
                    <td><p id="EmailError"></p></td>
                </tr>
                <tr>
                    <td><label for="Password">Password:</label></td>
                    <td>
                        <input type="password" name="Password" id="Password" value="<?php echo htmlspecialchars($seller['Password']); ?>">
                        <input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()"> Show Password
                    </td>
                    <td><p id="PasswordError"></p></td>
                </tr>
            </table>
        </fieldset>

        <fieldset>
            <legend><strong>Business Information</strong></legend>
            <table>
                <tr>
                    <td><label for="BusinessName">Business Name:</label></td>
                    <td><textarea name="BusinessName" id="BusinessName" rows="2" cols="30"><?php echo htmlspecialchars($seller['BusinessName']); ?></textarea></td>
                    <td><p id="BusinessNameError"></p></td>
                </tr>
                <tr>
                    <td><label for="ProductType">Product Type:</label></td>
                    <td><input type="text" name="ProductType" id="ProductType" value="<?php echo htmlspecialchars($seller['ProductType']); ?>"></td>
                    <td><p id="ProductTypeError"></p></td>
                </tr>
            </table>
        </fieldset>

        <fieldset>
            <legend><strong>Contact Information</strong></legend>
            <table>
                <tr>
                    <td><label for="Fullname">Full Name:</label></td>
                    <td><input type="text" name="Fullname" id="Fullname" value="<?php echo htmlspecialchars($seller['Fullname']); ?>"></td>
                    <td><p id="FullnameError"></p></td>
                </tr>
                <tr>
                    <td><label for="Phone">Phone:</label></td>
                    <td><input type="text" name="Phone" id="Phone" value="<?php echo htmlspecialchars($seller['Phone']); ?>"></td>
                    <td><p id="PhoneError"></p></td>
                </tr>
                <tr>
                    <td><label for="Address">Address:</label></td>
                    <td><textarea name="Address" id="Address" rows="4" cols="50"><?php echo htmlspecialchars($seller['Address']); ?></textarea></td>
                    <td><p id="AddressError"></p></td>
                </tr>
                <tr>
                    <td><label for="District">District:</label></td>
                    <td><input type="text" name="District" id="District" value="<?php echo htmlspecialchars($seller['District']); ?>"></td>
                    <td><p id="DistrictError"></p></td>
                </tr>
            </table>
        </fieldset>

        <fieldset>
            <legend><strong>Identification</strong></legend>
            <table>
                <tr>
                    <td><label for="NID">NID:</label></td>
                    <td><input type="file" name="NID" id="NID"></td>
                    <td><p id="NIDError"></p></td>
                </tr>
                <tr>
                    <td>Current NID:</td>
                    <td>
                        <a href="../../images<?php echo htmlspecialchars($seller['NID']); ?>" target="_blank">View Current NID</a>
                    </td>
                </tr>
            </table>
        </fieldset>

        <button type="submit">Update Profile</button>
    </form>
</div>

<script>
function togglePasswordVisibility() {
    var passwordField = document.getElementById("Password");
    if (passwordField.type === "password") {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
}
</script>

</body>
</html>