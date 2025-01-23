<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('../model/db.php');

// Redirect to login page if the buyer is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../../layout/view/login.php");
    exit;
}

$buyerUsername = $_SESSION['username'];

// Initialize database connection
$db = new mydb();
$conn = $db->openCon();

// Fetch all available products or perform search based on query
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
if ($searchTerm) {
    $products = $db->searchAvailableProducts($searchTerm, $conn);
} else {
    $products = $db->getAllAvailableProducts($conn);
}

// Handle AJAX request for adding, reducing, and deleting products from the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add_to_cart') {
        $pid = $_POST['pid'];
        $quantity = $_POST['quantity'];

        $product = $db->getProductById($pid, $conn);
        $totalCartQuantity = isset($_SESSION['cart'][$pid]) ? $_SESSION['cart'][$pid]['Quantity'] + $quantity : $quantity;

        if ($totalCartQuantity <= $product['Quantity']) {
            if (isset($_SESSION['cart'][$pid])) {
                $_SESSION['cart'][$pid]['Quantity'] += $quantity;
                $_SESSION['cart'][$pid]['TotalPrice'] += $product['Price'] * $quantity;
            } else {
                $cartItem = [
                    'PName' => $product['PName'],
                    'Price' => $product['Price'],
                    'Quantity' => $quantity,
                    'TotalPrice' => $product['Price'] * $quantity
                ];
                $_SESSION['cart'][$pid] = $cartItem;
            }

            // Fetch updated cart products
            $cartProducts = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

            // Return response as JSON
            echo json_encode(['success' => true, 'cartProducts' => $cartProducts]);
        } else {
            // Return response as JSON with error
            echo json_encode(['success' => false, 'message' => 'Not enough products available.']);
        }
        exit;
    } elseif ($_POST['action'] === 'reduce_from_cart') {
        $pid = $_POST['pid'];
        $quantity = $_POST['quantity'];

        if (isset($_SESSION['cart'][$pid])) {
            $_SESSION['cart'][$pid]['Quantity'] -= $quantity;
            $_SESSION['cart'][$pid]['TotalPrice'] -= $_SESSION['cart'][$pid]['Price'] * $quantity;

            if ($_SESSION['cart'][$pid]['Quantity'] <= 0) {
                unset($_SESSION['cart'][$pid]);
            }
        }

        // Fetch updated cart products
        $cartProducts = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

        // Return response as JSON
        echo json_encode(['success' => true, 'cartProducts' => $cartProducts]);
        exit;
    } elseif ($_POST['action'] === 'delete_from_cart') {
        $pid = $_POST['pid'];

        if (isset($_SESSION['cart'][$pid])) {
            unset($_SESSION['cart'][$pid]);
        }

        // Fetch updated cart products
        $cartProducts = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

        // Return response as JSON
        echo json_encode(['success' => true, 'cartProducts' => $cartProducts]);
        exit;
    } elseif ($_POST['action'] === 'place_order') {
        // Handle placing the order
        $totalPrice = array_sum(array_column($_SESSION['cart'], 'TotalPrice'));

        // Check if the buyer has enough balance
        $buyerBalance = $db->getBuyerBalance($buyerUsername, $conn);
        if ($buyerBalance >= $totalPrice) {
            $orderId = $db->createOrder($buyerUsername, $totalPrice, $conn);

            foreach ($_SESSION['cart'] as $pid => $cartProduct) {
                $product = $db->getProductById($pid, $conn);
                $db->addOrderedProduct($orderId, $pid, $cartProduct['Quantity'], $cartProduct['Price'], $product['SellerUsername'], $conn);
                $newQuantity = $product['Quantity'] - $cartProduct['Quantity'];
                $db->updateProductQuantity($pid, $newQuantity, $conn);
            }

            // Reduce the buyer's balance
            $db->updateBuyerBalance($buyerUsername, $totalPrice, 'withdraw', $conn);

            // Clear the cart
            unset($_SESSION['cart']);

            // Return response as JSON
            echo json_encode(['success' => true]);
        } else {
            // Return response as JSON with error
            echo json_encode(['success' => false, 'message' => 'Not enough balance.']);
        }
        exit;
    }
}

// Fetch products in the cart from the session
$cartProducts = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Close database connection
$conn->close();
?>
