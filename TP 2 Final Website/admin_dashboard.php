<?php
session_start();
include 'db_connect.php';

// Check if admin is logged in, redirect if not
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header('Location: admin_login.php');
    exit;
}
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
    <title>Admin Dashboard - La Paradis</title>
    <link rel="icon" type="image/x-icon" href ="Images/favicon.ico">
</head>
<body>
<header>
    <!-- Header section for Admin Dashboard -->
    <div class="flex_logo_container" id="logo_div">
        <img class="logo_transition" id="logo" src="Images/logo.png"> <!-- Logo image -->
        <h2>Admin Dashboard</h2> <!-- Dashboard Title -->
        <a href="logout.php" class="logout_button"><img src="Images/logout_icon.png" class="header_icon" alt="Logout"></a>
    </div>
    
    <!-- Admin Navigation -->
    <nav class="nav_container" id="admin_nav_div">
        <a href="manage_products.php" class="Link_Button"><button class="nav_btn"><b>Manage Products</b></button></a>
        <a href="manage_orders.php" class="Link_Button"><button class="nav_btn"><b>Manage Orders</b></button></a>
        <a href="manage_users.php" class="Link_Button"><button class="nav_btn"><b>Manage Users</b></button></a>
    </nav>
</header>

<main>
    <!-- Main content area for Admin Dashboard -->
    <div class="admin_dashboard">
        <section class="dashboard_section">
            <h1>Welcome to Your Admin Dashboard</h1>
            <p>Welcome to the heart of La Paradis, the Admin Dashboard. Here, you are at the helm of our exquisite fragrance website, empowered to curate and refine the essence of luxury our users experience. Your role is pivotal in maintaining the high standard of our collections, ensuring each product listing is as captivating as the scents themselves.</p>
            <p>From this dashboard, you can manage product listings, process orders, and interact with user queries, ensuring our community's satisfaction and engagement. Your insights and decisions will shape the future of La Paradis, fostering a vibrant and flourishing online presence. Explore the various functionalities at your disposal:</p>
            <ul>
                <li><strong>Manage Products:</strong> Add new fragrances, update existing product details, and curate our collections to keep our offerings fresh and exciting.</li>
                <li><strong>Manage Orders:</strong> View recent orders, update order statuses, and ensure our customers receive their purchases promptly.</li>
                <li><strong>Manage Users:</strong> Oversee user accounts, respond to user feedback, and foster a supportive and engaged community.</li>
            </ul>
            <p>Thank you for being an integral part of La Paradis. Together, let's continue to captivate and enchant our customers with the world's finest fragrances.</p>
        </section>
    </div>
</main>

<footer>
    <!-- Footer reused from the HomePage with minor adjustments for Admin Dashboard -->
    <div class="Home_page_footer">
        <div class="Footer_lists">
            <ul><h2>Quick Links</h2>
            <a href="HomePage.php"class="Footer_Links"><li>Homepage</li></a>
            <a href="contactus.php"class="Footer_Links"><li>Contact Us</li></a>
            <a href="faqs.php"class="Footer_Links"><li>FAQs</li></a>
            </ul>
        </div>
        <div class="Social_media_logos">
            <a href="#" class="fa fa-instagram"></a>
            <a href="#" class="fa fa-facebook"></a>
            <a href="#" class="fa fa-twitter"></a>
        </div>
    </div>
</footer>
<script src="Home_Page.js"></script>
</body>
</html>
