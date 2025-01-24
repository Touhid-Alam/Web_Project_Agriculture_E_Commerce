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

// Handle order assignment
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['order_id']) && isset($_POST['delivery_username'])) {
    $orderId = trim($_POST['order_id']);
    $deliveryUsername = trim($_POST['delivery_username']);

    $result = $db->assignOrderToDelivery($orderId, $deliveryUsername, $conn);

    if ($result) {
        $_SESSION['success_message'] = "Order assigned successfully.";
    } else {
        $_SESSION['error_message'] = "Failed to assign order.";
    }

    header("Location: ../view/employee_profile.php");
    exit();
}

// Handle delivery status update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['order_id']) && isset($_POST['status'])) {
    $orderId = trim($_POST['order_id']);
    $status = $_POST['status'] === 'on' ? 'completed' : 'pending';

    $result = $db->updateDeliveryStatus($orderId, $status, $conn);

    if ($result) {
        $_SESSION['success_message'] = "Delivery status updated successfully.";
    } else {
        $_SESSION['error_message'] = "Failed to update delivery status.";
    }

    header("Location: ../view/employee_profile.php");
    exit();
}

$conn->close();
?>
