<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once('../model/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../view/employee_login.php");
    exit;
}

$db = new mydb();
$conn = $db->openCon();

$employeeDetails = $db->getEmployeeProfile($_SESSION['username'], $conn);
$pendingOrders = $db->getPendingOrders($conn);
$deliverymen = $db->getAllDeliveries($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id']) && isset($_POST['DeliveryUsername'])) {
    $orderId = $_POST['order_id'];
    $deliveryUsername = $_POST['DeliveryUsername'];
    if (!empty($deliveryUsername)) {
        $db->assignOrderToDelivery($orderId, $deliveryUsername, $conn);
    }
}

$conn->close();

$_SESSION['employeeDetails'] = $employeeDetails;
$_SESSION['pendingOrders'] = $pendingOrders;
$_SESSION['deliverymen'] = $deliverymen;

header("Location: ../view/employee_profile.php");
exit();
?>
