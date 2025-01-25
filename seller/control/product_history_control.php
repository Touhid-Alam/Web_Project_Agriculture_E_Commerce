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

// Fetch the ordered product details for the seller
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$sortOrder = isset($_GET['sort']) ? $_GET['sort'] : 'asc';
$productHistory = $db->getProductHistory($sellerUsername, $searchTerm, $sortOrder, $conn);

$conn->close();
?>
