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
    <title>Return Policy - La Paradis</title>
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

    <section class="return-policy-section">
        <h1>Return Policy</h1>
        <p>We want you to love your purchase, but if you are not completely satisfied, we gladly accept most returns by mail and in store within 30 days of purchase for free.</p>

        <h2>Return Conditions</h2>
        <ul>
            <li>Items must be returned within 30 days of purchase.</li>
            <li>Products must be unused, in the same condition you received them, and in their original packaging.</li>
            <li>Proof of purchase is required for all returns.</li>
            <li>Certain products, such as personalized items, are not eligible for return unless defective.</li>
        </ul>

        <h2>How to Return</h2>
        <p>To initiate a return, please follow these steps:</p>
        <ol>
            <li>Contact our customer service team to request a return authorization.</li>
            <li>Package your items securely, including the original packaging and the return authorization form.</li>
            <li>Send the package to the address provided by our customer service team.</li>
            <li>Once your return is received and inspected, we will send you an email to notify you that we have received your returned item. We will also notify you of the approval or rejection of your refund.</li>
        </ol>

        <h2>Refunds</h2>
        <p>If approved, your refund will be processed, and a credit will automatically be applied to your original method of payment within a certain number of days.</p>

        <h2>Exchanges</h2>
        <p>We only replace items if they are defective or damaged. If you need to exchange it for the same item, send us an email at exchanges@laparadis.com.</p>

        <h2>Shipping Costs</h2>
        <p>You will be responsible for paying for your own shipping costs for returning your item. Shipping costs are non-refundable. If you receive a refund, the cost of return shipping will be deducted from your refund.</p>

        <p>For more information, contact our customer service team. We're here to help!</p>
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
