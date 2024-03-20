<?php

//Insert a new review the user wants to create
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $rating = $_POST['star_rating'];
    $content = $_POST['comments'];


    $sql = "INSERT INTO reviews (title, star_rating, comments) VALUES ('$title', '$rating', '$content')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Review added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

//Fetch and display reviews from the database
$sql = "SELECT * FROM reviews";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output reviews
    while($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h3>" . $row["title"] . "</h3>";
        echo "<p>Rating: " . $row["star-rating"] . "/5</p>";
        echo "<p>" . $row["comments"] . "</p>";
        echo "</div>";
    }
} else {
    echo "No reviews yet.";
}



?>

