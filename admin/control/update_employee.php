<?php
include '../model/admindb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $empUsername = trim($_POST['EmployeeUsername']);
    $empPassword = trim($_POST['password']);
    $empEmail = trim($_POST['email']);
    $empPhone = trim($_POST['phone']);
    $empFullName = trim($_POST['fullName']);
    $empWorkShift = trim($_POST['workShift']);
    $empAge = trim($_POST['age']);

    $empCV = ''; // Default empty path
    if (isset($_FILES['empCV']) && $_FILES['empCV']['error'] == 0) {
        $targetDir = "../../images/";
        $fileExtension = pathinfo($_FILES['empCV']['name'], PATHINFO_EXTENSION); // Get file extension
        $newFileName =  $empUsername . '.' . $fileExtension; // Rename file to the username
        $targetFile = $targetDir . $newFileName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['empCV']['tmp_name'], $targetFile)) {
            $empCV = $targetFile; // Store the new file path
        } else {
            $errors[] = "Sorry, there was an error uploading your file.";
        }
    }

    // Database Connection
    $mydb = new mydb();
    $connobject = $mydb->openCon();

    // Update query
    $updateSuccess = $mydb->updateEmployee(
        "employee",          // Table name
        $empUsername,        // The employee's username
              // New password (Hash it before storing in production)
        $empEmail,
        $empPassword, 
        $empFullName,             // New email
        $empPhone,           // New phone number
              // New full name
        $empWorkShift,       // New work shift
                    // New age
        $empCV, 
        $empAge,            // Storing the file path for CV
        $connobject          // Database connection
    );

    if ($updateSuccess) {
        echo "<p>Employee information updated successfully.</p>";
        echo '<a href="../view/employee_info.php">Go Back</a>';
    } else {
        echo "<p>Error: Could not update employee information. " . $connobject->error . "</p>";
        echo '<a href="../view/employee_info.php">Go Back</a>';
    }

    $connobject->close();
} else {
    echo "<p>Invalid request.</p>";
}
?>
