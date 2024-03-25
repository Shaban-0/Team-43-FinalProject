<?php
// Connect to your database
include 'db_connect.php';

// Fetch categories for the dropdown
$categoryResult = mysqli_query($conn, "SELECT categoryID, name FROM category");
$categories = mysqli_fetch_all($categoryResult, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add to Cart</title>
    <script>
        function filterProducts() {
            var selectedCategory = document.getElementById('category').value;
            var productSelect = document.getElementById('product');
            productSelect.innerHTML = ''; // Clear current options

            if (selectedCategory) {
                // Fetch products for the selected category from the server
                fetch('get_products.php?categoryID=' + selectedCategory)
                    .then(response => response.json())
                    .then(products => {
                        products.forEach(product => {
                            var option = document.createElement('option');
                            option.value = product.productID;
                            option.textContent = product.name;
                            productSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching products:', error);
                    });
            }
        }
    </script>
</head>
<body>
    <h1>Add to Cart</h1>

    <form action="add_to_cart.php" method="post">
        <label for="category">Category:</label>
        <select name="categoryID" id="category" onchange="filterProducts()">
            <option value="">Select a Category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['categoryID']; ?>">
                    <?php echo $category['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label for="product">Product:</label>
        <select name="productID" id="product">
            <!-- Products will be loaded here by JavaScript -->
        </select>
        <br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1" max="10" value="1">
        <br><br>

        <input type="submit" value="Add to Cart">
    </form>
</body>
</html>
