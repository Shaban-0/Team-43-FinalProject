<?php

session_start();
require 'db_connect.php'; // Database connection
// Check if admin is logged in
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header('Location: admin_login.php');
    exit;
}

// Adding product logic (simplified version)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Simplified validation and assignment of POST variables
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? 0;
    $categoryID = $_POST['categoryID'] ?? 1; // Default to first category
    $colour = $_POST['colour'] ?? '';
    $scent = $_POST['scent'] ?? '';
    $season = $_POST['season'] ?? '';


    $sql = "INSERT INTO product (name, description, price, categoryID, colour, scent, season, images) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssdiss", $name, $description, $price, $categoryID, $colour, $scent, $season, $imagePath);
        mysqli_stmt_execute($stmt);
        header("location: manage_products.php");
        exit();
    }
    // Handle error if insert fails
}

// Product Deletion Logic (Simplified)
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql = "DELETE FROM product WHERE productID = ?";
    if($stmt = mysqli_prepare($conn, $sql)){ // Use $conn instead of $link
        mysqli_stmt_bind_param($stmt, "i", $id);
        if(mysqli_stmt_execute($stmt)){
            header("location: manage_products.php");
            exit();
        }
    }
}

// Fetch categories for select dropdown
$categories = [];
$categorySql = "SELECT * FROM category";
$categoryResult = mysqli_query($conn, $categorySql);
while ($row = mysqli_fetch_assoc($categoryResult)) {
    $categories[] = $row;
}



// Fetch Products
$products = [];
$sql = "SELECT * FROM product";
if($result = mysqli_query($conn, $sql)){ // Use $conn instead of $link
    while($row = mysqli_fetch_assoc($result)){
        $products[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Manage Products</title>
</head>
<body>
<div class="container mt-4">
    <h2>Manage Products</h2>
    <a href="#addProductModal" class="btn btn-primary" data-toggle="modal">Add New Product</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['productID']) ?></td>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= htmlspecialchars($product['description']) ?></td>
                    <td><?= htmlspecialchars($product['price']) ?></td>
                    <td>
                        <a href="edit_product.php?id=<?= $product['productID'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="?delete=<?= $product['productID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="add_product.php" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <!-- Name field -->
          <div class="form-group">
            <label for="productName">Name:</label>
            <input type="text" class="form-control" id="productName" name="name" required>
          </div>
          <!-- Description field -->
          <div class="form-group">
            <label for="productDescription">Description:</label>
            <textarea class="form-control" id="productDescription" name="description" required></textarea>
          </div>
          <!-- Price field -->
          <div class="form-group">
            <label for="productPrice">Price:</label>
            <input type="number" class="form-control" id="productPrice" name="price" step="0.01" required>
          </div>
          <!-- Category field -->
<div class="form-group">
  <label for="productCategory">Category:</label>
  <select class="form-control" id="productCategory" name="categoryID" required>
    <?php foreach ($categories as $category): ?>
      <option value="<?= $category['categoryID']; ?>"><?= htmlspecialchars($category['name']); ?></option>
    <?php endforeach; ?>
  </select>
</div>

          <!-- Colour field -->
          <div class="form-group">
            <label for="productColour">Colour:</label>
            <input type="text" class="form-control" id="productColour" name="colour">
          </div>
          <!-- Scent field -->
          <div class="form-group">
            <label for="productScent">Scent:</label>
            <input type="text" class="form-control" id="productScent" name="scent">
          </div>
          <!-- Season field -->
          <div class="form-group">
            <label for="productSeason">Season:</label>
            <input type="text" class="form-control" id="productSeason" name="season">
          </div>
          <!-- Image field -->
          <div class="form-group">
            <label for="productImage">Image:</label>
            <input type="file" class="form-control-file" id="productImage" name="image">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>



