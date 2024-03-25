<?php
include 'db_connect.php'; // Ensure this path is correct

header('Content-Type: application/json');

$sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'name_asc';
$filterKeyword = isset($_GET['filter']) ? $_GET['filter'] : '';


$query = "SELECT p.*, c.name AS category_name FROM product p 
          INNER JOIN category c ON p.categoryID = c.categoryID 
          WHERE c.name = 'Sale'";
          
if (!empty($filterKeyword)) {
    $query .= " AND p.name LIKE '%" . mysqli_real_escape_string($conn, $filterKeyword) . "%'";
}

// Adding sorting options
switch ($sortOption) {
    case 'name_asc':
        $query .= " ORDER BY p.name ASC";
        break;
    case 'name_desc':
        $query .= " ORDER BY p.name DESC";
        break;
    case 'price_asc':
        $query .= " ORDER BY p.price ASC";
        break;
    case 'price_desc':
        $query .= " ORDER BY p.price DESC";
        break;
}

$result = mysqli_query($conn, $query);

$products = [];
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
