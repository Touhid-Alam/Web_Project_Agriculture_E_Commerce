<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../model/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../../layout/view/login.php");
    exit;
}

$sellerUsername = $_SESSION['username'];
$pid = isset($_POST['pid']) ? $_POST['pid'] : '';

if ($pid) {
    $db = new mydb();
    $conn = $db->openCon();
    $db->deleteProduct($pid, $conn);
    $conn->close();
}

$db = new mydb();
$conn = $db->openCon();
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

if ($searchTerm) {
    $products = $db->searchProducts($sellerUsername, $searchTerm, $conn);
} else {
    $products = $db->getSellerProducts($sellerUsername, $conn);
}

$conn->close();

if (!empty($products)) {
    foreach ($products as $product) {
        // Output product details in a table row
    }
} else {
    echo '<p>No products found.</p>';
}
?>
