<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../model/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../../layout/view/login.php");
    exit;
}

$username = $_SESSION['username'];  // Assuming the username is stored in session
$db = new mydb();
$conn = $db->openCon();

// Fetch seller details for the form
$seller = $db->getSellerDetails($username, $conn);

// Handle the form submission for updating the NID
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['Email'];
    $businessName = $_POST['BusinessName'];
    $productType = $_POST['ProductType'];
    $fullname = $_POST['Fullname'];
    $phone = $_POST['Phone'];
    $address = $_POST['Address'];
    $district = $_POST['District'];
    $password = $_POST['Password'];

    // Handle the NID file upload
    $NID = $_FILES['NID']['name'] ? $_FILES['NID']['name'] : $seller['NID'];  // Use the existing NID if no new file is uploaded

    if ($_FILES['NID']['error'] == 0) {
        $target_dir = "../../files/";  // Path to store the NID file (could be a 'files' folder)
        $fileType = strtolower(pathinfo($_FILES['NID']['name'], PATHINFO_EXTENSION));

        // Use the seller username as the file name
        $file_name = $username . "." . $fileType;
        $target_file = $target_dir . $file_name;

        // Delete the old NID file if a new one is uploaded
        if ($seller['NID'] && file_exists($target_dir . $seller['NID'])) {
            unlink($target_dir . $seller['NID']);  // Delete the old file
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['NID']['tmp_name'], $target_file)) {
            // Update the seller's NID with the new file
            $db->updateSellerProfile($username, $email, $businessName, $productType, $fullname, $phone, $address, $district, $file_name, $password, $conn);
        } else {
            echo "Error in file upload.";
        }
    } else {
        // Update seller profile without changing the NID if no file is uploaded
        $db->updateSellerProfile($username, $email, $businessName, $productType, $fullname, $phone, $address, $district, $NID, $password, $conn);
    }

    header("Location: ../view/seller_profile.php");
}

$conn->close();
?>
