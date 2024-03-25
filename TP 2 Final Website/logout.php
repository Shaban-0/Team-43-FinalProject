<?php
session_start();
include 'db_connect.php';

// Clear the remember_me cookie
if (isset($_COOKIE['remember_me'])) {
    unset($_COOKIE['remember_me']);
    setcookie('remember_me', '', time() - 3600, '/'); // Set the cookie expiration date in the past to delete it
}

// Destroy all session data
session_destroy();

// Redirect to the homepage or login page after logout
header('Location: HomePage.php');
exit;
?>
