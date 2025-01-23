<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../model/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../view/buyer_login.php");
    exit;
}

$username = $_SESSION['username']; // Assuming the username is stored in the session
$db = new mydb();
$conn = $db->openCon();

// Fetch buyer details for the form
$buyer = $db->getBuyerDetails($username, $conn);

// Handle the form submission for updating the buyer profile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $fullName = $_POST['fullName'];
    $phone = $_POST['phone'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $password = $_POST['password'];

    // Update buyer profile
    $db->updateBuyerProfile($username, $fullName, $email, $phone, $dateOfBirth, $password, $conn);

    // Redirect to the buyer profile page after updating
    header("Location: ../view/buyer_profile.php");
    exit;
}

$conn->close();
?>
