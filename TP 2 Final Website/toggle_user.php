<?php
session_start();
include 'db_connect.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header('Location: admin_login.php');
    exit;
}

if(isset($_GET['userID'])) {
    $userID = $_GET['userID'];

    // Toggle the isActive status
    $query = "UPDATE users SET isActive = NOT isActive WHERE userID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $userID);
    $stmt->execute();

    if($stmt->affected_rows > 0) {
        echo "User status updated successfully.";
    } else {
        echo "An error occurred.";
    }
    $stmt->close();
    header('Location: manage_users.php');
}
?>
