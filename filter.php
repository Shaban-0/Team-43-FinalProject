<?php
include 'db_connect.php';
header('Content-Type: application/json');

if (isset($_POST['submitted'])) {
        
    $minPrice = isset($_POST['min_price'])?$_POST['min_price']:false;
    $maxPrice = isset($_POST['max_price'])?$_POST['max_price']:false;
    $colour = isset($_POST['colour'])?$_POST['colour']:false;
    $scent = isset($_POST['scent'])?$_POST['scent']:false;
    $season = isset($_POST['season'])?$_POST['season']:false;

    $sql = "SELECT p.*, c.name  AS category_name 
            FROM product p 
            INNER JOIN category c ON p.categoryID = c.categoryID
            WHERE p.price BETWEEN ? AND ? OR
            p.colour LIKE ? OR
            p.season LIKE ? OR
            p.scent LIKE ?";
    
    $mPrice = "%$minPrice%";
    $mxPrice = "%$maxPrice%";
    $c = "%$colour%";
    $st = "%$scent%";
    $s = "%$season%";

    mysqli_stmt_bind_param($stmt, "sssss", $mPrice, $mxPrice, $c, $st, $s);
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $products = array();
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        echo json_encode(['status' => 'success', 'products' => $products]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error...']);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);       

} else{
    echo json_encode(['status' => 'error', 'message' => 'Form not submitted']);
} 
?>