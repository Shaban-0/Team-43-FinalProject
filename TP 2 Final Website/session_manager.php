<?php
function createOrGetSessionId($conn, $customerId) {
    $sql = "SELECT sessionID FROM shoppingsession WHERE customerID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customerId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['sessionID'];
    } else {
        $stmt = $conn->prepare("INSERT INTO shoppingsession (customerID) VALUES (?)");
        $stmt->bind_param("i", $customerId);
        $stmt->execute();
        return $stmt->insert_id;
    }
}
?>
