<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../model/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../../layout/view/login.php");
    exit;
}

$username = $_SESSION['username'];
$db = new mydb();
$conn = $db->openCon();

$accountDetails = $db->getAccountDetails($username, $conn);

$conn->close();
?>
