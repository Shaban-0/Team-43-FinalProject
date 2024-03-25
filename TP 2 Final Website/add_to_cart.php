<?php
session_start();
include 'db_connect.php';

// Check if productID and quantity are set
if(isset($_POST['productID']) && isset($_POST['quantity'])) {
    $productID = $_POST['productID'];
    $quantity = $_POST['quantity'];
    $sessionId = $_SESSION['sessionID'] ?? session_id(); // Ensure there's a session ID

    // Check if the item already exists in the basket
    $stmt = $conn->prepare("SELECT * FROM basket WHERE sessionID = ? AND productID = ?");
    $stmt->bind_param("si", $sessionId, $productID);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        // Item exists, update quantity
        $row = $result->fetch_assoc();
        $newQuantity = $row['quantity'] + $quantity;
        $updateStmt = $conn->prepare("UPDATE basket SET quantity = ? WHERE sessionID = ? AND productID = ?");
        $updateStmt->bind_param("isi", $newQuantity, $sessionId, $productID);
        $updateStmt->execute();
    } else {
        // Item doesn't exist, insert new entry
        $insertStmt = $conn->prepare("INSERT INTO basket (sessionID, productID, quantity) VALUES (?, ?, ?)");
        $insertStmt->bind_param("sii", $sessionId, $productID, $quantity);
        $insertStmt->execute();
    }

    echo json_encode(['status' => 'success', 'message' => 'Product added to cart successfully.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Product ID or quantity not provided.']);
}
?>
