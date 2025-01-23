<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('../model/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: delivery_login.php");
    exit;
}

$db = new mydb();
$conn = $db->openCon();

$showTable = isset($_SESSION['showTable']) ? $_SESSION['showTable'] : false;
$deliveries = [];

// Toggle the visibility of the delivery table
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggleTable'])) {
    $showTable = !$showTable;
    $_SESSION['showTable'] = $showTable;
}

// Fetch all deliveries or perform search
if ($showTable) {
    $deliveries = $db->getAllDeliveries($conn);
} elseif (isset($_GET['search'])) {
    $searchTerm = trim($_GET['search']);
    if (empty($searchTerm)) {
        $error = "Search term cannot be empty.";
    } else {
        $deliveries = $db->searchDeliveries($searchTerm, $conn);
    }
}

$conn->close();
?>
