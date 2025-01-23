<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../model/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../view/employee_login.php");
    exit();
}

$username = $_SESSION['username'];
$db = new mydb();
$connobject = $db->openCon();

// Get employee profile
$profile = $db->getEmployeeProfile($username, $connobject);

// Get all employees or perform search
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$limit = 100; // Limit the number of records fetched
if ($searchTerm) {
    $employeeList = $db->searchEmployeesByUsername($searchTerm, $connobject);
} else {
    $employeeList = $db->viewAllEmployees($connobject, $limit);
}

$connobject->close();

// Store profile data in session or pass it to the view
if ($profile) {
    $_SESSION['profile'] = $profile;
} else {
    $_SESSION['error'] = "Profile not found.";
}

header("Location: ../view/employee_profile.php");
exit();
?>
