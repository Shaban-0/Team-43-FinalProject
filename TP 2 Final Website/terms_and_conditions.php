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
    <link rel="stylesheet" href="HomePageCSS.css"> <!-- Link to the consistent CSS file -->
    <link rel="icon" type="image/x-icon" href="Images/favicon.ico">
    <title>Terms and Conditions - La Paradis</title>
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
    <section class="terms-conditions-section">
        <h1>Terms and Conditions</h1>
        <p>Welcome to La Paradis! These terms and conditions outline the rules and regulations for the use of La Paradis's Website.</p>

        <p>By accessing this website, we assume you accept these terms and conditions. Do not continue to use La Paradis if you do not agree to take all of the terms and conditions stated on this page.</p>

        <h2>Cookies</h2>
        <p>We employ the use of cookies. By accessing La Paradis, you agreed to use cookies in agreement with the La Paradis's Privacy Policy.</p>

        <h2>License</h2>
        <p>Unless otherwise stated, La Paradis and/or its licensors own the intellectual property rights for all material on La Paradis. All intellectual property rights are reserved.</p>

        <h2>Hyperlinking to our Content</h2>
        <p>Organizations may link to our Website without prior written approval:</p>
        <ul>
            <li>Government agencies;</li>
            <li>Search engines;</li>
            <li>News organizations;</li>
            <li>Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses.</li>
        </ul>

       

        <h2>Your Privacy</h2>
        <p>Please read our Privacy Policy.</p>

        <h2>Reservation of Rights</h2>
        <p>We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request.</p>

        <h2>Disclaimer</h2>
        <p>The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.</p>

       

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

    <script src="Home_Page.js"></script> <!-- Link to custom JavaScript file if any -->
    <script src="search.js"></script> <!-- Link to search functionality JavaScript file if any -->
</body>
</html>
