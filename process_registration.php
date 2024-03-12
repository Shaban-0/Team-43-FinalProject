<?php
include 'db_connect.php';
include 'session_manager.php'; // Assuming this is the file containing the createOrGetSessionId function

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hashing the password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $sql = "INSERT INTO customer (username, password_hash, firstname, lastname, email, mobile) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $username, $password_hash, $firstname, $lastname, $email, $mobile);
    
    if ($stmt->execute()) {
        $newCustomerId = $conn->insert_id;
        session_start();
        $_SESSION['customerID'] = $newCustomerId;
        $_SESSION['username'] = $username;

        // Create a new shopping session ID
        $sessionId = createOrGetSessionId($conn, $newCustomerId);
        $_SESSION['sessionID'] = $sessionId;

        header("Location: HomePage.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
