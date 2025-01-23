<?php

include('../model/db.php');

session_start();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and trim inputs
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone']));
    $dateOfBirth = htmlspecialchars(trim($_POST['dateofbirth']));
    $fullName = htmlspecialchars(trim($_POST['fullName']));

    // Initialize an errors array
    $errors = [];

    // Validation checks
    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    if (empty($fullName) || preg_match('/\d/', $fullName)) {
        $errors[] = "Full Name is required and should not contain numbers.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (!preg_match('/[@#$&]/', $password)) {
        $errors[] = "Password must contain at least one special character (@, #, $, or &).";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($phone) || !preg_match('/^\d{1,11}$/', $phone)) {
        $errors[] = "Phone number is required and must be numeric, with no more than 11 digits.";
    }
    if (empty($dateOfBirth) || !DateTime::createFromFormat('Y-m-d', $dateOfBirth)) {
        $errors[] = "Please enter a valid date in the format YYYY-MM-DD.";
    }

    // If there are no errors, proceed with registration
    if (empty($errors)) {
    
        $db = new mydb();
        $connobject = $db->openCon();

        // First, create the account in the account table
        $accountQuery = "INSERT INTO account (username, usertype, totalbalance) 
                         VALUES ('$username', 'buyer', 0)";

        if ($connobject->query($accountQuery) === TRUE) {
            
            $accountID = $connobject->insert_id;

        
            $result = $db->addBuyer($username, $password, $email, $fullName, $phone, $dateOfBirth, $connobject);

            
            if ($result) {
                $_SESSION['registration_success'] = "Buyer registered successfully!";
                header("Location: ../../layout/view/login.php");
                exit;
            } else {
                $_SESSION['registration_error'] = "Failed to register buyer. Please try again.";
                header("Location: ../view/buyer_registration.php");
                exit;
            }
        } else {
            $_SESSION['registration_error'] = "Failed to create account. Please try again.";
            header("Location: ../../layout/view/login.php");
            exit;
        }
    } else {
        $_SESSION['registration_error'] = implode("<br>", $errors);
        header("Location: ../view/buyer_registration.php");
        exit;
    }
}
?>
