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

if (isset($_GET['delivery_id'])) {
    $deliveryId = $_GET['delivery_id'];
    $delivery = $db->getDeliveryById($deliveryId, $conn);
    if (!$delivery) {
        $error = "Delivery profile not found.";
    }
}

$conn->close();
?>
