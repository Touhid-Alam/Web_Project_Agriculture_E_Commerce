<?php
session_start();
include '../model/admindb.php';

// Check if the form was submitted and the necessary fields are set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Retrieve the posted form data
    $AdminUsername = trim($_POST['AdminUsername']);
    $Fullname = trim($_POST['Fullname']);
    $Password = trim($_POST['Password']);
    $Email = trim($_POST['Email']);
    $NID = $_FILES['NID']['name'];

    // Check if any required fields are empty
    if (empty($Fullname) || empty($AdminUsername) || empty($Email)) {
        echo "<p>Please fill in all required fields.</p>";
        exit();
    }

    // Validate email format
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo "<p>Invalid email format.</p>";
        exit();
    }

    // Hash the password if it's provided
    if (!preg_match("/[0-9]/", $Password) || !preg_match("/[A-Z]/", $Password) || strlen($Password) < 8) {
        echo "Password must be at least 8 characters long, contain at least one numeric character, and one uppercase letter.";
    }

    // Handle NID file upload if a new file is uploaded
    if (isset($_FILES['NID']) && $_FILES['NID']['error'] == 0) {
        $targetDir = "../../images/";
        $fileExtension = pathinfo($_FILES['NID']['name'], PATHINFO_EXTENSION); // Get file extension
        $newFileName = $AdminUsername . '.' . $fileExtension; // Rename file to the username
        $targetFile = $targetDir . $newFileName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['NID']['tmp_name'], $targetFile)) {
            $NID = $targetFile; // Store the new file path
        } else {
            $errors[] = "Sorry, there was an error uploading your file.";
        }
    }

    // Create a database connection
    $mydb = new mydb();
    $connobject = $mydb->openCon();

    // Ensure that the update query method exists in the mydb class
    $updateSuccess = $mydb->updateAdmin(
        "admin",           // Table name
        $AdminUsername,    // The admin's username
        $Email,            // New email
        $Password,         // New password (hashed or null)
        $Fullname,         // New full name
        $NID,              // New NID (file path or null)
        $connobject        // Database connection
    );

    if ($updateSuccess) {
        echo "<p>Admin information updated successfully.</p>";
        echo '<a href="../view/admin_dashboard.php">Go Back</a>';
    } else {
        // Output actual error if update fails
        echo "<p>Error: Could not update admin information. " . $connobject->error . "</p>";
        echo '<a href="../view/admin_dashboard.php">Go Back</a>';
    }

    // Close database connection
    $connobject->close();
} else {
    echo "<p>Invalid request.</p>";
}
?>
