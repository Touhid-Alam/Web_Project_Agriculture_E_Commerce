<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('../model/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../../layout/view/login.php");
    exit;
}

$db = new mydb();
$conn = $db->openCon();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deliveryId = $_POST['delivery_id'];
    $fullName = trim($_POST['fullName']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $vehicle = trim($_POST['vehicle']);
    $age = trim($_POST['age']);

    // Validate inputs
    if (empty($fullName) || empty($email) || empty($phone) || empty($vehicle) || empty($age)) {
        $_SESSION['error_message'] = "All fields are required.";
        header("Location: ../view/update_delivery.php?delivery_id=" . $deliveryId);
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = "Invalid email format.";
        header("Location: ../view/update_delivery.php?delivery_id=" . $deliveryId);
        exit();
    }

    if (!is_numeric($phone) || strlen($phone) !== 10) {
        $_SESSION['error_message'] = "Phone number must be exactly 10 digits.";
        header("Location: ../view/update_delivery.php?delivery_id=" . $deliveryId);
        exit();
    }

    $ageNumber = intval($age);
    if ($ageNumber < 18) {
        $_SESSION['error_message'] = "Age must be at least 18.";
        header("Location: ../view/update_delivery.php?delivery_id=" . $deliveryId);
        exit();
    }

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
