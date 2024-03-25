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
    <link rel="stylesheet" href="HomePageCSS.css"> <!-- Link to custom CSS file -->
    <link rel="icon" type="image/x-icon" href="Images/favicon.ico">
    <title>Delivery Information - La Paradis</title>
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
    <section class="delivery-information-section">
        <h1>Delivery Information</h1>
        <p>At La Paradis, we understand that getting your items quickly is important to you, so we make every effort to process your order swiftly. Below you can find detailed information about our delivery processes.</p>

        <h2>Shipping Costs</h2>
        <p>Shipping costs vary depending on the delivery location and the size of your order. We offer free standard shipping on orders over a certain amount.</p>

        <h2>Delivery Times</h2>
        <p>Standard delivery times within the UK are 3-5 working days. International orders can take between 7-14 working days, depending on your location. Please note that these times are estimates and can vary due to external factors.</p>

        <h2>Express Shipping</h2>
        <p>Need your order quickly? We offer an express shipping option for most destinations. Express shipping typically reduces the delivery time to 1-2 working days within the UK and 3-5 days internationally.</p>

        <h2>Tracking Your Order</h2>
        <p>Once your order has been dispatched, you will receive an email with tracking information. You can use this information to track the progress of your delivery on the courier's website.</p>

        <h2>International Orders</h2>
        <p>We ship worldwide! Please be aware that international orders may be subject to additional tariffs, duties, or customs fees. These fees are the responsibility of the customer and are not included in our shipping charges.</p>

        <h2>Missed Deliveries</h2>
        <p>If you are not at home to receive your delivery, the courier will leave a card with instructions on how to rearrange delivery or collect your order from a local depot.</p>

        <h2>Questions?</h2>
        <p>If you have any questions about your order or our delivery process, please don't hesitate to contact us.</p>
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
