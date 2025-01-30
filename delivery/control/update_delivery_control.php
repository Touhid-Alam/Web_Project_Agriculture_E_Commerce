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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deliveryId = $_POST['delivery_id'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $vehicle = $_POST['vehicle'];
    $age = $_POST['age'];

    $result = $db->updateDelivery($deliveryId, $fullName, $email, $phone, $vehicle, $age, $conn);

    if ($result) {
        $_SESSION['success_message'] = "Delivery profile updated successfully.";
        $_SESSION['deliveryDetails'] = $db->getDeliveryById($deliveryId, $conn);
        header("Location: ../view/delivery_profile.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Failed to update delivery profile.";
        header("Location: ../view/update_delivery.php?delivery_id=" . $deliveryId);
        exit();
    }
}

// Fetch delivery details for the update form
if (isset($_GET['delivery_id'])) {
    $deliveryId = $_GET['delivery_id'];
    $delivery = $db->getDeliveryById($deliveryId, $conn);
    if (!$delivery) {
        $error = "Delivery details not found.";
    } else {
        $_SESSION['delivery'] = $delivery;
    }
}

$conn->close();
?>
