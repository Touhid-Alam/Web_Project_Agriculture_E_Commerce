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
$pendingOrders = $db->getPendingOrdersForDeliveryman($_SESSION['username'], $conn);

// Fetch delivery details if not already set
if (!isset($_SESSION['deliveryDetails'])) {
    $_SESSION['deliveryDetails'] = $db->getDeliveryDetails($_SESSION['username'], $conn);
}

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

    header("Location: ../view/delivery_profile.php");
    exit();
}

// Handle delivery status update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['order_id'])) {
    $orderId = trim($_POST['order_id']);
    $status = isset($_POST['status_' . $orderId]) ? 'completed' : 'pending';

    $result = $db->updateDeliveryStatus($orderId, $status, $conn);

    if ($result) {
        $_SESSION['success_message'] = "Delivery status updated successfully.";
    } else {
        $_SESSION['error_message'] = "Failed to update delivery status.";
    }

    header("Location: ../view/delivery_profile.php");
    exit();
}

// Handle delivery profile deletion
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['deleteDelivery'])) {
    $deliveryId = trim($_POST['delivery_id']);
    $result = $db->deleteDelivery($deliveryId, $conn);

    if ($result) {
        $_SESSION['success_message'] = "Delivery profile deleted successfully.";
    } else {
        $_SESSION['error_message'] = "Failed to delete delivery profile.";
    }

    header("Location: ../view/delivery_profile.php");
    exit();
}

// Handle delivery profile update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['updateDelivery'])) {
    $deliveryId = trim($_POST['delivery_id']);
    $fullName = trim($_POST['fullName']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $vehicle = trim($_POST['vehicle']);
    $age = trim($_POST['age']);

    $result = $db->updateDelivery($deliveryId, $fullName, $email, $phone, $vehicle, $age, $conn);

    if ($result) {
        $_SESSION['success_message'] = "Delivery profile updated successfully.";
    } else {
        $_SESSION['error_message'] = "Failed to update delivery profile.";
    }

    header("Location: ../view/delivery_profile.php");
    exit();
}

// Handle logout
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['logout'])) {
    session_destroy();
    header("Location: ../../layout/view/login.php");
    exit();
}

$conn->close();
?>
