<?php
session_start();
include 'db_connect.php';

// Redirect if not logged in as admin
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header('Location: admin_login.php');
    exit;
}

// Assuming 'orderID' is passed via GET request
$orderID = isset($_GET['orderID']) ? intval($_GET['orderID']) : 0;

// Fetch order details, customer info, payment details, including the most recent address
$orderDetailsQuery = "
SELECT 
    o.orderID, o.total, c.firstname, c.lastname, c.email,
    ca.addressLine1, ca.addressLine2, ca.postcode, ca.country,
    IFNULL(p.paymentType, 'Credit Card') AS paymentType, p.cardNumber
FROM 
    orders o
    LEFT JOIN customer c ON o.customerID = c.customerID
    LEFT JOIN payment p ON o.paymentID = p.paymentID
    LEFT JOIN (
        SELECT 
            ca1.customerID, 
            ca1.addressLine1, 
            ca1.addressLine2, 
            ca1.postcode, 
            ca1.country
        FROM 
            customeraddress ca1
        INNER JOIN (
            SELECT 
                customerID, 
                MAX(addressID) AS maxAddressID
            FROM 
                customeraddress
            GROUP BY 
                customerID
        ) ca2 ON ca1.customerID = ca2.customerID AND ca1.addressID = ca2.maxAddressID
    ) ca ON c.customerID = ca.customerID
WHERE 
    o.orderID = ?";

$stmt = $conn->prepare($orderDetailsQuery);
$stmt->bind_param('i', $orderID);
$stmt->execute();
$orderDetailsResult = $stmt->get_result()->fetch_assoc();

// Fetch items in the order
$orderItemsQuery = "
SELECT 
    p.name, oi.quantity, oi.subtotal
FROM 
    orderitem oi
JOIN 
    product p ON oi.productID = p.productID
WHERE 
    oi.orderID = ?";

$stmt = $conn->prepare($orderItemsQuery);
$stmt->bind_param('i', $orderID);
$stmt->execute();
$orderItemsResult = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="HomePageCSS.css">
</head>
<body>

<div class="container mt-5">
    <h2>Order Details (Order ID: <?php echo $orderID; ?>)</h2>
    <div class="order-info mb-4">
        <h4>Customer Information</h4>
        <p>Name: <?php echo htmlspecialchars($orderDetailsResult['firstname'] . ' ' . $orderDetailsResult['lastname']); ?></p>
        <p>Email: <?php echo htmlspecialchars($orderDetailsResult['email']); ?></p>
        <p>Address: <?php 
            echo htmlspecialchars($orderDetailsResult['addressLine1']) . ', ' .
                 htmlspecialchars($orderDetailsResult['addressLine2']) . ', ' .
                 htmlspecialchars($orderDetailsResult['postcode']) . ', ' .
                 htmlspecialchars($orderDetailsResult['country']);
            ?></p>
        <h4>Payment Information</h4>
        <p>Type: <?php echo htmlspecialchars($orderDetailsResult['paymentType']); ?></p>
        <p>Card Number: <?php echo htmlspecialchars($orderDetailsResult['cardNumber']); ?></p>
    </div>

    <div class="order-items">
        <h4>Order Items</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php while($item = $orderItemsResult->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>$<?php echo number_format($item['subtotal'], 2); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="actions">
        <a href="edit_order.php?orderID=<?php echo $orderID; ?>" class="btn btn-primary">Edit Order</a>
        <a href="manage_orders.php" class="btn btn-secondary">Back to Orders</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
