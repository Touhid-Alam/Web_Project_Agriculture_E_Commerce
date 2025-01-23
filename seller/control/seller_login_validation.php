<?php
session_start();  // Start the session

// Include the database connection file
include('../model/db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get POST data from the login form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Initialize database connection
    $db = new mydb();
    $conn = $db->openCon(); // Open a connection to the database

    // Check seller login credentials
    $loginSuccess = $db->checkSellerLogin($username, $password, $conn);

    if ($loginSuccess) {
        $_SESSION['username'] = $username;
        // Redirect to the seller dashboard or profile page
        header("Location: ../view/seller_profile.php");
        exit();
    } else {
        // Set an error message for invalid credentials
        $_SESSION['error_message'] = "Invalid username or password.";
        header("Location: ../../.php");  // Redirect back to login page
        exit();
    }
} else {
    // If the script is accessed without a POST request, redirect to login
    header("Location: ..seller_login.php");
    exit();
}
