<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Adjust the SQL to check within the admin table
    $sql = "SELECT adminID, password_hash FROM admin WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            $_SESSION['adminID'] = $row['adminID'];
            $_SESSION['username'] = $username;

            // Redirect to admin dashboard
            header("Location: admin_dashboard.php");
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Invalid username.";
    }
}
?>
