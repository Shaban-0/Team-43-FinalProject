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
    <link rel="stylesheet" href="HomePageCSS.css"> <!-- Consistent styling with other pages -->
    <link rel="icon" type="image/x-icon" href="Images/favicon.ico">
    <title>Cookie Policy - La Paradis</title>
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

    <section class="cookie-policy-section">
        <h1>Cookie Policy for La Paradis</h1>
        <p>This is the Cookie Policy for La Paradis.</p>

        <h2>What Are Cookies</h2>
        <p>As is common practice with almost all professional websites, this site uses cookies, which are tiny files that are downloaded to your computer, to improve your experience. This page describes what information they gather, how we use it and why we sometimes need to store these cookies. We will also share how you can prevent these cookies from being stored however this may downgrade or 'break' certain elements of the site's functionality.</p>

        <h2>How We Use Cookies</h2>
        <p>We use cookies for a variety of reasons detailed below. Unfortunately, in most cases, there are no industry standard options for disabling cookies without completely disabling the functionality and features they add to this site. It is recommended that you leave on all cookies if you are not sure whether you need them or not in case they are used to provide a service that you use.</p>

        <h2>Disabling Cookies</h2>
        <p>You can prevent the setting of cookies by adjusting the settings on your browser (see your browser Help for how to do this). Be aware that disabling cookies will affect the functionality of this and many other websites that you visit. Disabling cookies will usually result in also disabling certain functionality and features of the this site. Therefore, it is recommended that you do not disable cookies.</p>

        <h2>The Cookies We Set</h2>
        <ul>
            <li>Account related cookies</li>
            <li>Login related cookies</li>
            <li>Orders processing related cookies</li>
            <li>Site preferences cookies</li>
        </ul>

        <h2>More Information</h2>
        <p>Hopefully, that has clarified things for you and as was previously mentioned if there is something that you aren't sure whether you need or not it's usually safer to leave cookies enabled in case it does interact with one of the features you use on our site.</p>
        <p>For more general information on cookies, please read "What Are Cookies". For more information on our privacy practices, please visit our website.</p>
        

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

