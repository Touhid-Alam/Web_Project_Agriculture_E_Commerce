<?php

include '../model/admindb.php';
session_start();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new mydb();
    $conn = $db->openCon();

    $result = $db->loginAdmin('admin', $username, $password, $conn);

    // Check if the query returned any results (i.e., valid admin)
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch user details
        $_SESSION['adminUsername'] = $row['AdminUsername'];
        $_SESSION['adminEmail'] = $row['Email'];
        $_SESSION['adminFullname'] = $row['Fullname'];
        $_SESSION['adminNidPath'] = $row['NID'];

        // Redirect to profile page
        header('Location: ../view/admin_dashboard.php');
        exit();
    } else {
        
        header('Location: ../view/admin_login.php?error=Invalid username or password');
        exit();
    }
    $conn->close();
}
?>
