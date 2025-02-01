<?php
include '../model/admindb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $SellerUsername = trim($_POST['SellerUsername']);
    $Email = trim($_POST['Email']);
    $BusinessName = trim($_POST['BusinessName']);
    $ProductType = trim($_POST['ProductType']);
    $Password = trim($_POST['Password']);
    $Fullname = trim($_POST['Fullname']);
    $Phone = trim($_POST['Phone']);
    $Address = trim($_POST['Address']);
    $District = isset($_POST['District']) ? trim($_POST['District']) : '';


    // Handle file upload
    $NID = ''; // Default empty path
    if (isset($_FILES['idProof']) && $_FILES['idProof']['error'] == 0) {
        $targetDir = "../../images/";
        $fileExtension = pathinfo($_FILES['idProof']['name'], PATHINFO_EXTENSION); // Get file extension
        $newFileName = $SellerUsername . '.' . $fileExtension; // Rename file to the username
        $targetFile = $targetDir . $newFileName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['idProof']['tmp_name'], $targetFile)) {
            $NID = $targetFile; // Store the new file path
        } else {
            $errors[] = "Sorry, there was an error uploading your file.";
        }
    }

    // Database Connection
    $mydb = new mydb();
    $connobject = $mydb->openCon();

    // Update query
    $updateSuccess = $mydb->updateSeller(
        "seller",
        $SellerUsername,
         $Email, 
         $Password, 
         $BusinessName, 
         $ProductType, 
         $Fullname, 
         $Phone, 
         $Address, 
         $District, 
         $NID,
        $connobject
    );

    if ($updateSuccess) {
        echo "<p>Seller information updated successfully.</p>";
        echo '<a href="../view/seller_info.php">Go Back</a>';
    } else {
        echo "<p>Error: Could not update seller information. " . $connobject->error . "</p>";
        echo '<a href="../view/seller_info.php">Go Back</a>';
    }

    $connobject->close();
} else {
    die("Invalid request.");
}
?>
