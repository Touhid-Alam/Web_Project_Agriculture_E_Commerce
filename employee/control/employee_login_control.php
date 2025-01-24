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

    // Check employee login credentials
    $loginSuccess = $db->checkEmployeeLogin($username, $password, $conn);

    if ($loginSuccess) {
        $_SESSION['username'] = $username;
        // Redirect to the employee profile control page
        header("Location: employee_profile_control.php");
        exit();
    } else {
        // Set an error message for invalid credentials
        $_SESSION['error_message'] = "Invalid username or password.";
        header("Location: ../view/employee_login.php");  // Redirect back to login page
        exit();
    }
} else {
    // If the script is accessed without a POST request, redirect to login
    header("Location: ../view/employee_login.php");
    exit();
}
