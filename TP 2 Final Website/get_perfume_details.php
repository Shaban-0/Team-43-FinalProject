<?php
include 'db_connect.php'; // Adjust the path as needed

// Check if productID is set in the GET request
if(isset($_GET['productID'])) {
    $productID = mysqli_real_escape_string($conn, $_GET['productID']);

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM product WHERE productID = ?");
    $stmt->bind_param("i", $productID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($perfume = $result->fetch_assoc()) {
        echo json_encode([$perfume]); // Encapsulate the result in an array
    } else {
        echo json_encode([]); // Return an empty array if no results
    }
} else {
    // Return an error message or empty array if productID is not provided
    echo json_encode(["error" => "Product ID not provided"]);
}

mysqli_close($conn);
?>
