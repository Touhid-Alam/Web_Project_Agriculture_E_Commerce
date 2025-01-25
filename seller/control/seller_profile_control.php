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

// Get all products for the seller or perform search
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
if ($searchTerm) {
    $products = $db->searchProducts($sellerUsername, $searchTerm, $conn);

} else {
    $products = $db->getSellerProducts($sellerUsername, $conn);
}

$conn->close();
?>
