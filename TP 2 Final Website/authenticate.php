<?php
session_start();
include 'db_connect.php';
include 'session_manager.php'; // Assuming this is the file containing the createOrGetSessionId function

function generateRememberMeToken() {
    return bin2hex(random_bytes(64)); // Generate a secure token
}

function storeTokenForUser($conn, $customerId, $token) {
    // Implement the logic to store the token in your database
    $sql = "UPDATE customer SET remember_me_token = ? WHERE customerID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $token, $customerId);
    $stmt->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT customerID, firstname, password_hash FROM customer WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            $_SESSION['customerID'] = $row['customerID'];
            $_SESSION['username'] = $username;
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['loggedin'] = true;

            $sessionId = createOrGetSessionId($conn, $row['customerID']);
            $_SESSION['sessionID'] = $sessionId;

            if (isset($_POST['remember'])) {
                $token = generateRememberMeToken();
                storeTokenForUser($conn, $row['customerID'], $token);
                setcookie('remember_me', $token, time() + 86400 * 30, '/'); // 30-day expiry
            }

            $_SESSION['success_message'] = "Login successful! Welcome, " . $row['firstname'];
            header("Location: homepage.php");
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Invalid username.";
    }
} else {
    echo "Invalid request method.";
}
?>
