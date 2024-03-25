<?php
include 'db_connect.php'; // Adjust the path as needed

// Check if the query parameter is set
if(isset($_GET['query'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['query']);

    $query = "SELECT * FROM product WHERE name LIKE '%$searchTerm%' OR description LIKE '%$searchTerm%'";
    $result = mysqli_query($conn, $query);

    $perfumes = [];
    while($row = mysqli_fetch_assoc($result)) {
        $perfumes[] = $row;
    }

    echo json_encode($perfumes);
} else {
    // If 'query' parameter is not set, return an error message or empty array
    echo json_encode(["error" => "No search query provided"]);
}

mysqli_close($conn);
?>

