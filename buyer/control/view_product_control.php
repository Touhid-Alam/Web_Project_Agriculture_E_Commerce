<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../model/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../../layout/view/login.php");
    exit;
}

$pid = $_GET['pid'];
$db = new mydb();
$conn = $db->openCon();

// Fetch the product details
$product = $db->getProductById($pid, $conn);

$conn->close();
?>
