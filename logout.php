<?php
session_start();
include 'db_connect.php';
session_destroy();
header('Location: HomePage.php'); // Redirect to the homepage or login page after logout
exit;
?>
