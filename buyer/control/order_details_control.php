<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('../model/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../../layout/view/login.php");
    exit;
}

$oid = $_GET['oid'];

$db = new mydb();
$conn = $db->openCon();

// Fetch the details of the specific order
$orderDetails = $db->getOrderDetails($oid, $conn);

$conn->close();
?>
