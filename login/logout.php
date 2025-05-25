<?php
session_destroy();

// Redirect to login page
header("Location: ../login/login.php");
exit();
?>
?>