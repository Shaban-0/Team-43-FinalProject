<?php
session_start();
require 'db_connect.php'; // Make sure this points to your database connection file

// Check if admin is logged in
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header('Location: admin_login.php');
    exit;
}

// Define category to folder mapping
$categoryPaths = [
    1 => 'uploader/Images/men/',
    2 => 'uploader/Images/women/',
    3 => 'uploader/Images/sale/',
    4 => 'uploader/Images/giftsets/',
    5 => 'uploader/Images/unisex/'
];

// Initialize variables
$productID = $_GET['id'] ?? null;
$product = null;
$errors = [];

// Fetch product details for editing
if ($productID) {
    $stmt = $conn->prepare("SELECT * FROM product WHERE productID = ?");
    $stmt->bind_param("i", $productID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $product = $result->fetch_assoc();
    } else {
        die('Product not found.');
    }
}

// Fetch categories for the dropdown
$categories = [];
$categoryQuery = "SELECT * FROM category";
$categoryResult = $conn->query($categoryQuery);
while ($row = $categoryResult->fetch_assoc()) {
    $categories[] = $row;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Simplified validation and sanitization
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $categoryID = $_POST['categoryID'];
    $colour = $_POST['colour'];
    $scent = $_POST['scent'];
    $season = $_POST['season'];
    $imagePath = $product['images']; // Default to current image path

    // Image upload logic
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowedTypes = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/gif' => 'gif'];
        $fileType = $_FILES['image']['type'];

        if (array_key_exists($fileType, $allowedTypes)) {
            $folderPath = $categoryPaths[$categoryID] ?? 'Images/others/'; // Default path if category ID not found

            $fileName = uniqid('img_', true) . '.' . $allowedTypes[$fileType];
            $destination = $folderPath . $fileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                $imagePath = $destination; // Update $imagePath with the new image path
            } else {
                $errors[] = "Failed to upload image.";
            }
        } else {
            $errors[] = "Invalid file type. Only JPG, PNG, and GIF types are accepted.";
        }
    }

    // Update the product in the database
    $updateStmt = $conn->prepare("UPDATE product SET name=?, description=?, price=?, categoryID=?, colour=?, scent=?, season=?, images=? WHERE productID=?");
    $updateStmt->bind_param("ssdissssi", $name, $description, $price, $categoryID, $colour, $scent, $season, $imagePath, $productID);
    if ($updateStmt->execute()) {
        header("Location: manage_products.php");
        exit();
    } else {
        $errors[] = "Error updating record: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Edit Product</h2>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="productID" value="<?php echo htmlspecialchars($product['productID']); ?>">

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control" required><?php echo htmlspecialchars($product['description']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" step="0.01" id="price" name="price" class="form-control" value="<?php echo htmlspecialchars($product['price']); ?>" required>
        </div>

        <div class="form-group">
            <label for="categoryID">Category:</label>
            <select id="categoryID" name="categoryID" class="form-control" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['categoryID']; ?>" <?php if ($product['categoryID'] == $category['categoryID']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($category['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="colour">Colour:</label>
            <input type="text" id="colour" name="colour" class="form-control" value="<?php echo htmlspecialchars($product['colour']); ?>">
        </div>

        <div class="form-group">
            <label for="scent">Scent:</label>
            <input type="text" id="scent" name="scent" class="form-control" value="<?php echo htmlspecialchars($product['scent']); ?>">
        </div>

        <div class="form-group">
            <label for="season">Season:</label>
            <input type="text" id="season" name="season" class="form-control" value="<?php echo htmlspecialchars($product['season']); ?>">
        </div>

        <div class="form-group">
            <label for="image">Product Image:</label>
            <input type="file" id="image" name="image" class="form-control-file">
            <?php if (!empty($product['images'])): ?>
                Current Image: <img src="<?php echo htmlspecialchars($product['images']); ?>" width="100" alt="Product Image">
            <?php endif; ?>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update Product</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>

