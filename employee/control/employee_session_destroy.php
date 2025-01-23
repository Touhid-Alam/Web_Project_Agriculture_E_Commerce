<?php
session_start();
session_unset();
session_destroy();
header('Location: ../view/employee_login.php'); 
?>