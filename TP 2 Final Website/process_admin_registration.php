<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract and sanitize input
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $specialCode = mysqli_real_escape_string($conn, $_POST['specialCode']);

    // Check special code
    if ($specialCode !== "LP212120") {
        die("Invalid special code.");
    }

    // Hash the password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new admin into the admin table
    $sql = "INSERT INTO admin (username, password_hash, firstname, lastname, email) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $password_hash, $firstname, $lastname, $email);
    
    if ($stmt->execute()) {
        echo "Admin registered successfully.";
        // Redirect to admin login page
        header("Location: admin_login.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
