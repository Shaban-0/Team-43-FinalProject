<?php
session_start();
include 'db_connect.php';

$target_dir = "Images/men/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Initialize $uploadOk to 1 (true)
$uploadOk = 1;

// Check if image file is an actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        // Create the target directory if it doesn't exist
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])). " has been uploaded.";

            // Update the database with the new image path
            // NOTE: You need to know which product to update, so your form or application
            // should have a way to specify the productID or product name

            $productName = "The product name"; // Replace with actual product name or ID from your form
            $updateQuery = "UPDATE product SET images = '$target_file' WHERE name = '$productName' AND categoryID = (SELECT categoryID FROM category WHERE name = 'Men')";

            if(mysqli_query($conn, $updateQuery)) {
                echo "Database updated with new image path.";
            } else {
                echo "Error updating database: " . mysqli_error($conn);
            }

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

mysqli_close($conn);
?>
