<?php
session_start();
session_unset();
session_destroy();
header('Location: ../../layout/view/login.php'); 
?>