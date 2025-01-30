<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once('../model/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../view/employee_login.php");
    exit;
}

$db = new mydb();
$conn = $db->openCon();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $workshift = $_POST['workshift'];

    $db->updateEmployeeProfile($username, $fullname, $email, $phone, $workshift, $conn);

    $employeeDetails = $db->getEmployeeProfile($username, $conn);
    $_SESSION['employeeDetails'] = $employeeDetails;
}

$conn->close();

header("Location: ../view/employee_profile.php");
exit();
?>
