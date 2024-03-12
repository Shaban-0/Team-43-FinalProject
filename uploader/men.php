<?php
// men.php
session_start();
include 'db_connect.php'; // Ensure that this path is correct

// Check if user is logged in, redirect if not
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: HomePage.php');
    exit;
}

// Fetch products for men
$query = "SELECT p.*, c.name AS category_name FROM product p 
          INNER JOIN category c ON p.categoryID = c.categoryID 
          WHERE c.name = 'Men'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en-UK">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="HomePageCSS.css"> <!-- Link to custom CSS file -->
    <title>Men's Fragrances - La Paradis</title>
</head>
<body>
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
			<a href="" class="Link_Button" target="_blank" id="nav_button1"><button class="nav_btn"><b>Men</b></button></a>
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
    <section>
    <div class="owl-carousel owl-theme">
        <!-- Check if products exist and loop through each product -->
        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="item">
                    <div class="card_flipped" onmouseover="pauseCarousel()" onmouseout="playCarousel()">
                        <div class="card_inside">
                            <div class="card_flipped_front">
                                <!-- Adjust the image path here -->
                                <img src="uploader/<?php echo htmlspecialchars($row['images']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                            </div>
                            <div class="card_flipped_back">
                                <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                                <p><?php echo htmlspecialchars($row['description']); ?></p>
                                <p><b>£<?php echo htmlspecialchars($row['price']); ?></b></p>
                                <button class="card_flipped_back_button">Learn more</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No products found for men.</p>
        <?php endif; ?>
    </div>
</section>


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

    <script src="Home_Page.js"></script> <!-- Link to custom JavaScript file -->
</body>
</html>
<?php
// Close the database connection
mysqli_close($conn);
?>
