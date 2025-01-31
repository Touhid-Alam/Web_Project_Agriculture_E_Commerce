<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: ../../layout/view/login.php");
exit();
?>
