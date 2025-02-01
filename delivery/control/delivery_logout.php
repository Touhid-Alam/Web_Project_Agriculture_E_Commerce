
<?php
session_start();
session_destroy();
header("Location: ../../layout/view/login.php");
exit();
?>