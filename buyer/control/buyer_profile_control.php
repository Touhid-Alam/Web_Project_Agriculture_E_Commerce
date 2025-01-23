<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('../model/db.php');

// Redirect to login page if the buyer is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$buyerUsername = $_SESSION['username'];

// Initialize database connection
$db = new mydb();
$conn = $db->openCon();

// Fetch all available products or perform search based on query
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
if ($searchTerm) {
    $products = $db->searchAvailableProducts($searchTerm, $conn);
} else {
    $products = $db->getAllAvailableProducts($conn);
}

// Close database connection
$conn->close();
?>
