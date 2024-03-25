<?php
session_start();
include 'db_connect.php';

// Assuming $_SESSION['customerID'] stores the logged-in customer's ID
$customerId = $_SESSION['customerID'];

// Payment details from POST request
$paymentType = "Credit Card"; // Simplified for demonstration
$cardNumber = $_POST['cardNumber'];
$expiryDate = $_POST['cardExpiry'];
$cvv = $_POST['cardCVV'];
$paymentName = $customerId; // Or another identifier if you have

// Address details from POST request
$addressLine1 = $_POST['addressLine1'];
$addressLine2 = $_POST['addressLine2'] ?? '';
$postcode = $_POST['postcode'];
$country = $_POST['country'];

// Insert payment details into `payment` table
$stmtPayment = $conn->prepare("INSERT INTO payment (paymentType, cardNumber, expiryDate, CVV, paymentName) VALUES (?, ?, ?, ?, ?)");
$stmtPayment->bind_param("sssss", $paymentType, $cardNumber, $expiryDate, $cvv, $paymentName);
$stmtPayment->execute();
$paymentId = $conn->insert_id;

// Insert address details into `customeraddress` table
$stmtAddress = $conn->prepare("INSERT INTO customeraddress (customerID, addressLine1, addressLine2, postcode, country) VALUES (?, ?, ?, ?, ?)");
$stmtAddress->bind_param("issss", $customerId, $addressLine1, $addressLine2, $postcode, $country);
$stmtAddress->execute();
$addressId = $conn->insert_id;

// Here you would also handle creating an order in the `orders` table, linking the payment and possibly the address

// Redirect or inform the user of success/failure
if ($paymentId && $addressId) {
    
    header('Location: place_order.php');
} else {
    // Handle error
    echo "Error processing your order.";
}

// Always ensure to close statement and connection if you're done with them
$stmtPayment->close();
$stmtAddress->close();
$conn->close();
?>
