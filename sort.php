<?php
include 'db_connect.php';
header('Content-Type: application/json');

//low to high (price)
if (isset($_POST['submitted'])) {
    $category = isset($_POST['Cname'])?$_POST['Cname']:false;
    if (!empty($category)){
        $sql = "SELECT p.*, c.name  AS category_name 
                FROM product p 
                INNER JOIN category c ON p.categoryID = c.categoryID
                WHERE c.name LIKE ?
                ORDER BY p.price ASC";
                
        $Cname = "%$category%";
        mysqli_stmt_bind_param($stmt, "s", $Cname);
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
        echo json_encode(['status' => 'error', 'message' => 'Empty category']);
    }

} else{
    echo json_encode(['status' => 'error', 'message' => 'Form not submitted']);
} 

//high to low 
if (isset($_POST['submitted'])) {
    $category = isset($_POST['Cname'])?$_POST['Cname']:false;
    if (!empty($category)){
        $sql = "SELECT p.*, c.name  AS category_name 
                FROM product p 
                INNER JOIN category c ON p.categoryID = c.categoryID
                WHERE c.name LIKE ?;
                ORDER BY p.price DESC";
        $Cname = "%$category%";
        mysqli_stmt_bind_param($stmt, "sssss", $Cname);
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
        echo json_encode(['status' => 'error', 'message' => 'Empty category']);
    }

} else{
    echo json_encode(['status' => 'error', 'message' => 'Form not submitted']);
} 

?>