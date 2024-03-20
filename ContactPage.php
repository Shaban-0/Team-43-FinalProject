<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
		<a href="men.php" class="Link_Button" id="nav_button1"><button class="nav_btn"><b>Men</b></button></a>
		<a href="women.php" class="Link_Button" id="nav_button2"><button class="nav_btn"><b>Women</b></button></a>
		<a href="unisex.php" class="Link_Button" id="nav_button3"><button class="nav_btn"><b>Unisex</b></button></a>
		<a href="sale.php" class="Link_Button" id="nav_button4"><button class="nav_btn"><b>Sale</b></button></a>
		<a href="giftsets.php" class="Link_Button" id="nav_button5"><button class="nav_btn"><b>Gift Sets</b></button></a>
		</div>
>
	</nav>

	
	<H1>Contact Us</H1>
	<form id="contactForm" method="post" onsubmit="return validateForm()">
		<h2>Contact Form</h2>
		<label for="fname">First Name</label>
		<input type="text" id="fname" name="firstname" placeholder="Your first name.." class="text-input1">
		<label for="lname">Last Name</label>
		<input type="text" id="lname" name="lastname" placeholder="Your last name.." class="text-input1">
		<label for="email">Email</label>
		<input type="text" id="email" name="email" placeholder="Your Email Address..." class="text-input1">
		<label for="subject">How Can We Help You?</label>
		<textarea id="subject" name="subject" placeholder="Write something.." rows="10" cols="10" class="text-input1"></textarea>
		<input id="submit-button" type="submit" value="Submit" class="submit-button">
		<input type="hidden" name="submitted" value="true"/>
	</form>
	<div class="contact-box">
		<h3>GET IN TOUCH WITH US</h3>
		<div class="contact-details">
			<div class="contact-item">
				<img src="Images/Phone.png" alt="Phone Number" width="30px" height="30px">
				<p>  0121 546 2132</p>
			</div>
			<div class="contact-item">
				<img src="Images/Email.png" alt="Email Address" width="30px" height="30px">
				<p>laparadis@gmail.com</p>
			</div>
			<div class="contact-item">
				<img src="Images/address.png" alt="Address" width="30px" height="30px">
				<p>123 Random Street, Birmingham,UK, B12 3CD</p>
			</div>
		</div>
	</div>
	<br>
	<br>
	<br>
	  <footer>
		<!--Footer section with help, about us, legal, and review content-->
		<!-- Footer section with help, about us, legal, and review content -->
		<div class="Home_page_footer">
			<!-- Footer lists with links -->
			<div class="Footer_lists">
				<ul><h2>Help</h2>
				<a href="TOS.php"class="Footer_Links"><li>Delivery Information</li></a>
				<a href="TOS.php"class="Footer_Links"><li>Customer Service</li></a>
				<a href="TOS.php"class="Footer_Links"><li>Return Policy</li></a>
				<a href="TOS.php"class="Footer_Links"><li>Contact Us</li></a>
				<a href="TOS.php"class="Footer_Links"><li>FAQs</li></a>
				</ul>

				<ul><h2>About Us</h2>
				<a href="TOS.php"class="Footer_Links"><li>About Us</li></a>
				<a href="TOS.php"class="Footer_Links"><li>Careers</li></a>
				<a href="TOS.php"class="Footer_Links"><li>Affiliates</li></a>
				<a href="TOS.php"class="Footer_Links"><li>Student Discount</li></a>
				</ul>
		

				<ul><h2>Legal</h2>
				<a href="TOS.php"class="Footer_Links"><li>Terms & Conditions</li></a>
				<a href="TOS.php"class="Footer_Links"><li>Privacy Policy</li></a>
				<a href="TOS.php"class="Footer_Links"><li>Cookie Policy</li></a>

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

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
		$(document).ready(function(){
			$("#contactForm").submit(function(event) {
				let submit = document.getElementById("submit-button");
				let message = ''
				let form = document.getElementById("contactForm");
				let fname = form.firstname.value;
				let lname = form.lastname.value;
				let email = form.email.value;
				let subject = form.subject.value;
				message += "Hi "  + fname + " "+ lname + " thank you for contacting us." + "\n" + 
					"Email: " + email + "\n" + "We have recieved your message: " + subject;
				alert(message);
			});
		});
	</script>

<script src="Home_Page.js"></script>
</body>
</html>

<?php
session_start();
include 'db_connect.php';
require 'PHPMailer.php';
require 'SMTP.php';

$errors = [];
if (isset($_POST['submitted'])) {
	$firstname = trim($_POST["firstname"]);
	if (empty($firstname)){
		$errors[] = "Firstname required";
	}

	$lastname = trim($_POST["lastname"]);
	if (empty($lastname)){
		$errors[] = "Lastname required";
	}

	$email = trim($_POST["email"]);
	if (empty($email)){
		$errors[] = "Email required";
	}

	$message = trim($_POST["subject"]);
	if (empty($message)){
		$errors[] = "Message required";
	}

}
if (!empty($errors)){
	$name = $firstname . ' ' . $lastname;
	$recipient = "laparadis43@gmail.com"; 
	$subject = "New message from website";
	$body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

	$mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail ->SMTPAuth = true;
	$mail->Username = 'laparadis43@gmail.com';
    $mail->Password = 'Team43_$';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587; 
	
	$mail->setFrom('laparadis43@gmail.com', 'Website contact us page');
    $mail->addAddress($recipient); 
    $mail->Subject = $subject;
    $mail->Body = $body;


    if ($mail->send()){
        echo "Email sent successfully";
    }else{
        echo "Failed to send email";
    }
} else {
	foreach ($errors as $error) {
		echo $error . "<br>";
	}
}

?>