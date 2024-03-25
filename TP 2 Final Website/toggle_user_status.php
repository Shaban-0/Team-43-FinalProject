<?php
session_start();
include 'db_connect.php';

// Function to toggle the user's active status
function toggleUserStatus($conn, $userID, $status) {
    // Prepare the update statement
    $stmt = $conn->prepare("UPDATE customer SET isActive = ? WHERE customerID = ?");
    // Bind parameters to the statement
    $stmt->bind_param("ii", $status, $userID);
    // Execute the statement and return the result
    return $stmt->execute();
}

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header('Location: admin_login.php');
    exit;
}

// Check if userID and status are present in the URL
if (isset($_GET['userID']) && isset($_GET['status'])) {
    $userID = intval($_GET['userID']);
    $currentStatus = intval($_GET['status']);
    $newStatus = $currentStatus ? 0 : 1; // Toggle status

    // Update user status in the database
    if (toggleUserStatus($conn, $userID, $newStatus)) {
        // Redirect back to the manage_users.php page with a success message
        header('Location: manage_users.php?statusChanged=1');
        exit;
    } else {
        // Redirect back to the manage_users.php page with an error message
        header('Location: manage_users.php?statusChanged=0');
        exit;
    }
} else {
    // Redirect back to the manage_users.php page if the required parameters are not set
    header('Location: manage_users.php');
    exit;
}
?>
