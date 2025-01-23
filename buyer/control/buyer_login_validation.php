<?php
session_start();  // Start the session


include('../model/db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get POST data from the login form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    
    $db = new mydb();
    $conn = $db->openCon(); // Open a connection to the database


    $loginSuccess = $db->checkBuyerLogin($username, $password, $conn);

    if ($loginSuccess) {
        $_SESSION['username'] = $username;
        
        header("Location: ../view/buyer_profile.php");
        //echo "Succesfully Login.";
        exit();
    } else {
        // Set an error message for invalid credentials
        $_SESSION['error_message'] = "Invalid username or password.";
        header("Location: ../view/buyer_login.php");  // Redirect back to login page
        exit();
    }
} else {
    
    header("Location: ../buyer_login.php");
    exit();
}
