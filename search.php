<?php
include 'db_connect.php';
header('Content-Type: application/json');

 //search bar
 //get search query from search form submission
 if (isset($_POST['submitted'])) {
    $searchQuery = isset($_POST['query'])?$_POST['query']:false;
    if (!empty($searchQuery)){
        $sql = "SELECT p.*, c.name  AS category_name 
            FROM product p 
            INNER JOIN category c ON p.categoryID = c.categoryID WHERE
            p.name LIKE ? OR
            c.name LIKE ? OR
            p.colour LIKE ? OR
            p.season LIKE ? OR
            p.scent LIKE ?";
    $stmt = mysqli_prepare($conn, $sql);
    $search = "%$searchQuery%";
    mysqli_stmt_bind_param($stmt, "sssss", $search, $search, $search, $search, $search);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $products = array();
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        echo json_encode(['status' => 'success', 'products' => $products]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No products found']);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    } else{
        echo json_encode(['status' => 'error', 'message' => 'Empty search query']);
    }
   
 } else{
    echo json_encode(['status' => 'error', 'message' => 'Form not submitted']);
}
?>