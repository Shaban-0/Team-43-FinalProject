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
$message = '';

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Example of updating an order item quantity
    $itemID = isset($_POST['itemID']) ? intval($_POST['itemID']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

    if ($itemID > 0 && $quantity > 0) {
        $updateQuery = "UPDATE orderitem SET quantity = ? WHERE itemID = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param('ii', $quantity, $itemID);
        if ($stmt->execute()) {
            $message = 'Order updated successfully.';
        } else {
            $message = 'Error updating order.';
        }
    }
}

// Fetch items in the order for editing
$orderItemsQuery = "SELECT oi.itemID, p.name, oi.quantity
                    FROM orderitem oi
                    JOIN product p ON oi.productID = p.productID
                    WHERE oi.orderID = ?";
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
    <title>Edit Order - Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="HomePageCSS.css">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Order (Order ID: <?php echo $orderID; ?>)</h2>
    <?php if (!empty($message)): ?>
        <div class="alert alert-info">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <form action="edit_order.php?orderID=<?php echo $orderID; ?>" method="post">
        <div class="order-items mb-4">
            <h4>Order Items</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($item = $orderItemsResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td><input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1"></td>
                            <td>
                                <input type="hidden" name="itemID" value="<?php echo $item['itemID']; ?>">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </form>
    <a href="order_details.php?orderID=<?php echo $orderID; ?>" class="btn btn-secondary">Back to Order Details</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
