<?php
session_start();
require 'db_connect.php'; // Adjust this path as needed

// Check if the user is logged in and has admin privileges
// Adjust this according to your session management and authorization logic
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header('Location: admin_login.php');
    exit;
}

// Define path for uploaded images
// Note: Ensure this directory exists and is writable
$targetDirectory = "uploader/Images/"; // Adjust according to your directory structure

// Process the form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $categoryID = $_POST['categoryID'];
    $colour = $_POST['colour'];
    $scent = $_POST['scent'];
    $season = $_POST['season'];
    $imagePath = '';

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDirectory . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array(strtolower($fileType), $allowTypes)) {
            // Upload file to the server
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                $imagePath = $targetFilePath;
            } else {
                $error_msg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $error_msg = "Sorry, only JPG, JPEG, PNG, & GIF files are allowed.";
        }
    }

    // Insert product into the database
    $sql = "INSERT INTO product (categoryID, name, description, price, colour, scent, season, images) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "isssssss", $categoryID, $name, $description, $price, $colour, $scent, $season, $imagePath);
        
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to manage products page or display success message
            header("Location: manage_products.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
}
?>
