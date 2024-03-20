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
        <input type="image" class="logo_transition" id="logo" src="Images/logo.png"/> <!-- Logo image -->
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
		<a href="men.php" class="Link_Button" id="nav_button1"><button class="nav_btn"><b>Men</b></button></a>
        <a href="women.php" class="Link_Button" id="nav_button2"><button class="nav_btn"><b>Women</b></button></a>
        <a href="unisex.php" class="Link_Button" id="nav_button3"><button class="nav_btn"><b>Unisex</b></button></a>
        <a href="sale.php" class="Link_Button" id="nav_button4"><button class="nav_btn"><b>Sale</b></button></a>
        <a href="giftsets.php" class="Link_Button" id="nav_button5"><button class="nav_btn"><b>Gift Sets</b></button></a>
        </div>
    </nav>

    <footer>
        <div class="TOS_container">
            <h2>Delivery Information</h2>
            <ul>
                <li>We offer fast and reliable shipping through trusted carriers such as UPS, FedEx, and USPS.</li>
                <li>Standard shipping typically takes 3-5 business days within the continental United States, while expedited shipping options are available for faster delivery.</li>
                <li>International shipping times may vary depending on the destination country and customs processing times.</li>
                <li>Shipping costs are calculated at checkout based on the destination and weight of the items in your order. Free shipping may be available for orders over a certain amount.</li>
                <li>Once your order has been shipped, you will receive a confirmation email with tracking information so you can monitor the status of your delivery.</li>
            </ul>
        </div>
        
        <div class="TOS_container">
            <h2>Customer Service</h2>
            <ul>
                <li>Our dedicated customer service team is comprised of knowledgeable representatives who are here to assist you with any questions, concerns, or issues you may have.</li>
                <li>You can reach our customer service team via email at <a href="mailto:support@example.com">support@example.com</a> or by phone at <a href="tel:18001234567">1-800-123-4567</a> during our business hours, Monday to Friday, 9:00 AM to 5:00 PM EST.</li>
                <li>Additionally, our website features a convenient live chat option where you can chat with a customer service representative in real-time for immediate assistance.</li>
            </ul>
        </div>

        <div class="TOS_container">
            <h2>Return Policy</h2>
            <ul>
                <li>We want you to be completely satisfied with your purchase. If for any reason you're not happy with your order, you can return it within 30 days of delivery for a full refund or exchange.</li>
                <li>Items must be returned in their original condition with all tags and packaging intact.</li>
                <li>To initiate a return, please contact our customer service team to obtain a return authorization and further instructions on how to process your return.</li>
                <li>Please note that return shipping costs are the responsibility of the customer unless the return is due to a mistake on our part or a defective product.</li>
            </ul>
        </div>


        <div class="TOS_container">
            <h2>About Us</h2>
            <ul>
                <li>Founded in 2023, Le Paradis Company is a family-owned business dedicated to providing customers with high-quality products and exceptional service.</li>
                <li>Our mission is to exceed customer expectations by offering innovative solutions, superior quality, and unparalleled customer support.</li>
                <li>With a commitment to excellence and integrity, we strive to build long-lasting relationships with our customers and partners.</li>
            </ul>
        </div>

        <div class="TOS_container">
            <h2>Careers</h2>
            <ul>
                <li>Join our team of passionate individuals who are dedicated to making a positive impact in the world!</li>
                <li>At La Paradis Company, we believe in fostering a culture of collaboration, creativity, and continuous learning.</li>
                <li>Explore our current job openings and discover exciting career opportunities in areas such as sales, marketing, customer service, and more.</li>
            </ul>
        </div>

        <div class="TOS_container">
            <h2>Affiliates</h2>
            <ul>
                <li>Are you interested in partnering with us to promote our products and earn commissions?</li>
                <li>Our affiliate program offers competitive commission rates, exclusive promotional materials, and dedicated support to help you succeed.</li>
                <li><a href="#">Sign up</a> now and start earning commissions for referring customers to Example Company!</li>
            </ul>
        </div>

        <div class="TOS_container">
            <h2>Student Discount</h2>
            <ul>
                <li>Calling all students! Enjoy exclusive savings with our student discount program.</li>
                <li>Simply verify your student status with a valid student ID or .edu email address to receive a special discount on your next purchase.</li>
                <li>Don't miss out on these extra savings – shop now and save on your favorite perfumes!</li>
            </ul>
        </div>

        <div class="TOS_container">
            <h2>Terms & Conditions</h2>
            <ul>
                <li>By accessing and using our website, you agree to comply with and be bound by the following terms and conditions.</li>
                <li>These terms govern your use of our website and any transactions conducted through the site.</li>
                <li>Please review our full Terms & Conditions document <a href="#">here</a> for detailed information on your rights and obligations when using our website.</li>
                <li>If you do not agree with any part of these terms, you may not access or use the site.</li>
            </ul>
        </div>

        <div class="TOS_container">
            <h2>Privacy Policy</h2>
            <ul>
                <li>Protecting your privacy is important to us. Our privacy policy outlines how we collect, use, and protect your personal information.</li>
                <li>We are committed to maintaining the confidentiality of your personal data and using it only for the purposes outlined in our <a href="#">Privacy Policy</a>.</li>
                <li>Please review our privacy policy to understand how we handle your information and your rights regarding your personal data.</li>
            </ul>
        </div>

        <div class="TOS_container">
            <h2>Cookie Policy</h2>
            <ul>
                <li>Our website uses cookies to enhance your browsing experience and provide personalized content tailored to your interests.</li>
                <li>Cookies are small text files that are stored on your computer or mobile device when you visit our website.</li>
                <li>By continuing to browse our site, you consent to the use of cookies in accordance with our <a href="#">Cookie Policy</a>. You can manage your cookie preferences and settings in your browser or device settings.</li>
            </ul>
        </div>

    <footer>
        <!-- Footer section with help, about us, legal, and review content -->
        <div class="Home_page_footer">
            <!-- Footer lists with links -->
            <div class="Footer_lists">
                <ul><h2>Help</h2>
                <a href="TOS.html"class="Footer_Links"><li>Delivery Information</li></a>
                <a href="TOS.html"class="Footer_Links"><li>Customer Service</li></a>
                <a href="TOS.html"class="Footer_Links"><li>Return Policy</li></a>
                <a href="ContactPage.HTML"class="Footer_Links"><li>Contact Us</li></a>
                <a href="Faqs.html"class="Footer_Links"><li>FAQs</li></a>
                </ul>

                <ul><h2>About Us</h2>
                <a href="TOS.html"class="Footer_Links"><li>About Us</li></a>
                <a href="TOS.html"class="Footer_Links"><li>Careers</li></a>
                <a href="TOS.html"class="Footer_Links"><li>Affiliates</li></a>
                <a href="TOS.html"class="Footer_Links"><li>Student Discount</li></a>
                </ul>
        

                <ul><h2>Legal</h2>
                <a href="TOS.html"class="Footer_Links"><li>Terms & Conditions</li></a>
                <a href="TOS.html"class="Footer_Links"><li>Privacy Policy</li></a>
                <a href="TOS.html"class="Footer_Links"><li>Cookie Policy</li></a>

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
</body>
</html>