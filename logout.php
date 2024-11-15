<?php
session_start();
unset($_SESSION['username']);  // Unset the session variable for the username
session_destroy();  // Destroy the session
header("Location: login.php");  // Redirect to login page
exit();
?>
