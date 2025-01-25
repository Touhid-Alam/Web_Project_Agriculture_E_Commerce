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

    //image upload
    if (isset($_FILES['Picture']) && $_FILES['Picture']['error'] == 0) {
        $Picture = $_FILES['Picture'];
        $target_dir = "../../images/";
        $imageFileType = strtolower(pathinfo($Picture['name'], PATHINFO_EXTENSION));
        $allowed_extensions = array("jpeg", "jpg", "png");

        // Check if the uploaded file has an allowed extension
        if (!in_array($imageFileType, $allowed_extensions)) {
            echo "Sorry, only JPEG, JPG, and PNG files are allowed.";
        } else {
            // Generate file name as pid_<unique_id>.<extension>
            // The $pid should be generated dynamically or passed through URL
            if (isset($_GET['pid'])) {
                $pid = $_GET['pid'];
            } else {
                $pid = uniqid('pid_', true); // If pid is not passed, generate a unique one for new product
            }

            // Generate the unique file name for the picture
            $file_name = "pid_" . $pid . "." . $imageFileType;
            $target_file = $target_dir . $file_name;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($Picture['tmp_name'], $target_file)) {
                // Insert the product into the database with the generated pid and image
                $db = new mydb();
                $conn = $db->openCon();

                // If a product exists, update it, otherwise insert a new product
                if (isset($_GET['pid'])) {
                    // Update the existing product
                    $db->updateProduct($pid, $PName, $Price, $Quantity, $file_name, $Details, $conn);
                } else {
                    // Add the new product with a new pid
                    $db->addProduct($_SESSION['username'], $PName, $Price, $Quantity, $file_name, $Details, $conn);
                }

                // Redirect to the seller profile page after the operation
                header("Location: ../view/seller_profile.php");
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}
?>
