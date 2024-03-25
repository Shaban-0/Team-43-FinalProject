<?php
session_start();
include 'db_connect.php';

// Check if user is logged in, redirect if not
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: HomePage.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en-UK">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="HomePageCSS.css"> <!-- Link to custom CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"> <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"> <!-- Owl Carousel theme CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Font Awesome CSS -->
    <title>My Account - La Paradis</title>
    <link rel="icon" type="image/x-icon" href ="Images/favicon.ico">
    <script>
        // Function to add item to cart
        function addToCart(productId, quantity) {
            document.getElementById('productID').value = productId;
            document.getElementById('quantity').value = quantity;
            document.getElementById('hiddenForm').submit();
        }
    </script>
</head>
<body>
<header>
    <!-- Header section containing the logo, basket button, and login/logout buttons -->
    <div class="flex_logo_container" id="logo_div">
        <img class="logo_transition" id="logo" src="Images/logo.png"> <!-- Logo image -->
        <a href="add_to_cart.php" class="basket_button"><img class="header_icon" src="Images/basket.png"></a> <!-- Basket button -->

        
        <!-- Check if user is logged in and display either logout or login button -->
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <!-- Logout button if user is logged in -->
            <a href="logout.php" class="logout_button"><img src="Images/logout_icon.png" class="header_icon" alt="Logout"></a>
        <?php else: ?>
            <!-- Login button if user is not logged in -->
            <a href="#" class="login_button" onclick="Open_Login_Modal()"><img class="header_icon" src="Images/login.png"></a>
        <?php endif; ?>
    </div>
</header>

<nav>
		<!-- Navigation section with links and search bar -->
		<div class="nav_container"  id="nav_div">
		<a href="men.php" class="Link_Button" id="nav_button1"><button class="nav_btn"><b>Men</b></button></a>
<a href="women.php" class="Link_Button" id="nav_button2"><button class="nav_btn"><b>Women</b></button></a>
<a href="unisex.php" class="Link_Button" id="nav_button3"><button class="nav_btn"><b>Unisex</b></button></a>
<a href="sale.php" class="Link_Button" id="nav_button4"><button class="nav_btn"><b>Sale</b></button></a>
<a href="giftsets.php" class="Link_Button" id="nav_button5"><button class="nav_btn"><b>Gift Sets</b></button></a>
		</div>
		<div class="flex_search_bar_container">
        <form id="searchForm" action="search.php" method="post" >
    		<div class="search_bar">
				<input type="text" name="query" placeholder="Search..."> <!-- Search bar -->
				<button type="submit" class="search_button"><b>Search</b></button> <!-- Search button -->
                <input type="hidden" name="submitted" value="true"/>
            </div>
        </form>
		</div>
	</nav>

    <!-- Profile section to see a user's orders, login & security settings, stored addresses and payment methods -->
    <div class="account-page">
        <h2>Your Profile</h2>
        <div class="account-navigation">
            <button onclick="window.location.href='your_orders.php';">Your Orders</button>
            <button onclick="window.location.href='login_security.php';">Login & Security</button>
            <button onclick="window.location.href='your_addresses.php';">Your Addresses</button>
            <button onclick="window.location.href='your_payments.php';">Your Payments</button>
        </div>

    <!-- Hidden form for adding items to cart -->
    <form id="hiddenForm" action="add_to_cart.php" method="post" style="display: none;">
        <input type="hidden" name="productID" id="productID">
        <input type="hidden" name="quantity" id="quantity" value="1">
    </form>


    <footer>
		<!-- Footer section with help, about us, legal, and review content -->
		<div class="Home_page_footer">
			<!-- Footer lists with links -->
			<div class="Footer_lists">
				<ul><h2>Help</h2>
				<a href="#"class="Footer_Links"><li>Delivery Information</li></a>
				<a href=""class="Footer_Links"><li>Customer Service</li></a>
				<a href=""class="Footer_Links"><li>Return Policy</li></a>
				<a href=""class="Footer_Links"><li>Contact Us</li></a>
				<a href=""class="Footer_Links"><li>FAQs</li></a>
				</ul>

				<ul><h2>About Us</h2>
				<a href="#"class="Footer_Links"><li>About Us</li></a>
				<a href=""class="Footer_Links"><li>Careers</li></a>
				<a href=""class="Footer_Links"><li>Affiliates</li></a>
				<a href=""class="Footer_Links"><li>Student Discount</li></a>
				</ul>
		

				<ul><h2>Legal</h2>
				<a href="#"class="Footer_Links"><li>Terms & Conditions</li></a>
				<a href=""class="Footer_Links"><li>Privacy Policy</li></a>
				<a href=""class="Footer_Links"><li>Cookie Policy</li></a>

				</ul>
			</div>
			<!-- Review container -->
			<div class="Review_container">
				<img class="Review_img" src="Images\reviews.png">
				
			</div>
			<!-- Social media logos -->
			<div class="Social_media_logos">
				<a href="#" class="fa fa-instagram"></a>
				<a href="#" class="fa fa-facebook"></a>
				<a href="#" class="fa fa-twitter"></a>
			</div>

			
		</div>
	</footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="account_management.js"></script>
    <script>
    $(document).ready(function() {
        // AJAX call to fetch products and populate the carousel
        $.ajax({
            url: 'fetch_sale_products.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    populateCarousel(response.products);
                } else {
                    console.error("Error fetching products: " + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("An error occurred: " + error);
            }
        });
    
    //event listner for search form submission
    $(document).ready(function(){
        $("#searchForm").submit(function(event) {
            event.preventDefault();
            var query = $(this).find("input[name='query']").val();
            //AJAX request - submit search query
            $.ajax({
                url: 'search.php',
                type: 'POST',
                data: { submitted: true, query: query},
                success:function(response) {
                    if(response.status === 'success'){
                        $('#menProductsCarousel').empty();
                        console.log(response.products);
                        populateCarousel(response.products);
                    } else{
                        console.error('Error: ' + response.message);
                    }   
                },
                error: function(xhr, status, error) {
                    console.error("An error occured: " +error);
                }
            });
        });
    });

       
    // Function to populate the carousel with items
function populateCarousel(products) {
    var carousel = $("#menProductsCarousel");
    products.forEach(function(product) {
        var item = $('<div class="item">');
        var card = $('<div class="card">');
        
        // Front side of the card with image and name
        var cardFront = $('<div class="card-side card-front d-flex">')
            .append('<div class="card-image-container"><img class="card-img" src="uploader/' + product.images + '" alt="' + product.name + '"></div>')
            .append('<div class="card-content"><h2 class="card-title">' + product.name + '</h2></div>');

        // Back side of the card with text content (no image)
        var cardBack = $('<div class="card-side card-back">')
            .append('<div class="card-content"><h2 class="card-title">' + product.name + '</h2><p class="card-description">' + product.description + '</p><p class="card-price">£' + product.price + '</p></div>');

        // Append front and back to the card container
        card.append(cardFront).append(cardBack);
        item.append(card);
        carousel.append(item);

        // Add a data-id attribute to the button for identifying the product
        var addToCartButton = $('<button class="add-to-cart-button" onclick="addToCart(' + product.productID + ', 1)">Add to Cart</button>');
        cardBack.find('.card-content').append(addToCartButton);
    });

        // Initialize Owl Carousel
        carousel.owlCarousel({
            loop: true,
            margin: 10,
            responsive: {
                0: { items: 1 },
                600: { items: 3 },
                1000: { items: 5 }
            }
        });
    }

    // Event listener for Add to Cart buttons
    $(document).on('click', '.add-to-cart-button', function() {
            var productId = $(this).data('id');
            addToCart(productId, 1); // Add 1 quantity of the product to the cart
        });

   

        //Function to handle adding items to the cart
        function addToCart(productId, quantity) {
            $.ajax({
                url: 'add_to_cart.php',
                type: 'POST',
                data: { productID: productId, quantity: quantity },
                success: function(response) {
                    try {
                        var data = JSON.parse(response);
                        if (data.status === 'success') {
                            // Redirect to the cart page or show a success message
                            window.location.href = 'cart.php';
                        } else {
                            // Display an error message
                            alert(data.message);
                        }
                    } catch (e) {
                        console.error("Error parsing JSON response: " + e.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("An error occurred: " + error);
                }
            });
        }
    });
    </script>
</body>
</html>