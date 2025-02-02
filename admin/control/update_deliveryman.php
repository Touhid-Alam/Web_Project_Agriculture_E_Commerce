<?php
include '../model/admindb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $DeliveryUsername = trim($_POST['DeliveryUsername']);
    $Email = trim($_POST['Email']);
    $Password = trim($_POST['Password']);
    $Fullname = trim($_POST['Fullname']);
    $Phone = trim($_POST['Phone']);
    $Age = trim($_POST['Age']);
    $vehicle = isset($_POST['Vehicle']) ? ($_POST['Vehicle'] === 'yes' ? 'yes' : 'no') : null;

    
    // Handle file upload for CV
    $CV = ''; // Default empty path
    if (isset($_FILES['CV']) && $_FILES['CV']['error'] == 0) {
        $targetDir = "../../images/";
        $fileExtension = pathinfo($_FILES['CV']['name'], PATHINFO_EXTENSION); // Get file extension
        $newFileName = $DeliveryUsername . '.' . $fileExtension; // Rename file to the username
        $targetFile = $targetDir . $newFileName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['CV']['tmp_name'], $targetFile)) {
            $CV = $targetFile; // Store the new file path
        } else {
            $errors[] = "Sorry, there was an error uploading your file.";
        }
    }

    // Database Connection
    $mydb = new mydb();
    $connobject = $mydb->openCon();

    // Update query
    $updateSuccess = $mydb->updateDeliveryMan(
        "deliveryman",
        $DeliveryUsername,
        $Email,
        $Password,
        $Fullname,
        $Phone,        
        $vehicle,
        $CV,
        $Age,
        $connobject
    );

    if ($updateSuccess) {
        echo "<p>Delivery Man information updated successfully.</p>";
        echo '<a href="../view/delivery_info.php">Go Back</a>';
    } else {
        echo "<p>Error: Could not update delivery man information. " . $connobject->error . "</p>";
        echo '<a href="../view/delivery_info.php">Go Back</a>';
    }

    $connobject->close();
} else {
    die("Invalid request.");
}
?>
