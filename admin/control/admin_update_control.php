<?php
include '../model/admindb.php';
session_start();

$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $fullname = trim($_POST['fullname']);
    $idProofPath = ""; // Initialize for file upload

    
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $errors[] = "Username should only contain alphabets and numbers.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (!preg_match("/[0-9]/", $password) || !preg_match("/[A-Z]/", $password) || strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long, contain at least one numeric character, and one uppercase letter.";
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $fullname)) {
        $errors[] = "Full name should only contain alphabets and spaces.";
    }

    // Handle file upload
    if (isset($_FILES['idProof']) && $_FILES['idProof']['error'] == 0) {
        $targetDir = "../../images/";
        $fileExtension = pathinfo($_FILES['idProof']['name'], PATHINFO_EXTENSION); // Get file extension
        $newFileName = $username . '.' . $fileExtension; // Rename file to the username
        $targetFile = $targetDir . $newFileName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['idProof']['tmp_name'], $targetFile)) {
            $idProofPath = $targetFile; // Store the new file path
        } else {
            $errors[] = "Sorry, there was an error uploading your file.";
        }
    }

    // If there are validation errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    } else {
        // Proceed with updating the data if no errors
        $mydb = new mydb();
        $connobject = $mydb->openCon();

        // Check if the username exists in the database
        $result = $mydb->viewAdmin("admin", $username, $connobject);
        if ($result->num_rows > 0) {
            // Update the admin details
            $updateResult = $mydb->updateAdmin("admin", $username, $email, $password, $fullname, $idProofPath, $connobject);
            if ($updateResult) {
                echo "Admin details updated successfully!";
                
            } else {
                echo "Error: Unable to update admin details.";
            }

        } else {
            echo "Admin with username '$username' not found.";
        }

        $connobject->close();
    }
}
?>
