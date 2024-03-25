<?php
session_start();
include 'db_connect.php';

$sessionId = $_SESSION['sessionID'] ?? session_id();
$customerId = $_SESSION['customerID'] ?? null;

if (!$customerId) {
    echo "Error: User session not found.";
    exit;
}

$conn->begin_transaction();

try {
    $queryTotal = "SELECT SUM(p.price * b.quantity) AS total FROM basket b JOIN product p ON b.productID = p.productID WHERE b.sessionID = ?";
    $stmt = $conn->prepare($queryTotal);
    $stmt->bind_param("s", $sessionId);
    $stmt->execute();
    $totalResult = $stmt->get_result()->fetch_assoc();
    $total = $totalResult['total'] ?? 0;

    if ($total <= 0) {
        throw new Exception("Basket is empty or total calculation failed.");
    }

    $insertOrder = "INSERT INTO orders (customerID, total) VALUES (?, ?)";
    $stmt = $conn->prepare($insertOrder);
    $stmt->bind_param("id", $customerId, $total);
    $stmt->execute();
    $orderId = $conn->insert_id;

    $transferItems = "INSERT INTO orderitem (orderID, productID, quantity, subtotal, bottleSize, engraving) SELECT ?, b.productID, b.quantity, p.price * b.quantity, b.bottleSize, b.engraving FROM basket b JOIN product p ON b.productID = p.productID WHERE b.sessionID = ?";
    $stmt = $conn->prepare($transferItems);
    $stmt->bind_param("is", $orderId, $sessionId);
    $stmt->execute();

    $clearBasket = "DELETE FROM basket WHERE sessionID = ?";
    $stmt = $conn->prepare($clearBasket);
    $stmt->bind_param("s", $sessionId);
    $stmt->execute();

    $conn->commit();

    // Fetch customer details
    $customerDetailsQuery = "SELECT firstname, lastname, email, mobile FROM customer WHERE customerID = ?";
    $customerStmt = $conn->prepare($customerDetailsQuery);
    $customerStmt->bind_param("i", $customerId);
    $customerStmt->execute();
    $customerResult = $customerStmt->get_result();
    $customerDetails = $customerResult->fetch_assoc();

    ?>
    <!DOCTYPE html>
    <html lang="en-UK">
    <head>
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
			<a href="men.php" class="Link_Button" id="nav_button1"><button class="nav_btn"><b>Men</b></button></a>
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


        <div class="content-container">
            <h1>Order Confirmation</h1>
            <p>Order placed successfully. Order ID: <?php echo $orderId; ?></p>
            <p>Total Price: £<?php echo number_format($total, 2); ?></p>
            <h2>Customer Details:</h2>
            <p>Name: <?php echo htmlspecialchars($customerDetails['firstname']) . " " . htmlspecialchars($customerDetails['lastname']); ?></p>
            <p>Email: <?php echo htmlspecialchars($customerDetails['email']); ?></p>
            <p>Mobile: <?php echo htmlspecialchars($customerDetails['mobile']); ?></p>
            <a href='HomePage.php'><button>Return to Homepage</button></a>
        </div>

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
        <script src="Home_Page.js"></script> <!-- If you have a custom JS file -->
    </body>
    </html>
    <?php
} catch (Exception $e) {
    $conn->rollback();
    echo "Error placing order: " . $e->getMessage();
}
?>

