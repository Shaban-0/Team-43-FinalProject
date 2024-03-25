<?php
session_start();
include 'db_connect.php';

// Check if admin is logged in, redirect if not
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header('Location: admin_login.php');
    exit;
}

// Fetch customers' details
$customersQuery = "SELECT customerID, username, firstname, lastname, email, mobile, isActive FROM customer ORDER BY customerID ASC";
$customersResult = $conn->query($customersQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users - Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Manage Users</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($customer = $customersResult->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($customer['customerID']); ?></td>
                    <td><?= htmlspecialchars($customer['username']); ?></td>
                    <td><?= htmlspecialchars($customer['firstname'] . ' ' . $customer['lastname']); ?></td>
                    <td><?= htmlspecialchars($customer['email']); ?></td>
                    <td><?= htmlspecialchars($customer['mobile']); ?></td>
                    <td><?= $customer['isActive'] ? 'Active' : 'Disabled'; ?></td>
                    <td>
                        <a href="edit_user.php?userID=<?= $customer['customerID']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="toggle_user_status.php?userID=<?= $customer['customerID']; ?>&status=<?= $customer['isActive']; ?>" class="btn <?= $customer['isActive'] ? 'btn-danger' : 'btn-success'; ?> btn-sm"><?= $customer['isActive'] ? 'Disable' : 'Enable'; ?></a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

