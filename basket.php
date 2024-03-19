<?php
session_start();
include 'db_connect.php';

$sessionId = $_SESSION['sessionID'] ?? session_id();

$query = "SELECT p.name, p.price, b.quantity FROM basket b JOIN product p ON b.productID = p.productID WHERE b.sessionID = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    echo "Error preparing statement: " . $conn->error;
    exit;
}

$stmt->bind_param("s", $sessionId);
$stmt->execute();
$result = $stmt->get_result();
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
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
</nav>

<section>
 
    <div class="basket_container">
        <div>
            <h1>Your Shopping Basket</h1>
        </div>
        <div class="basket_table">
 <table id="basket">
    <thead>
        <tr>
            <th>Item</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td>
                <select name="quantity" class="quantity">
                    <option value="0">0</option>
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <option value="<?= $i ?>" <?= $i == $row['quantity'] ? 'selected' : '' ?>><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </td>
            <td class="price">$<span class="item-price" data-price="<?= $row['price'] * $row['quantity'] ?>"><?= number_format($row['price'] * $row['quantity'], 2) ?></span></td>
        </tr>
        <?php 
            // Calculate total price
            $totalPrice += $row['price'] * $row['quantity'];
        ?>
        <?php endwhile; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2"></td>
            <td>Total: $<span id="total"><?= number_format($totalPrice, 2) ?></span></td>
        </tr>
    </tfoot>
</table>

<script>
    // Update total price and remove item when quantity changes
    document.querySelectorAll('.quantity').forEach(function(element) {
        element.addEventListener('change', function() {
            var itemPriceElement = this.parentElement.nextElementSibling.querySelector('.item-price');
            var totalPriceElement = document.getElementById('total');
            var payButton = document.getElementById('payButton');
            
            // Calculate new item price
            var price = parseFloat(itemPriceElement.dataset.price) / parseInt(itemPriceElement.parentElement.previousElementSibling.querySelector('.quantity').value);
            var quantity = parseInt(this.value);
            var newItemPrice = price * quantity;
            itemPriceElement.innerText = newItemPrice.toFixed(2);
            itemPriceElement.setAttribute('data-price', newItemPrice);

            // Calculate total price
            var total = 0;
            document.querySelectorAll('.item-price').forEach(function(itemPrice) {
                total += parseFloat(itemPrice.getAttribute('data-price'));
            });
            totalPriceElement.innerText = total.toFixed(2);
            payButton.innerText = "Pay $" + totalPriceElement.innerText;
            
            // Remove item if quantity is 0
            if (quantity === 0) {
                var itemRow = this.closest('tr');
                itemRow.remove();
            }
        });
    });
</script>

<div style="justify-content: center;display: flex;">
    <a><button class='place_order_button' onclick="showPaymentForm()"><strong>Place Order</strong></button></a>
</div>

<div class="wrapper">
    <div class="payment">
        <div class="payment-logo">
            <img src="Images/logo.png">
        </div>

        <div class="form">
            <div class="space icon-relative">
                <label class="label">Card holder:</label>
                <input id="cardHolder" type="text" class="payment-input" placeholder="CardHolder Name">
                <i class="fas fa-user"></i>
            </div>
            <div class="space icon-relative">
                <label class="label">Card number:</label>
                <input id="cardNumber" type="text" class="payment-input" data-mask="0000 0000 0000 0000" placeholder="Card Number">
                <i class="far fa-credit-card"></i>
            </div>
            <div class="card-grp space">
                <div class="card-item icon-relative">
                    <label class="label">Expiry date:</label>
                    <input id="expiryDate" type="text" name="expiry-data" class="payment-input" data-mask="00/00"  placeholder="00/00">
                    <i class="far fa-calendar-alt"></i>
                </div>
                <div class="card-item icon-relative">
                    <label class="label">CVC:</label>
                    <input id="cvc" type="text" class="payment-input" data-mask="000" placeholder="000">
                    <i class="fas fa-lock"></i>
                </div>
            </div>
            <div class="btn">
                <button id="payButton" class="btn" onclick="validatePayment()">Pay $<?= number_format($totalPrice, 2) ?></button>
                <br>
                <button id="closeButton" class="btn" onclick="closePaymentForm()">Close</button>
            </div>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>


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
                <a href="ContactPage.php"class="Footer_Links"><li>Contact Us</li></a>
                <a href="FaqsPage.php"class="Footer_Links"><li>FAQs</li></a>
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
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-facebook"></a>
                <a href="#" class="fab fa-twitter"></a>
            </div>

            
        </div>
</footer>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="Home_page.js"></script> 

</body>
</html>