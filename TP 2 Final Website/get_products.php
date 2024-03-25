<?php
include 'db_connect.php';

header('Content-Type: application/json');

if (isset($_GET['categoryID']) && $_GET['categoryID'] !== '') {
    $categoryID = $_GET['categoryID'];

    $stmt = $conn->prepare("SELECT productID, name FROM product WHERE categoryID = ?");
    $stmt->bind_param("i", $categoryID);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode($products);
} else {
    echo json_encode([]);
}
?>
