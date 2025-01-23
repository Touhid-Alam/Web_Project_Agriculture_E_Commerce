<?php
include '../model/admindb.php';
session_start();

$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {


   
    $username = trim($_POST['username']);
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $errors[] = "Username should only contain alphabets and numbers.";
    }
     
   
   $email = trim($_POST['email']);

    
    $password = $_POST['password'];
    if (!preg_match("/[0-9]/", $password) || !preg_match("/[A-Z]/", $password) || strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long, contain at least one numeric character, and one uppercase letter.";
    }
    
    
    $fullname = trim($_POST['fullname']);
    if (!preg_match("/^[a-zA-Z ]*$/", $fullname)) {
        $errors[] = "Full name should only contain alphabets and spaces.";
    }

    $idProofPath = ""; // This will store the renamed file path

    
    if (isset($_FILES['idProof']) && $_FILES['idProof']['error'] == 0) {
        $targetDir = "../../images/";
        $fileExtension = pathinfo($_FILES['idProof']['name'], PATHINFO_EXTENSION); // Get file extension
        $newFileName = $username. '.' . $fileExtension; // Rename file to the username
        $targetFile = $targetDir . $newFileName;


        if (move_uploaded_file($_FILES['idProof']['tmp_name'], $targetFile)) {
            $idProofPath = $targetFile; 
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    }

    
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
    
    else {
        $mydb = new mydb();
        $connobject = $mydb->openCon();
        $result = $mydb->addAdmin("admin", $username, $email, $password, $fullname, $idProofPath, $connobject);

        if ($result === true) {
            $_SESSION['name'] = $username;
            $_SESSION['email'] = $email;

            header("Location: ../../layout/view/login.php");
        } else {
            echo "Error: " . $connobject->error;
        }

        $connobject->close();
    }
    
}
?>
