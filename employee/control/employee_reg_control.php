<?php
// Include the database connection file
include '../model/db.php'; // Corrected path
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $fullName = $_POST['fullName'];
    $phone = $_POST['phone'];
    $workShift = $_POST['workShift'];
    $age = $_POST['age'];
    $cv = isset($_FILES['cv']) ? $_FILES['cv'] : null;
 
    if (strlen($password) < 6 || !preg_match('/[a-z]/', $password)) {
        $errors[] = "Password must be at least 6 characters long and contain at least one lowercase letter.";
    }
 
    if (!preg_match('/^0[0-9]{9,}$/', $phone)) {
        $errors[] = "Phone number must start with 0 and be at least 10 digits long.";
    }
 
    if ($cv && ($cv['error'] != UPLOAD_ERR_OK || !in_array(pathinfo($cv['name'], PATHINFO_EXTENSION), ['pdf', 'doc', 'docx']))) {
        $errors[] = "CV must be a valid file (.pdf, .doc, .docx).";
    }
 
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        exit;
    }
 
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] == 0) {
        $targetDir = "../../images/";
        $fileExtension = pathinfo($_FILES['cv']['name'], PATHINFO_EXTENSION); // Get file extension
        $newFileName = $username . '.' . $fileExtension; // Rename file to the username
        $targetFile = $targetDir . $newFileName;
 
        // Move the uploaded file to the target directory with the new name
        if (move_uploaded_file($_FILES['cv']['tmp_name'], $targetFile)) {
            $cvPath = $targetFile; // Store the new file path
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    } else {
        $cvPath = null; // Handle case where no CV is uploaded
    }
 
    // Initialize database connection
    $db = new mydb();
    $connobject = $db->openCon();
 
    // Call addEmployee function to insert data
    $result = $db->addEmployee($username, $password, $email, $fullName, $phone, $workShift, $cvPath, $age, $connobject);
 
    session_start(); // Start session to pass the message
    if ($result) {
        $_SESSION['registration_success'] = "Employee registered successfully!";
        header("Location: ../../layout/view/login.php");
        exit;
    } else {
        echo "Failed to register employee. Username might already be taken.";
    }
}
?>