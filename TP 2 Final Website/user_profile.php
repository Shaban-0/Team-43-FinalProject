<?php
session_start();
include 'db_connect.php'; // Include your DB connection script

// Redirect to login page if not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: HomePage.php');
    exit;
}

$userId = $_SESSION['customerID']; // Adjust if your session variable name is different

// Function to handle password change
function changePassword($conn, $userId, $currentPassword, $newPassword, $confirmNewPassword) {
    if ($newPassword !== $confirmNewPassword) {
        return "New passwords do not match.";
    }
    
    // Get current password hash from the database
    $stmt = $conn->prepare("SELECT password_hash FROM customer WHERE customerID = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if (!password_verify($currentPassword, $user['password_hash'])) {
        return "Current password is incorrect.";
    }
    
    // Hash new password
    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
    
    // Update password in the database
    $updateStmt = $conn->prepare("UPDATE customer SET password_hash = ? WHERE customerID = ?");
    $updateStmt->bind_param("si", $newPasswordHash, $userId);
    $updateStmt->execute();
    
    return "Password successfully changed.";
}

// Change password if form is submitted
$passwordChangeMessage = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {
    $passwordChangeMessage = changePassword($conn, $userId, $_POST['currentPassword'], $_POST['newPassword'], $_POST['confirmNewPassword']);
}

// Fetch user orders from the database
$stmt = $conn->prepare("SELECT * FROM orders WHERE customerID = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="HomePageCSS.css">
</head>
<body>
    <h1>Your Profile</h1>
    
    <!-- Change Password Section -->
    <section class="change-password">
        <h2>Change Password</h2>
        <form method="post" action="user_profile.php">
            <input type="password" name="currentPassword" required placeholder="Current Password">
            <input type="password" name="newPassword" required placeholder="New Password">
            <input type="password" name="confirmNewPassword" required placeholder="Confirm New Password">
            <button type="submit" name="change_password">Change Password</button>
        </form>
        <?php if ($passwordChangeMessage): ?>
            <p><?= $passwordChangeMessage ?></p>
        <?php endif; ?>
    </section>

    <!-- Orders Section -->
<section class="user-orders">
    <h2>Your Orders</h2>
    <?php if (empty($orders)): ?>
        <p>You have no past orders.</p>
    <?php else: ?>
        <div class="orders-container">
            <?php foreach ($orders as $order): ?>
                <div class="order">
                    <h3>Order ID: <?= htmlspecialchars($order['orderID']) ?></h3>
                    <div class="order-details">
                        <?php
                        // Fetch order items with images, including bottleSize and engraving
$itemsStmt = $conn->prepare("SELECT oi.quantity, oi.subtotal, p.name, p.price, p.images, oi.bottleSize, oi.engraving FROM orderitem oi JOIN product p ON oi.productID = p.productID WHERE oi.orderID = ?");
$itemsStmt->bind_param("i", $order['orderID']);
$itemsStmt->execute();
$itemsResult = $itemsStmt->get_result();
$orderItems = $itemsResult->fetch_all(MYSQLI_ASSOC);

                        /// Display each item
                 foreach ($orderItems as $item):
                $imagePath = $item['images'];
                                           ?>
    <div class="order-item">
        <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="order-item-image" style="width: 100px; height: auto;">
        <div class="item-info">
            <p>Name: <?= htmlspecialchars($item['name']) ?></p>
            <p>Price: £<?= htmlspecialchars($item['price']) ?></p>
            <p>Quantity: <?= htmlspecialchars($item['quantity']) ?></p>
            <p>Subtotal: £<?= htmlspecialchars($item['subtotal']) ?></p>
            <p>Bottle Size: <?= htmlspecialchars($item['bottleSize']) ?>ml</p>
            <p>Engraving: <?= htmlspecialchars($item['engraving']) ?></p>
        </div>
    </div>
<?php endforeach; ?>
                    </div>
                    <p class="order-total">Total: £<?= htmlspecialchars($order['total']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

</body>
</html>
