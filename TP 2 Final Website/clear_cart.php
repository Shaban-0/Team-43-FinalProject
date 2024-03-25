<?php
session_start();
include 'db_connect.php';

$sessionId = $_SESSION['sessionID'] ?? session_id();

$query = "DELETE FROM basket WHERE sessionID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $sessionId);
$stmt->execute();

header("Location: checkout.php");
exit;
?>
