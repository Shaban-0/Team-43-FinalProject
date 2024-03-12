<?php
session_start();
include 'db_connect.php';
include 'session_manager.php';

function addItemToCart($conn, $sessionId, $productId, $quantity) {
    $addToBasket = "INSERT INTO basket (sessionID, productID, quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($addToBasket);

    if (!$stmt) {
        error_log("Error preparing statement: " . $conn->error);
        return false;
    }

    $stmt->bind_param("sii", $sessionId, $productId, $quantity);
    if (!$stmt->execute()) {
        error_log("Error executing statement: " . $stmt->error);
        return false;
    }

    return true;
}

if (isset($_POST['productID']) && isset($_POST['quantity'])) {
    $productId = $_POST['productID'];
    $quantity = $_POST['quantity'];

    $customerId = $_SESSION['customerID'] ?? null;
    $sessionId = $customerId ? createOrGetSessionId($conn, $customerId) : session_id();

    if (addItemToCart($conn, $sessionId, $productId, $quantity)) {
        // Redirect to checkout.php
        header("Location: checkout.php");
        exit;
    } else {
        // Handle error (could redirect to an error page or display a message)
        echo "Failed to add item to cart. Please try again.";
    }
} else {
    // Handle invalid request (could redirect to a different page or display a message)
    echo "Invalid request. Please try again.";
}
?>

