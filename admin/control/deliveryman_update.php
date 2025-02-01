<?php
if (isset($_POST['update'])) {
    include '../model/admindb.php';
    $mydb = new mydb();
    $conn = $mydb->openCon();

    $username = $_POST['username'];
    $data = [
        'password' => $_POST['password'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'fullName' => $_POST['fullName'],
        'vehicle' => $_POST['vehicle'],
        'age' => $_POST['age'],
    ];

    // Handling file upload for CV
    if (isset($_FILES['idProof']) && $_FILES['idProof']['error'] == 0) {
        $cvPath = 'uploads/' . basename($_FILES['idProof']['name']);
        move_uploaded_file($_FILES['idProof']['tmp_name'], $cvPath);
        $data['cv'] = $cvPath;
    }

    if ($mydb->updateDeliveryPerson('delivery', $data, $username, $conn)) {
        echo "<p>Delivery person updated successfully.</p>";
    } else {
        echo "<p>Error updating delivery person.</p>";
    }

    $connobject->close();
}
?>
