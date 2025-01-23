<?php
session_start();
include('../model/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $usertype = $_POST['usertype'];

    $db = new mydb();
    $conn = $db->openCon();

    $loginSuccess = false;

    switch ($usertype) {
        case 'admin':
            $loginSuccess = $db->checkAdminLogin($username, $password, $conn);
            $redirectPage = '../../admin/view/admin_dashboard.php';
            break;
        case 'buyer':
            $loginSuccess = $db->checkBuyerLogin($username, $password, $conn);
            $redirectPage = '../../buyer/view/buyer_profile.php';
            break;
        case 'seller':
            $loginSuccess = $db->checkSellerLogin($username, $password, $conn);
            $redirectPage = '../../seller/view/seller_profile.php';
            break;
        case 'employee':
            $loginSuccess = $db->checkEmployeeLogin($username, $password, $conn);
            $redirectPage = '../../employee/view/employee_profile.php';
            break;
        case 'delivery':
            $loginSuccess = $db->checkDeliveryLogin($username, $password, $conn);
            $redirectPage = '../../delivery/view/delivery_profile.php';
            break;
        default:
            $loginSuccess = false;
            break;
    }

    if ($loginSuccess) {
        $_SESSION['username'] = $username;
        $_SESSION['usertype'] = $usertype;
        header("Location: $redirectPage");
    } else {
        $_SESSION['login_error'] = "Invalid credentials or user type.";
        header("Location: ../view/login.php");
    }

    $conn->close();
}
?>
