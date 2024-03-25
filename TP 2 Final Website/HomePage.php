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

$isAdmin = isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] === true;
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
	<link rel="icon" type="image/x-icon" href ="Images/favicon.ico">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
		<div class="flex_search_bar_container">

<div class="search_bar">
    <input type="text" id="searchQuery" placeholder="Search for perfumes..." onkeyup="searchPerfumes()">
    <button class="search_button" onclick="searchPerfumes()"><b>Search</b></button>
<div id="searchResults" class="search-results-container"></div>

</div>

<!-- Perfume Detail Modal -->
<div id="perfumeDetailModal" class="modal">
    <div class="modal-content">
        <!-- Perfume details will be dynamically inserted here -->
    </div>
</div>


	</nav>

	<article>
		<!-- Main content section with left and right containers, slideshow, and content -->
		<!-- Left container with text and "button" -->
<div class="section_left_container fade-in-section">
    <div class="section_left_container_text">
        <p><b>"Your journey into the world of exclusive fragrances begins here..."</b></p>
        <!-- Use an anchor tag styled as a button for redirection -->
        <a href="men.php" class="section_left_button" onmouseover="Colour_Change_Left()" onmouseout="Colour_Restore_Left()"><b>Click Here</b></a>
    </div>
</div>

<!-- Right container with text and "button" -->
<div class="section_right_container fade-in-section">
    <div class="section_right_container_text">
        <p><b>"Dive into the sophisticated realm of our Unisex Collection..."</b></p>
        <!-- Use an anchor tag styled as a button for redirection -->
        <a href="unisex.php" class="section_right_button" onmouseover="Colour_Change_Right()" onmouseout="Colour_Restore_Right()"><b>Click Here</b></a>
    </div>
</div>

		<div class="slideshow_box">
		<!-- Slideshow box with images and indicators -->
		<div class="mySlides fade">
		  <div class="Slide_number">1 / 4</div>
		  <img src="Images\SlideShowImage1.png" class="Slide_Image">
			</div>

		<div class="mySlides fade">
		  <div class="Slide_number">2 / 4</div>
		  <img src="Images\SlideShowImage2.png" class="Slide_Image">
		</div>


		<div class="mySlides fade">
		  <div class="Slide_number">3 / 4</div>
		  <img src="Images\SlideShowImage3.png" class="Slide_Image">
		</div>

		<div class="mySlides fade">
		  <div class="Slide_number">4 / 4</div>
		  <img src="Images\SlideShowImage4.png" class="Slide_Image">
		</div>

		</div>


		<div class="Slide_Indicator_Container">
				<!-- Slide indicators -->
		  <span class="Slide_Indicator"></span> 
		  <span class="Slide_Indicator"></span> 
		  <span class="Slide_Indicator"></span>
		  <span class="Slide_Indicator"></span> 
		</div>


	</article>

	<section>
		<!-- Login modal section for user login -->
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
            <input type="checkbox" name="remember" id="remember"> Remember me
            </label>
            <a href="#" class="forgot_password_link">Forgot Password?</a>
        </div>

            <button class="Login_submit_button" type="submit">Login</button>
			<a href="#" class="Register_button" onclick="openRegisterModal()">Register</a>
			<a href="#" class="Register_button" onclick="showAdminLoginForm()">Login as Admin</a>
			<a href="#" class="Register_button" onclick="showAdminRegisterForm()">Register as Admin</a>
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


<div id="Admin_Login_Modal" class="login_modal hidden">
    <div class="login_modal_content_container">
	<span class="close" onclick="closeAdminLoginModal()">&times;</span>
        <form id="adminLoginForm" action="admin_authenticate.php" method="post">
            <div class="model_img_container">
                <img src="Images/logo.png" class="Login_img">
            </div>
            <div class="username_password_container">
                <label class="Label" for="admin_username"><b>Admin Username</b></label>
                <input type="text" placeholder="Enter Admin Username" id="admin_username" name="username" required>
                
                <label class="Label" for="admin_password"><b>Admin Password</b></label>
                <input type="password" placeholder="Enter Admin Password" id="admin_password" name="password" required>
                
                <button class="Login_submit_button" type="submit">Login</button>
            </div>
        </form>
    </div>
</div>


<div id="Admin_Register_Modal" class="register_modal hidden">
    <div class="register_modal_content_container">
	<span class="close" onclick="closeAdminRegisterModal()">&times;</span>
        <form id="adminRegisterForm" action="process_admin_registration.php" method="post">
            <div class="model_img_container">
                <img src="Images/logo.png" class="Login_img">
            </div>
            <div class="register_form_container">
                <label class="Label" for="admin_firstname"><b>First Name</b></label>
                <input type="text" placeholder="Enter First Name" id="admin_firstname" name="firstname" required>
                
                <label class="Label" for="admin_lastname"><b>Last Name</b></label>
                <input type="text" placeholder="Enter Last Name" id="admin_lastname" name="lastname" required>
                
                <label class="Label" for="admin_username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" id="admin_username" name="username" required>
                
                <label class="Label" for="admin_email"><b>Email</b></label>
                <input type="email" placeholder="Enter Email" id="admin_email" name="email" required>
                
                <label class="Label" for="admin_mobile"><b>Mobile</b></label>
                <input type="text" placeholder="Enter Mobile Number" id="admin_mobile" name="mobile" required>
                
                <label class="Label" for="admin_password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" id="admin_password" name="password" required>
                
				<label class="Label" for="specialCode"><b>Special Code</b></label>
				<input type="text" placeholder="Enter Special Code" id="specialCode" name="specialCode" required>
				
                <button class="Register_submit_button" type="submit">Register</button>
            </div>
        </form>
    </div>
</div>
            
</section>

<section>
		<!-- Middle section with a brief description of the perfumes -->
		<div class="section_middle_container">
			<div class="section_middle_container_text">
			<p>" Our perfumes are crafted to be more than scents; they are expressions of individuality, capturing the essence of timeless elegance. Welcome to a world where each fragrance is a chapter in the novel of your extraordinary journey. "</p>
			</div>
		</div>
	</section>
	<section>
		<!-- Owl Carousel section with perfume cards -->
		<div class="owl-carousel owl-theme" >
			<!-- Carousel items with perfume information -->

	        <div class="item">
	            <div class="card_flipped" onmouseover="pauseCarousel()" onmouseout="playCarousel()">
	                <div class="card_inside">
	                    <div class="card_flipped_front">
	                        <img src="Images\OwlCarouselImage1.png">
	                    </div>
	                    <div class="card_flipped_back">
	                        <h2>Enchanté Elysium</h2>
	                        <div>
	                        <p>Embark on a fragrant journey with Enchanté Elysium, a perfume that captures the essence of a mystical paradise. Let the notes of celestial bergamot, ethereal jasmine, and velvety vanilla transport you to a world where every moment is a sublime encounter with pure bliss.</p>
	                       
	                        <p><b>£49.99</b></p>
	             
	                        <button class="card_flipped_back_button"> Learn more</button>
	                    </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="item">
	            <div class="card_flipped" onmouseover="pauseCarousel()" onmouseout="playCarousel()">
	                <div class="card_inside">
	                    <div class="card_flipped_front">
	                        <img src="Images\OwlCarouselImage2.png">
	                    </div>
	                    	<div class="card_flipped_back">
		                        <h2>Opulent Orchid Oasis</h2>
		                        <div>
		                        <p>Indulge in the luxurious allure of Opulent Orchid Oasis. This captivating fragrance unfolds with the delicate petals of rare orchids, entwined with hints of exotic sandalwood and a whisper of musk. Immerse yourself in the opulence of a secret garden, where elegance reigns supreme.</p>
		                    
		                        <p><b>£49.99</b></p>
		               
		                        <button class="card_flipped_back_button"> Learn more</button>
	                    </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="item">
	            <div class="card_flipped" onmouseover="pauseCarousel()" onmouseout="playCarousel()">
	                <div class="card_inside">
	                    <div class="card_flipped_front">
	                        <img src="Images\OwlCarouselImage3.png">
	                    </div>
	                    	<div class="card_flipped_back">
		                        <h2>Mystic Moonflower Melody</h2>
		                        <div>
		                        <p>Mystic Moonflower Melody is an enchanting symphony of floral notes that dance under the moonlight. Delicate moonflower blossoms intertwine with the warmth of amber and a touch of mysterious incense. Surrender to the allure of the night and embrace the magic within.</p>
    	                 		                        <p><b>£49.99</b></p>
		                
		                        <button class="card_flipped_back_button"> Learn more</button>
	                    </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="item">
	            <div class="card_flipped" onmouseover="pauseCarousel()" onmouseout="playCarousel()">
	                <div class="card_inside">
	                    <div class="card_flipped_front">
	                        <img src="Images\OwlCarouselImage4.png">
	                    </div>
	                    	<div class="card_flipped_back">
		                        <h2>Radiant Riviera Breeze</h2>
		                        <div>
		                        <p>Unveil the refreshing Radiant Riviera Breeze, a perfume that captures the essence of a sun-kissed paradise. Citrusy bergamot, lively lemon, and a hint of sea breeze blend harmoniously, creating a fragrance that transports you to the idyllic shores of the Mediterranean. Embrace the joy of endless summer.</p>
    	                
		                        <p><b>£49.99</b></p>
		        
		                        <button class="card_flipped_back_button"> Learn more</button>
	                    </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="item">
	            <div class="card_flipped" onmouseover="pauseCarousel()" onmouseout="playCarousel()">
	                <div class="card_inside">
	                    <div class="card_flipped_front">
	                        <img src="Images\OwlCarouselImage5.png">
	                    </div>
	                    	<div class="card_flipped_back">
		                        <h2>Sapphire Serenity Spell</h2>
		                        <div>
		                        <p>Experience the calming embrace of Sapphire Serenity Spell, a fragrance that weaves a tapestry of tranquility. The mystical blue notes of sapphire meld with soothing lavender and gentle vanilla, creating a spellbinding aura of peace. Immerse yourself in the serenity of a moment frozen in time.</p>
		                       
		                        <p><b>£49.99</b></p>
		                
		                        <button class="card_flipped_back_button"> Learn more</button>
	                    </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="item">
	            <div class="card_flipped" onmouseover="pauseCarousel()" onmouseout="playCarousel()">
	                <div class="card_inside">
	                    <div class="card_flipped_front">
	                        <img src="Images\OwlCarouselImage6.png">
	                    </div>
	                    	<div class="card_flipped_back">
		                        <h2>Celestial Citrus Cascade</h2>
		                        <div>
		                        <p>Elevate your senses with Celestial Citrus Cascade, a perfume that sparkles like stars in the night sky. Zesty citrus blends with celestial florals, creating a fragrance that is as invigorating as a cascade of shooting stars. Embark on a journey where every spritz is a celestial celebration.</p>
		                        
		                        <p><b>£49.99</b></p>

		                        <button class="card_flipped_back_button"> Learn more</button>
	                    </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>


		<?php
    // Check if we have a success message to display
    if (isset($_SESSION['success_message'])) {
        echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
        // Unset the success message after displaying it so it doesn't show again on refresh
        unset($_SESSION['success_message']);
    }
    ?>

 


	    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
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

<script src="Home_Page.js"></script> <!-- Link to custom JavaScript file -->
<script src="search.js"></script>

</body>
</html> 