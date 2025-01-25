<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../model/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../../layout/view/login.php");
    exit;
}

$pid = $_GET['pid'];
$db = new mydb();
$conn = $db->openCon();

// Fetch the product details for editing
$product = $db->getProductById($pid, $conn);

// Handle the form submission for updating the product
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $PName = $_POST['PName'];
    $Price = $_POST['Price'];
    $Quantity = $_POST['Quantity'];
    $Details = $_POST['Details'];
    $Picture = $_FILES['Picture']['name'] ? $_FILES['Picture']['name'] : $product['Picture'];

    // Check if file is being uploaded
    if ($_FILES['Picture']['error'] == 0) {
        $target_dir = "../../images/";
        $imageFileType = strtolower(pathinfo($_FILES['Picture']['name'], PATHINFO_EXTENSION));

        // Use the product ID for the image file name
        $file_name = "pid_" . $pid . "." . $imageFileType;
        $target_file = $target_dir . $file_name;

        // Delete the old image if a new one is uploaded
        if ($product['Picture'] && file_exists($target_dir . $product['Picture'])) {
            unlink($target_dir . $product['Picture']);  // Delete the old image
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['Picture']['tmp_name'], $target_file)) {
            $db->updateProduct($pid, $PName, $Price, $Quantity, $file_name, $Details, $conn);
        } else {
            echo "Error in file upload.";
        }
    } else {
        // update product without changing the picture
        $db->updateProduct($pid, $PName, $Price, $Quantity, $Picture, $Details, $conn);
    }

    header("Location: seller_profile.php");
}

$conn->close();
?>
