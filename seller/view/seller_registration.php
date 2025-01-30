<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Registration</title>
    <script src="../js/seller_reg_validation.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/seller_registration.css">
</head>
<body>

<h2>Register as a Seller</h2>

<?php
session_start();
if (isset($_SESSION['registration_error'])) {
    echo $_SESSION['registration_error'];
    unset($_SESSION['registration_error']);
}
session_unset();
session_destroy();
?>

<form action="../control/seller_reg_control.php" method="POST" enctype="multipart/form-data" onsubmit="return validation()">
    <fieldset>
        <legend><strong>Account Information</strong></legend>
        <table>
            <tr>
                <td><label for="username">Username:</label></td>
                <td><input type="text" id="username" name="username"></td>
                <td><p id="usernameError"></p></td>
            </tr>
            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" id="password" name="password"></td>
                <td><p id="passwordError"></p></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" name="email"></td>
                <td><p id="emailError"></p></td>
            </tr>
        </table>
    </fieldset>

    <fieldset>
        <legend><strong>Business Information</strong></legend>
        <table>
            <tr>
                <td><label for="businessName">Business Name:</label></td>
                <td><input type="text" id="businessName" name="businessName"></td>
                <td><p id="businessNameError"></p></td>
            </tr>
            <tr>
                <td><label for="productType">Product Type:</label></td>
                <td>
                    <select id="productType" name="productType">
                        <option value="">Select a product type</option>
                        <option value="Fresh Produce">Fresh Produce</option>
                        <option value="Organic Products">Organic Products</option>
                        <option value="Dairy Products">Dairy Products</option>
                        <option value="Processed Goods">Processed Goods</option>
                    </select>
                </td>
                <td><p id="productTypeError"></p></td>
            </tr>
        </table>
    </fieldset>

    <fieldset>
        <legend><strong>Contact Information</strong></legend>
        <table>
            <tr>
                <td><label for="fullName">Full Name:</label></td>
                <td><input type="text" id="fullName" name="fullName"></td>
                <td><p id="fullNameError"></p></td>
            </tr>
            <tr>
                <td><label for="phone">Phone Number:</label></td>
                <td><input type="tel" id="phone" name="phone"></td>
                <td><p id="phoneError"></p></td>
            </tr>
            <tr>
                <td><label for="address">Address:</label></td>
                <td><input type="text" id="address" name="address"></td>
                <td><p id="addressError"></p></td>
            </tr>
            <tr>
                <td><label for="districts">District:</label></td>
                <td>
                    <select id="districts" name="district">
                        <option value="">Select a district</option>
                        <option value="DHAKA">DHAKA</option>
                        <option value="CHITTAGONG">CHITTAGONG</option>
                        <option value="SYLHET">SYLHET</option>
                        <option value="RAJSHAHI">RAJSHAHI</option>
                        <option value="BARISHAL">BARISHAL</option>
                        <option value="KHULNA">KHULNA</option>
                    </select>
                </td>
                <td><p id="districtError"></p></td>
            </tr>
        </table>
    </fieldset>

    <fieldset>
        <legend><strong>Identification</strong></legend>
        <table>
            <tr>
                <td><label for="idProof">ID Proof:</label></td>
                <td><input type="file" id="idProof" name="idProof"></td>
                <td><p id="idProofError"></p></td>
            </tr>
        </table>
    </fieldset>

    <button type="submit">Register as Seller</button>
</form>

<div class="nav-links">
    <a href="../../layout/view/login.php">Go to login</a>
    <a href="../../layout/view/homepage.php">Go to Home</a>
    <a href="../../layout/view/registration.php">Go Back</a>
</div>

</body>
</html>
