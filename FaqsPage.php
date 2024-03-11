<!DOCTYPE html>
<html lang="en-UK">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="FAQs with Le Paradis">
	<meta name="keywords" content="FAQs, questions, answers, Le Paradis">
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

	<section>
		<div class="section_middle_container">
			
		</div>
	</section>
	<section>
<div id="Login_Modal" class="login_modal">
    <!-- Login modal content container -->
    <form id="modalLoginForm" class="login_modal_content_container" action="authenticate.php" method="POST">
        <span class="close" id="close_Modal" onclick="closeModal()">&times;</span>
        <!-- Login modal content -->
        <div class="model_img_container">
            <img src="Images/logo.png" class="Login_img">
        </div>
        <div class="username_password_container">
            <label class="Label" for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" id="username" name="username" required>
            
            <label class="Label" for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" id="password" name="password" required>
            
			<div class="username_password_footer">
            <label>
            <input type="checkbox" name="remember"> Remember me
            </label>
            <a href="#" class="forgot_password_link">Forgot Password?</a>
        </div>

            <button class="Login_submit_button" type="submit">Login</button>
			<a href="#" class="Register_button" onclick="openRegisterModal()">Register</a>
			</form>
    </div>
</div>

			
<!-- Registration Modal -->
<div id="Register_Modal" class="register_modal hidden">
    <div class="register_modal_content_container">
        <span class="close" onclick="closeRegisterModal()">&times;</span>
        <form action="process_registration.php" method="post">
            <div class="model_img_container">
                <img src="Images/logo.png" class="Login_img">
            </div>
            <div class="register_form_container">
                <label class="Label" for="reg_firstname"><b>First Name</b></label>
                <input type="text" placeholder="Enter First Name" id="reg_firstname" name="firstname" required>
                
                <label class="Label" for="reg_lastname"><b>Last Name</b></label>
                <input type="text" placeholder="Enter Last Name" id="reg_lastname" name="lastname" required>
                
                <label class="Label" for="reg_username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" id="reg_username" name="username" required>
                
                <label class="Label" for="reg_email"><b>Email</b></label>
                <input type="email" placeholder="Enter Email" id="reg_email" name="email" required>
                
                <label class="Label" for="reg_mobile"><b>Mobile</b></label>
                <input type="text" placeholder="Enter Mobile Number" id="reg_mobile" name="mobile" required>
                
                <label class="Label" for="reg_password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" id="reg_password" name="password" required>
                
                <button class="Register_submit_button" type="submit">Register</button>
            </div>
        </form>
    </div>
</div>
            
    </section>

	
    <section>
    <div class="faq_wrapper">
		<h1>Frequently Asked Questions</h1>

		<div class="faq">
			<button class="according" onclick="according1()">
				Can I purchase Le Paradis products on the online boutique?
				<i class="fa-solid fa-chevron-down"></i>
			</button>
			<div class="panel">
				<p>
					A product is available for online purchase whenever the word “Order” appears. You can also contact us for assistance with your purchase.
				</p>
			</div>
		</div>

		<div class="faq">
			<button class="according" onclick="according1()">
				How can I create an account?
				<i class="fa-solid fa-chevron-down"></i>
			</button>
			<div class="panel">
				<p>
					You can create your Le Paradis customer account by clicking on the Login Icon located in the menu at the top of our website. Then click on "Register Here" and fill in the information required. Finally, click on "Register". If you require assistance or further information, please contact us.
				</p>
			</div>
		</div>

		<div class="faq">
			<button class="according" onclick="according1()">
				How can I find my account password?
				<i class="fa-solid fa-chevron-down"></i>
			</button>
			<div class="panel">
				<p>
					If you forget your password, click on the Login Icon, enter your email and then on "Change my password". An email will be sent to you to reset your password.
				</p>
			</div>
		</div>

		<div class="faq">
			<button class="according" onclick="according1()">
				How can I find out if a product is available on Le Paradis?
				<i class="fa-solid fa-chevron-down"></i>
			</button>
			<div class="panel">
				<p>
					The products on the website are organized by categories and by product line.
					Please use the search engine, indicated by a magnifying glass, and enter the key words. All the products with a relevant match to your search will be presented.
				</p>
			</div>
		</div>

		<div class="faq">
			<button class="according" onclick="according1()">
				How can I access my order history?
				<i class="fa-solid fa-chevron-down"></i>
			</button>
			<div class="panel">
				<p>
					If you have created a Le Paradis customer account, you can view your order history. Log in to your account and click on "My orders".
					If you have placed an order as a guest, please contact us now.
				</p>
			</div>
		</div>
	</div> 
</section>

	<section>
		<div class="section_middle_container"></div>
	</section>

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

<script src="Home_page.js"></script> <!-- Link to custom JavaScript file -->
</body>
</html> 