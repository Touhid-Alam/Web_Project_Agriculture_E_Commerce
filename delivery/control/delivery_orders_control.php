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
    
            // Refresh the pending orders list after the update
            $pendingOrders = $db->getPendingOrdersForDeliveryman($_SESSION['username'], $conn);
        } else {
            $_SESSION['error_message'] = "Failed to update delivery status.";
        }
    
        header("Location: ../view/delivery_orders.php");
        exit();
    } elseif ($_POST['action'] === 'notify_admin') {
        // Update the order status to 'completed' in the database
        $result = $db->updateDeliveryStatus($orderId, 'completed', $conn);
        
        if ($result) {
            // Display a table indicating that the order is complete
            echo "<table border='1'>
                    <tr>
                        <th>Order ID</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <td>{$orderId}</td>
                        <td>Completed</td>
                    </tr>
                  </table>";
            
            // Refresh the pending orders list after the update
            $pendingOrders = $db->getPendingOrdersForDeliveryman($_SESSION['username'], $conn);
            
        } else {
            echo "Failed to update order ID $orderId to completed.";
        }
        exit();
    }
}

$conn->close();
?>
