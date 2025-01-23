<?php
include('../model/db.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $SellerUsername = $_POST['username']; // Get username
    $password = $_POST['password']; // Get password
    $email = $_POST['email']; // Get email
    $businessName = $_POST['businessName']; // Get business name
    $productType = $_POST['productType']; // Get product type
    $fullName = $_POST['fullName'] ; // Get full name
    $phone = $_POST['phone'] ; // Get phone number
    $address = $_POST['address']; // Get address
    $district = $_POST['district']; // Get district
    $idProofPath = ""; // This will store the renamed file path

    // Initialize database connection
    $db = new mydb();
    $connobject = $db->openCon();

    // Check if username already exists
    if ($db->checkUsernameExists($SellerUsername, $connobject)) {
        $_SESSION['registration_error'] = "Username already exists. Please choose a different username.";
        header("Location: ../view/seller_registration.php");
        exit;
    }

    // Handle file upload
    if (isset($_FILES['idProof']) && $_FILES['idProof']['error'] == 0) {
        $targetDir = "../../images/";
        $fileExtension = pathinfo($_FILES['idProof']['name'], PATHINFO_EXTENSION); // Get file extension
        $newFileName = $SellerUsername . '.' . $fileExtension; // Rename file to the username
        $targetFile = $targetDir . $newFileName;

        // Move the uploaded file to the target directory with the new name
        if (move_uploaded_file($_FILES['idProof']['tmp_name'], $targetFile)) {
            $idProofPath = $targetFile; // Store the new file path
        } else {
            $_SESSION['registration_error'] = "Sorry, there was an error uploading your file.";
            header("Location: ../view/seller_registration.php");
            exit;
        }
    }

    // First, create the account
    $accountQuery = "INSERT INTO account (username, usertype, totalbalance) 
                     VALUES ('$SellerUsername', 'Seller', 0)";

    if ($connobject->query($accountQuery) === TRUE) {
        // Get the AccountID from the account table
        $accountID = $connobject->insert_id;

        // Now, call the addSeller function and pass the AccountID
        $result = $db->addSeller($SellerUsername, $password, $email, $businessName, $productType, $fullName, $phone, $address, $district, $idProofPath, $accountID, $connobject);

        if ($result) {
            $_SESSION['registration_success'] = "Seller registered successfully!";
            header("Location: ../../layout/view/login.php");
            exit;
        } else {
            $_SESSION['registration_error'] = "Failed to register seller. Please try again.";
            header("Location: ../view/seller_registration.php");
            exit;
        }
    } else {
        $_SESSION['registration_error'] = "Failed to create account. Please try again.";
        header("Location: ../view/seller_registration.php");
        exit;
    }
}
?>
