<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header('Location: admin_login.php');
    exit;
}

// Assign the SQL query string to $ordersQuery
$ordersQuery = "
SELECT 
    o.orderID, 
    CONCAT(c.firstname, ' ', c.lastname) AS customerName, 
    c.email, 
    o.total, 
    IFNULL(p.paymentType, 'Credit Card') AS paymentType, 
    ca.addressLine1, 
    ca.addressLine2, 
    ca.postcode, 
    ca.country
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
ORDER BY 
    o.orderID DESC";


if ($ordersResult = $conn->query($ordersQuery)) {
    // Query success
    if ($ordersResult->num_rows > 0) {
        // Process results
    } else {
        echo "No orders found.";
    }
} else {
    // Query error
    echo "Error executing query: " . $conn->error;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders - Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { margin-top: 20px; }
        .table { width: 100%; }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage Orders</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Total</th>
                <th>Payment Type</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($order = $ordersResult->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($order['orderID']); ?></td>
                    <td><?= htmlspecialchars($order['customerName']); ?></td>
                    <td><?= htmlspecialchars($order['email']); ?></td>
                    <td>$<?= htmlspecialchars(number_format($order['total'], 2)); ?></td>
                    <td><?= htmlspecialchars($order['paymentType']); ?></td>
                    <td><?= htmlspecialchars($order['addressLine1']) . (!empty($order['addressLine2']) ? ', ' . htmlspecialchars($order['addressLine2']) : '') . ', ' . htmlspecialchars($order['postcode']) . ', ' . htmlspecialchars($order['country']); ?></td>
                    <td>
                        <a href="order_details.php?orderID=<?= $order['orderID']; ?>" class="btn btn-info btn-sm">Details</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
