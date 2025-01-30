<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('../model/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../../layout/view/login.php");
    exit;
}

$sellerUsername = $_SESSION['username'];

$db = new mydb();
$conn = $db->openCon();

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$productHistory = $db->getProductHistory($sellerUsername, $searchTerm, 'asc', $conn);

$conn->close();
?>
