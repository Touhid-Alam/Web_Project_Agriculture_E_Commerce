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

if (isset($_GET['delivery_id'])) {
    $deliveryId = $_GET['delivery_id'];
    $delivery = $db->getDeliveryById($deliveryId, $conn);
    if (!$delivery) {
        $error = "Delivery profile not found.";
    }
}

$conn->close();
?>
