<?php
session_start();
include 'db_connect.php';

$sessionId = $_SESSION['sessionID'] ?? session_id();

$query = "SELECT p.name, p.price, b.quantity FROM basket b JOIN product p ON b.productID = p.productID WHERE b.sessionID = ?";
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
    <!-- Header section containing the logo, basket button, and login/logout buttons -->
    <div class="flex_logo_container" id="logo_div">
        <img class="logo_transition" id="logo" src="Images/logo.png"> <!-- Logo image -->
        <a href="#" class="basket_button"><img class="header_icon" src="Images/basket.png"></a> <!-- Basket button -->
        
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
        <div class="basket-items">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<p>" . htmlspecialchars($row['name']) . " - Quantity: " . intval($row['quantity']) . " - Price: $" . number_format($row['price'], 2) . "</p>";
                }
                echo "<a href='place_order.php'><button class='btn'>Place Order</button></a>";
            } else {
                echo "<p>Your basket is empty.</p>";
            }
            ?>
        </div>
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
    <script src="Home_Page.js"></script> 
</body>
</html>

