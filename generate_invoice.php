<?php
session_start();
include 'db_connect.php';

// Check if orderID is passed
$orderID = isset($_GET['orderID']) ? (int)$_GET['orderID'] : 0;

if ($orderID > 0) {
    // Fetch order details
    $orderSql = "SELECT * FROM orders WHERE orderID = ?";
    $orderStmt = $conn->prepare($orderSql);
    if (!$orderStmt) {
        die("Error preparing order query: " . $conn->error);
    }

    $orderStmt->bind_param("i", $orderID);
    $orderStmt->execute();
    $order = $orderStmt->get_result()->fetch_assoc();

    if (!$order) {
        die("Order not found for orderID: " . $orderID);
    }

    // Fetch customer details
    $customerSql = "SELECT * FROM customer WHERE customerID = ?";
    $customerStmt = $conn->prepare($customerSql);
    if (!$customerStmt) {
        die("Error preparing customer query: " . $conn->error);
    }

    $customerStmt->bind_param("i", $order['customerID']);
    $customerStmt->execute();
    $customer = $customerStmt->get_result()->fetch_assoc();

    // Fetch order items and associated product details
    $itemsSql = "SELECT oi.*, p.name, p.categoryID, c.name AS categoryName 
                 FROM orderitem oi 
                 JOIN product p ON oi.productID = p.productID 
                 JOIN category c ON p.categoryID = c.categoryID 
                 WHERE oi.orderID = ?";
    $itemsStmt = $conn->prepare($itemsSql);
    if (!$itemsStmt) {
        die("Error preparing items query: " . $conn->error);
    }

    $itemsStmt->bind_param("i", $orderID);
    $itemsStmt->execute();
    $items = $itemsStmt->get_result()->fetch_all(MYSQLI_ASSOC);

    // Calculate total amount
    $totalAmount = 0;
    foreach ($items as $item) {
        $totalAmount += $item['subtotal'];
    }
} else {
    echo "Invalid order ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
</head>
<body>
    <?php if ($orderID > 0 && $order && $customer && $items): ?>
        <h1>Invoice</h1>
        <h2>Order ID: <?php echo $orderID; ?></h2>
        <p><strong>Customer Name:</strong> <?php echo htmlspecialchars($customer['firstname']) . ' ' . htmlspecialchars($customer['lastname']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($customer['email']); ?></p>
        
        <h3>Order Details</h3>
        <table border="1">
            <tr>
                <th>Category</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
            <?php foreach ($items as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['categoryName']); ?></td>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td><?php echo $item['price']; ?></td>
                <td><?php echo $item['subtotal']; ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="4" style="text-align:right;"><strong>Total Amount:</strong></td>
                <td><?php echo $totalAmount; ?></td>
            </tr>
        </table>
    <?php else: ?>
        <p>Invoice details not found.</p>
    <?php endif; ?>
</body>
</html>
