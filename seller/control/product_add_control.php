<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../model/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../../layout/view/login.php");
    exit;
}

// Check if the form is being submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $PName = $_POST['PName'];
    $Price = $_POST['Price'];
    $Quantity = $_POST['Quantity'];
    $Details = $_POST['Details'];

    // Image upload
    if (isset($_FILES['Picture']) && $_FILES['Picture']['error'] == 0) {
        $Picture = $_FILES['Picture'];
        $target_dir = "../../images/";
        $imageFileType = strtolower(pathinfo($Picture['name'], PATHINFO_EXTENSION));
        $allowed_extensions = array("jpeg", "jpg", "png");

        $db = new mydb();
        $conn = $db->openCon();

        // Insert the product into the database without the image first
        $db->addProduct($_SESSION['username'], $PName, $Price, $Quantity, '', $Details, $conn);

        // Get the last inserted product ID
        $last_id = $conn->insert_id;

        // Generate the unique file name for the picture using the product ID
        $file_name = "pid_" . $last_id . "." . $imageFileType;
        $target_file = $target_dir . $file_name;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($Picture['tmp_name'], $target_file)) {
            // Update the product with the image file name
            $db->updateProduct($last_id, $PName, $Price, $Quantity, $file_name, $Details, $conn);

            // Redirect to the seller profile page after the operation
            header("Location: ../view/seller_profile.php");
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
