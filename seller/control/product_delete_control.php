<?php
session_start();
include('../model/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../../layout/view/login.php");
    exit;
}

$pid = $_GET['pid'];
$db = new mydb();
$conn = $db->openCon();
$db->deleteProduct($pid, $conn);

header("Location: ../view/seller_profile.php");
?>
