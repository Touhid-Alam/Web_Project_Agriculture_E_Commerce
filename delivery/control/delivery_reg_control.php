<?php
include('../model/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $fullName = $_POST['fullName'];
    $age = $_POST['age'];
    $vehicle = isset($_POST['vehicle']) ? $_POST['vehicle'] : null;
    $idProofPath = ""; // This will store the renamed file path


    if (strlen($password) < 6 || !preg_match('/[a-z]/', $password)) {
        $errors[] = "Password must be at least 6 characters long and contain at least one lowercase letter.";
    }

    if (!preg_match('/^0[0-9]{9,}$/', $phone)) {
        $errors[] = "Phone number must start with 0 and be at least 10 digits long.";
    }

    

    if ($vehicle !== 'yes' && $vehicle !== 'no') {
        $errors[] = "Please select whether you have a vehicle.";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        exit;
    }

    // Handle file upload
    if (isset($_FILES['idProof']) && $_FILES['idProof']['error'] == 0) {
        $targetDir = "../../images/";
        $fileExtension = pathinfo($_FILES['idProof']['name'], PATHINFO_EXTENSION); // Get file extension
        $newFileName = $username . '.' . $fileExtension; // Rename file to the username
        $targetFile = $targetDir . $newFileName;

        // Move the uploaded file to the target directory with the new name
        if (move_uploaded_file($_FILES['idProof']['tmp_name'], $targetFile)) {
            $idProofPath = "images/" . $newFileName; // Store the new file path relative to the project root
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    }

    // Initialize database connection
    $db = new mydb();
    $connobject = $db->openCon();

    // Call the addDelivery function
    $result = $db->addDelivery($username, $password, $email, $fullName, $phone, $vehicle, $idProofPath, $age, $connobject);

    session_start(); // Start session to pass the message
    if ($result) {
        $_SESSION['registration_success'] = "Delivery person registered successfully!";
        header("Location: ../../layout/view/login.php");
        exit;
    } else {
        echo "Failed to register delivery person. Please try again.";
    }
}
?>
