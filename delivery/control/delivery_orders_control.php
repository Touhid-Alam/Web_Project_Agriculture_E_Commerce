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

$pendingOrders = $db->getPendingOrdersForDeliveryman($_SESSION['username'], $conn);

// Handle delivery status update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['order_id']) && isset($_POST['action'])) {
    $orderId = trim($_POST['order_id']);
    $status = isset($_POST['status']) ? trim($_POST['status']) : '';

    if ($_POST['action'] === 'update_status') {
        $result = $db->updateDeliveryStatus($orderId, $status, $conn);

        if ($result) {
            $_SESSION['success_message'] = "Delivery status updated successfully.";
            // Remove the order from the pending orders list if completed
            if ($status === 'completed') {
                $pendingOrders = array_filter($pendingOrders, function($order) use ($orderId) {
                    return $order['OID'] !== $orderId;
                });
                // Pass the completed order to the admin
                $_SESSION['completedOrders'][] = $orderId;
            }
        } else {
            $_SESSION['error_message'] = "Failed to update delivery status.";
        }

        header("Location: ../view/delivery_orders.php");
        exit();
    } elseif ($_POST['action'] === 'submit_order') {
        // Update the order status to completed and notify the admin
        $result = $db->updateDeliveryStatus($orderId, 'completed', $conn);
        if ($result) {
            $_SESSION['success_message'] = "Order submitted successfully.";
            // Notify the admin (you can implement the notification logic here)
        } else {
            $_SESSION['error_message'] = "Failed to submit order.";
        }
    }
}

$conn->close();
?>
