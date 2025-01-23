<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('../model/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../../layout/view/login.php");
    exit;
}

$buyerUsername = $_SESSION['username'];

$db = new mydb();
$conn = $db->openCon();

// Fetch the order history for the buyer
$orders = $db->getOrderHistory($buyerUsername, $conn);

$conn->close();
?>
