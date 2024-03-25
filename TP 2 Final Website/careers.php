<?php
session_start();
include 'db_connect.php';

// Check if there's a login success message and create a hidden input with value 'success'
if (isset($_SESSION['success_message'])) {
    echo '<input type="hidden" id="loginStatus" value="success">';
    unset($_SESSION['success_message']); // Clear the message after use
} else {
    echo '<input type="hidden" id="loginStatus" value="">';
}
?>

<!DOCTYPE html>
<html lang="en-UK">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="HomePageCSS.css"> <!-- Use the same CSS file for consistent styling -->
    <link rel="icon" type="image/x-icon" href="Images/favicon.ico">
    <title>Careers - La Paradis</title>
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
		<a href="men.php" class="Link_Button" id="nav_button1"><button class="nav_btn"><b>Men</b></button></a>
<a href="women.php" class="Link_Button" id="nav_button2"><button class="nav_btn"><b>Women</b></button></a>
<a href="unisex.php" class="Link_Button" id="nav_button3"><button class="nav_btn"><b>Unisex</b></button></a>
<a href="sale.php" class="Link_Button" id="nav_button4"><button class="nav_btn"><b>Sale</b></button></a>
<a href="giftsets.php" class="Link_Button" id="nav_button5"><button class="nav_btn"><b>Gift Sets</b></button></a>
		</div>
 </nav>

    <!-- Navigation Section -->
    <!-- Include your standard website navigation here -->

    <section class="careers-section">
        <h1>Join Our Team</h1>
        <p>At La Paradis, we're always looking for talented individuals who share our passion for fragrance, beauty, and excellence. Explore the opportunities below to become part of our dynamic team.</p>

        <div class="career-opportunities">
            <h2>Current Openings</h2>
            <ul class="career-list">
                <li><strong>Fragrance Specialist</strong> - London, GB</li>
                <p>As a Fragrance Specialist, you will guide customers through our collection, helping them discover the scents that best express their personality.</p>

                <li><strong>Marketing Coordinator</strong> - Birmingham, GB</li>
                <p>Join our marketing team to develop and implement strategies that convey the essence of La Paradis to the world.</p>

                <li><strong>Product Designer</strong> - Cambridge GB</li>
                <p>We're seeking a creative Product Designer to help us craft the next generation of fragrance bottles and packaging.</p>
            </ul>
            <p>For more information on how to apply, please contact <a href="mailto:laparadis43@gmail.com">laparadis43@gmail.com</a>.</p>
        </div>
    </section>

    <footer>
		<!-- Footer section with help, about us, legal, and review content -->
		<div class="Home_page_footer">
			<!-- Footer lists with links -->
			<div class="Footer_lists">
				<ul><h2>Help</h2>
				<a href="delivery_information.php"class="Footer_Links"><li>Delivery Information</li></a>
				<a href="customer_service.php"class="Footer_Links"><li>Customer Service</li></a>
				<a href=""class="Footer_Links"><li>Return Policy</li></a>
				<a href="contactus.php" class="Footer_Links"><li>Contact Us</li></a>
				<a href="faqs.php" class="Footer_Links"><li>La Paradis - FAQs</li></a>
				</ul>

				<ul><h2>About Us</h2>
				<a href="aboutus.php"class="Footer_Links"><li>About Us</li></a>
				<a href="careers.php"class="Footer_Links"><li>Careers</li></a>
				<a href="affiliates.php"class="Footer_Links"><li>Affiliates</li></a>
				<a href="student_discount.php"class="Footer_Links"><li>Student Discount</li></a>
				</ul>
		

				<ul><h2>Legal</h2>
				<a href="terms_and_conditions.php"class="Footer_Links"><li>Terms & Conditions</li></a>
				<a href="privacy_policy.php"class="Footer_Links"><li>Privacy Policy</li></a>
				<a href="cookie_policy.php"class="Footer_Links"><li>Cookie Policy</li></a>

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

    <script src="Home_Page.js"></script> <!-- Optional: Include if you have a custom JavaScript file -->
    <script src="search.js"></script> <!-- Optional: Include if you have a custom JavaScript file for search functionality -->
</body>
</html>
