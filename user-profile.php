
<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}


//db connection code 


// Fetch user information from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Display user profile information
    echo "<h2>Profile Information</h2>";
    echo "<p><strong>Name:</strong> " . $row['name'] . "</p>";
    echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
    // You can display more profile information here
    
} else {
    echo "User not found";
}

$conn->close();

?>

