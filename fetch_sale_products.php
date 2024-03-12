<?php
include 'db_connect.php'; // Ensure this path is correct

header('Content-Type: application/json');

$query = "SELECT p.*, c.name AS category_name FROM product p 
          INNER JOIN category c ON p.categoryID = c.categoryID 
          WHERE c.name = 'Sale'";
$result = mysqli_query($conn, $query);

$products = array();
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
    echo json_encode(['status' => 'success', 'products' => $products]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No products found']);
}

mysqli_close($conn);
?>
