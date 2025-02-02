<?php
session_start();
include '../model/admindb.php';

// Check if the form was submitted and the necessary fields are set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Retrieve the posted form data
    $BuyerUsername = trim($_POST['BuyerUsername']);
    $Fullname = trim($_POST['Fullname']);
    $Password = trim($_POST['Password']);
    $Email = trim($_POST['Email']);
    $Phone = trim($_POST['Phone']);
    $DateOfBirth = trim($_POST['DateOfBirth']);

    // Check if any required fields are empty (you can add more validations as needed)
    if (empty($Fullname) || empty($BuyerUsername) || empty($Email) || empty($Phone) || empty($DateOfBirth)) {
        echo "<p>Please fill in all required fields.</p>";
        exit();
    }

    // Validate email format
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo "<p>Invalid email format.</p>";
        exit();
    }

    // Validate phone number (for example, check if it's numeric or matches a specific pattern)
    if (!preg_match("/^[0-9]{11}$/", $Phone)) {
        echo "<p>Invalid phone number. It should be 11 digits.</p>";
        exit();
    }

    // Hash the password if it's provided
    if (empty($Password)) {
        echo "Password is required.";
    } elseif (!preg_match('/[@#$&]/', $Password)) {
        echo "Password must contain at least one special character (@, #, $, or &).";
    }

    if (empty($DateOfBirth) || !DateTime::createFromFormat('Y-m-d', $DateOfBirth)) {
        $errors[] = "Please enter a valid date in the format YYYY-MM-DD.";
    }

    // Create a database connection
    $mydb = new mydb();
    $connobject = $mydb->openCon();

    // Ensure that the update query method exists in the mydb class
    $updateSuccess = $mydb->updateBuyer(
        "buyer",           // Table name
        $BuyerUsername,    // The buyer's username
        $Email,            // New email
        $Password,         // New password (hashed or null)
        $Fullname,         // New full name
        $Phone,            // New phone number
        $DateOfBirth,      // New date of birth
        $connobject        // Database connection
    );

    if ($updateSuccess) {
        echo "<p>Buyer information updated successfully.</p>";
        echo '<a href="../view/buyer_info.php">Go Back</a>';
    } else {
        // Output actual error if update fails
        echo "<p>Error: Could not update buyer information. " . $connobject->error . "</p>";
        echo '<a href="../view/buyer_info.php">Go Back</a>';
    }

    // Close database connection
    $connobject->close();
} else {
    echo "<p>Invalid request.</p>";
}
?>
