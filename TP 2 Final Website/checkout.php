<?php
session_start();
include 'db_connect.php';

$sessionId = $_SESSION['sessionID'] ?? session_id();

$query = "SELECT p.name, p.price, b.quantity, p.images, b.basketID, b.bottleSize, b.engraving FROM basket b JOIN product p ON b.productID = p.productID WHERE b.sessionID = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    echo "Error preparing statement: " . $conn->error;
    exit;
}

$stmt->bind_param("s", $sessionId);
$stmt->execute();
$result = $stmt->get_result();
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
	<title>La Paradis</title> <!-- Page title -->
	<link rel="icon" type="image/x-icon" href ="Images\favicon.ico">
</head>
<body>
<header>
    <!-- Header section containing the logo, basket button, and login/logout buttons -->
    <div class="flex_logo_container" id="logo_div">
        <img class="logo_transition" id="logo" src="Images/logo.png"> <!-- Logo image -->
        <a href="checkout.php"  class="basket_button"><img class="header_icon" src="Images/basket.png"></a> <!-- Basket button -->
        
        <!-- Check if user is logged in and display either logout or login button -->
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <!-- Logout button if user is logged in -->
            <a href="logout.php" class="logout_button"><img src="Images/logout_icon.png" class="header_icon" alt="Logout"></a>
            <a href="user_profile.php" class="profile_button"><img src="Images/user-profile.jpg" class="header_icon" alt="User Profile"></a> <!-- User profile button -->
            <?php else: ?>
            <!-- Login button if user is not logged in -->
            <a href="#" class="login_button" onclick="Open_Login_Modal()"><img class="header_icon" src="Images/login.png"></a>
        <?php endif; ?>
    </div>
</header>

	<nav>
		<!-- Navigation section with links and search bar -->
		<div class="nav_container"  id="nav_div">
			<!-- Navigation buttons -->
			<a href="men.php" class="Link_Button" id="nav_button1"><button class="nav_btn"><b>Men</b></button></a>
			<a href="" class="Link_Button" target="_blank" id="nav_button2"><button class="nav_btn" ><b>Women</b></button></a>
			<a href="" class="Link_Button" target="_blank" id="nav_button3"><button class="nav_btn" ><b>Unisex</b></button></a>
			<a href="" class="Link_Button" target="_blank" id="nav_button4"><button class="nav_btn" ><b>Sale</b></button></a>
			<a href="" class="Link_Button" target="_blank" id="nav_button5"><button class="nav_btn" ><b>Gift Sets</b></button></a>
		</div>
		<div class="flex_search_bar_container">
    		<div class="search_bar">
				<input type="text" placeholder="Search..."> <!-- Search bar -->
				<button class="search_button"><b>Search</b></button> <!-- Search button -->
    		</div>
		</div>
	</nav>

	<div class="content-container">
        <h1>Checkout</h1>
        <form action="update_cart.php" method="post">
            <div class="basket-items">
                <?php
                $total = 0;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $subtotal = $row['quantity'] * $row['price'];
                        $total += $subtotal;
                        echo "<div class='basket-item'>";
                        echo "<img src='" . htmlspecialchars($row['images']) . "' alt='Product Image' style='width:100px; height:auto;'>";
                        echo "<p>" . htmlspecialchars($row['name']) . "</p>";
                        echo "<p>Quantity: <input type='number' name='quantity[" . $row['basketID'] . "]' value='" . intval($row['quantity']) . "' min='1'></p>";
                        echo "<label for='bottleSize[" . $row['basketID'] . "]'>Bottle Size:</label>";
                        echo "<select name='bottleSize[" . $row['basketID'] . "]'>";
                        echo "<option value='50ml'" . ($row['bottleSize'] == '50ml' ? ' selected' : '') . ">50ml</option>";
                        echo "<option value='100ml'" . ($row['bottleSize'] == '100ml' ? ' selected' : '') . ">100ml</option>";
                        echo "</select>";
                        echo "<label for='engraving[" . $row['basketID'] . "]'>Engraving:</label>";
                        echo "<input type='text' name='engraving[" . $row['basketID'] . "]' value='" . htmlspecialchars($row['engraving']) . "'>";
                    }
                    echo "<p><strong>Total: £" . number_format($total, 2) . "</strong></p>";
                } else {
                    echo "<p>Your basket is empty.</p>";
                }
                ?>
                </div>
        <button type='submit' class='btn'>Update Cart</button>
    </form>
            </div>
        </form>
        <form action="clear_cart.php" method="post">
            <button type='submit' class='btn'>Clear Cart</button>
        </form>
        <?php if ($total > 0) : ?>
            <form action='place_order.php' method='post'>
            </form>
        <?php endif; ?>
		<form action="process_payment.php" method="post">
    <h2>Payment Information</h2>
    <div class="payment-icons">
        <!-- Icons for Visa, MasterCard, etc. -->
        <span class="fa fa-cc-visa"></span>
        <span class="fa fa-cc-mastercard"></span>
    </div>
    <div class="form-group">
        <label for="cardNumber">Card Number</label>
        <input type="text" id="cardNumber" name="cardNumber" required>
    </div>
    <div class="form-group">
        <label for="cardExpiry">Expiry Date (MM/YY)</label>
        <input type="text" id="cardExpiry" name="cardExpiry" required>
    </div>
    <div class="form-group">
        <label for="cardCVV">CVV</label>
        <input type="text" id="cardCVV" name="cardCVV" required>
    </div>
    <h2>Address Information</h2>
    <div class="form-group">
        <label for="addressLine1">Address Line 1</label>
        <input type="text" id="addressLine1" name="addressLine1" required>
    </div>
    <div class="form-group">
        <label for="addressLine2">Address Line 2</label>
        <input type="text" id="addressLine2" name="addressLine2">
    </div>
    <div class="form-group">
        <label for="postcode">Postcode</label>
        <input type="text" id="postcode" name="postcode" required>
    </div>
    <div class="form-group">
        <label for="country">Country</label>
        <input type="text" id="country" name="country" required>
    </div>
    <button type="submit" class="btn">Submit Payment</button>
</form>
    </div>


    <footer>
		<!-- Footer section with help, about us, legal, and review content -->
		<div class="Home_page_footer">
			<!-- Footer lists with links -->
			<div class="Footer_lists">
				<ul><h2>Help</h2>
				<a href="#"class="Footer_Links"><li>Delivery Information</li></a>
				<a href=""class="Footer_Links"><li>Customer Service</li></a>
				<a href=""class="Footer_Links"><li>Return Policy</li></a>
				<a href="contactus.php" class="Footer_Links"><li>Contact Us</li></a>
				<a href="faqs.php" class="Footer_Links"><li>La Paradis - FAQs</li></a>
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
    <script src="Home_Page.js"></script> 
</body>
</html>

