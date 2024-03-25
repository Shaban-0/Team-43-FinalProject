<?php
// update_cart.php
session_start();
require 'db_connect.php';

if (isset($_POST['quantity'])) {
    foreach ($_POST['quantity'] as $basketID => $quantity) {
        // Retrieve bottle size and engraving for each basket item
        $bottleSize = $_POST['bottleSize'][$basketID] ?? '';
        $engraving = $_POST['engraving'][$basketID] ?? '';

        if ($quantity > 0) {
            // Update the query to include the bottle size and engraving
            $query = "UPDATE basket SET quantity=?, bottleSize=?, engraving=? WHERE basketID=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("issi", $quantity, $bottleSize, $engraving, $basketID);
            $stmt->execute();
        }
    }
}

header("Location: checkout.php");
exit;
?>
