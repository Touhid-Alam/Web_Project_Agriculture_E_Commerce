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
$db = new mydb();
$conn = $db->openCon();

// Get all products for the seller or perform search
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
if ($searchTerm) {
    $products = $db->searchProducts($sellerUsername, $searchTerm, $conn);
} else {
    $products = $db->getSellerProducts($sellerUsername, $conn);
}

$conn->close();

if (!empty($products)) {
    echo '<table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Picture</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>';
    foreach ($products as $product) {
        echo '<tr>
                <td>' . htmlspecialchars($product['PID']) . '</td>
                <td>' . htmlspecialchars($product['PName']) . '</td>
                <td>' . htmlspecialchars($product['Price']) . '</td>
                <td>' . htmlspecialchars($product['Quantity']) . '</td>
                <td><img src="../../images/' . htmlspecialchars($product['Picture']) . '" width="100"></td>
                <td>
                    <a href="view_product.php?pid=' . $product['PID'] . '">View</a> |
                    <a href="edit_product.php?pid=' . $product['PID'] . '">Edit</a> |
                    <button class="deleteProduct" data-pid="' . $product['PID'] . '">Delete</button>
                </td>
            </tr>';
    }
    echo '</tbody></table>';
} else {
    echo '<p>No products found.</p>';
}
?>
